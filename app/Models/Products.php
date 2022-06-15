<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'UnitId',
        'CategoryId',
        'Name',
        'Active',
        'Slug',
        'Key',
        'BarCode',
        'Image',
        'Description',
        'Highlight'
    ];


    protected $table = 'products';

    public static function AllData($productId)
    {
        $product = Products::find($productId);
        $product->category = self::category($product->CategoryId);
        $product->tags = self::tags($productId);
        $product->gallery = self::gallery($productId);
        $product->units = self::units($productId);
        $product->price = self::price($productId);
        $product->stock = self::stock($productId);
        $product->movements = self::movements($productId);
        return $product;
    }

    public static function tags($pid)
    {
        $tags = [];
        foreach (ProductTags::where('ProductId', $pid)->get() as $tag) {
            $tags[] = $tag->Tag;
        }
        return $tags;
    }

    public static function gallery($pid)
    {
        return ProductImages::where('ProductId', $pid)->get();
    }

    public static function units($pid)
    {
        $units = [
            'available' => [],
            'assigned' => []
        ];

        foreach (ProductUnits::where('ProductId', $pid)->get() as $unit) {
            $units['assigned'][] = $unit->UnitId;
        }

        $units['available'] = Units::where('Active', 1)->orderBy('Name', 'asc')->get();

        return $units;
    }

    public static function price($pid)
    {
        return ProductPrices::where('ProductId', $pid)->get();
    }

    public static function stock($pid)
    {
        $stock = [];
        foreach (ProductStock::where('ProductId', $pid)->get() as $stockItem) {
            $stock[$stockItem->BranchId] = $stockItem;
        }

        return $stock;
    }

    public static function movements($pid)
    {
        return DB::table('product_stock_movements as psm')
            ->join('branch_offices as bo', 'bo.Id', '=', 'psm.BranchId')
            ->join('users as us', 'psm.UserId', '=', 'us.id')
            ->where('psm.ProductId', $pid)
            ->select('psm.*', 'us.Name as UserName', 'bo.Name as BranchName')
            ->orderBy('psm.Id', 'asc')
            ->get();
    }

    public static function category($cid)
    {
        return DB::table('product_categories as pc')
            ->join('product_categories as pc2', 'pc2.Id', '=', 'pc.ParentId')
            ->where('pc.Id', $cid)
            ->select('pc.Name', 'pc2.Name as ParentName', 'pc.Active')
            ->first();
    }

    public static function getFeaturedProducts()
    {
        $featured = self::baseQuery()
            ->where('p.Highlight', 1)
            ->where('pp.BasePrice', '>', 0)
            ->orderBy(DB::raw('RAND()'))
            ->limit(20)
            ->get();

        $needFill = 20 - count($featured);

        if ($needFill > 0) {
            $featured2 = self::baseQuery()
                ->where('Highlight', 0)
                ->where('pp.BasePrice', '>', 0)
                ->orderBy(DB::raw('RAND()'))
                ->limit($needFill)
                ->get();

            $featured = $featured->merge($featured2);
        }

        return $featured;
    }

    public static function baseQuery($branchId = 1)
    {
        return DB::table('products as p')
            ->leftJoin('product_prices as pp', 'p.Id', '=', 'pp.ProductId')
            ->leftJoin('units as u', 'u.Id', '=', 'p.UnitId')
            ->leftJoin('product_categories as pc', 'pc.Id', '=', 'p.CategoryId')
            ->leftJoin('product_categories as pd', 'pd.Id', '=', 'pc.ParentId')
            ->leftJoin('product_stocks as ps', 'ps.ProductId', '=', 'p.Id')
            ->select(
                'p.Id',
                'p.Name',
                'u.Name as UnitName',
                'pc.Name as CategoryName',
                'p.Slug',
                'p.Key',
                'p.Description',
                'p.Image',
                'pp.BasePrice',
                'pp.DiscountType',
                'pp.DiscountPercent',
                'pp.DiscountFixed'
            )
            ->where('p.Active', 1)
            ->where('ps.BranchId', $branchId)
            ->where('ps.Quantity', '>', 0);
    }

    public static function getProductsByDepartment($department, $order = 'name', $orderDirection = 'asc', $limit = 12, $page = 1, $branchId = 1)
    {
        switch ($order) {
            case 'name':
                $order = 'p.Name';
                break;
            case 'price':
                $order = 'pp.BasePrice';
                break;
        }

        $totals = self::baseQuery($branchId)->where('pd.Slug', $department)->count();

        $products = self::baseQuery($branchId)
            ->where('pd.Slug', $department)
            ->orderBy($order, $orderDirection)
            ->offset(($page - 1) * $limit)
            ->limit($limit)
            ->get();

        return [
            'products' => $products,
            'department' => $department,
            'order' => $order,
            'orderDirection' => $orderDirection,
            'limit' => $limit,
            'page' => $page,
            'offset' => ($page - 1) * $limit,
            'totals' => $totals,
            'total_pages' => ceil($totals / $limit)
        ];
    }

    public static function getProductsByCategory($category, $order = 'name', $orderDirection = 'asc', $limit = 12, $page = 1, $branchId = 1)
    {
        switch ($order) {
            case 'name':
                $order = 'p.Name';
                break;
            case 'price':
                $order = 'pp.BasePrice';
                break;
        }

        $totals = self::baseQuery($branchId)->where('pc.Id', $category)->count();

        $products = self::baseQuery($branchId)
            ->where('pc.Id', $category)
            ->orderBy($order, $orderDirection)
            ->offset(($page - 1) * $limit)
            ->limit($limit)
            ->get();

        return [
            'products' => $products,
            'order' => $order,
            'orderDirection' => $orderDirection,
            'limit' => $limit,
            'page' => $page,
            'offset' => ($page - 1) * $limit,
            'totals' => $totals,
            'total_pages' => ceil($totals / $limit)
        ];
    }
}
