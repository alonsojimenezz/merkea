<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\OrderItems as ModelsOrderItems;
use stdClass;

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
        'Highlight',
        'Granel'
    ];


    protected $table = 'products';

    public static function AllData($productId)
    {
        $product = Products::find($productId);
        $product->category = self::category($product->CategoryId);
        $product->tags = self::tags($productId);
        $product->gallery = self::gallery($productId);
        $product->units = self::units($productId);
        $product->prices = self::price($productId);
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
        $prices = [];
        foreach (ProductPrices::where('ProductId', $pid)->get() as $price) {
            $prices[$price->BranchId] = $price;
        }

        return $prices;
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

    public static function getFeaturedProducts($branchId)
    {
        $featured = self::baseQuery($branchId)
            ->where('p.Highlight', 1)
            ->where('pp.BasePrice', '>', 0)
            ->orderBy(DB::raw('RAND()'))
            ->limit(20)
            ->get();

        $needFill = 20 - count($featured);

        if ($needFill > 0) {
            $featured2 = self::baseQuery($branchId)
                ->where('Highlight', 0)
                ->where('pp.BasePrice', '>', 0)
                ->orderBy(DB::raw('RAND()'))
                ->limit($needFill)
                ->get();

            $featured = $featured->merge($featured2);
        }

        return $featured;
    }

    public static function productStore($slug, $branchId)
    {
        return DB::table('products as p')
            ->join('units as u', 'u.Id', '=', 'p.UnitId')
            ->join('product_categories as pc', 'pc.Id', '=', 'p.CategoryId')
            ->join('product_categories as pd', 'pd.Id', '=', 'pc.ParentId')
            ->select(
                'p.Id',
                'p.Name',
                'u.Name as UnitName',
                'pc.Name as CategoryName',
                'pc.Slug as CategorySlug',
                'pd.Name as DepartmentName',
                'pd.Slug as DepartmentSlug',
                'p.Slug',
                'p.Key',
                'p.Description',
                'p.Image',
                'p.Active',
                'pc.Active as CategoryActive',
                'pd.Active as DepartmentActive',
                'p.Granel'
            )
            ->where('p.Slug', $slug)
            ->first();
    }

    public static function productPrice($productId, $branchId)
    {
        $price = ProductPrices::where('ProductId', $productId)
            ->where('BranchId', $branchId)
            ->first();
        if ($price) {
            return $price;
        } else {
            $price = new stdClass();
            $price->BasePrice = 0;
            $price->DiscountFixed = 0;
            return $price;
        }
    }

    public static function productStock($productId, $branchId)
    {
        $stock = ProductStock::where('ProductId', $productId)
            ->where('BranchId', $branchId)
            ->first();
        if ($stock) {
            $validating = ModelsOrderItems::getValitatingQuantity($branchId, $productId);
            $stock->Quantity = $stock->Quantity - $validating;
            return $stock;
        } else {
            $stock = new stdClass();
            $stock->Quantity = 0;
            return $stock;
        }
    }

    public static function baseQuery($branchId)
    {
        $query = DB::table('products as p')
            ->join('product_prices as pp', 'p.Id', '=', 'pp.ProductId')
            ->join('units as u', 'u.Id', '=', 'p.UnitId')
            ->join('product_categories as pc', 'pc.Id', '=', 'p.CategoryId')
            ->join('product_categories as pd', 'pd.Id', '=', 'pc.ParentId')
            ->join('product_stocks as ps', 'ps.ProductId', '=', 'p.Id')
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
                'pp.DiscountFixed',
                // 'ps.Quantity',
                'p.Granel'
            )
            ->addSelect(DB::raw("(ps.Quantity - (select if(SUM( oi.Quantity ) is null, 0, SUM( oi.Quantity )) from orders o inner join order_items oi on o.Id = oi.OrderId where o.StatusId in (1,5) and oi.ProductId = p.Id and o.BranchId = $branchId)) as Quantity"))
            ->addSelect(DB::raw("(select group_concat(Tag) from product_tags where ProductId = p.Id) as Tags"))
            ->where('p.Active', 1)
            ->where('ps.BranchId', $branchId)
            ->where('pp.BranchId', $branchId)
            ->where('ps.Quantity', '>', 0)
            ->whereRaw("(ps.Quantity - (select if(SUM( oi.Quantity ) is null, 0, SUM( oi.Quantity )) from orders o inner join order_items oi on o.Id = oi.OrderId where o.StatusId in (1,5) and oi.ProductId = p.Id and o.BranchId = $branchId)) > 0");

        // $sql = self::getQueryWithBindings($query);
        // dd($sql);

        // $sql = $query->toSql();
        // dd([
        //     'bid' => $branchId,
        //     'sql' => $sql
        // ]);


        return $query;
    }

    public static function getProductsForAdmin()
    {
        return DB::table('products as p')
            ->leftJoin('units as u', 'u.Id', '=', 'p.UnitId')
            ->leftJoin('product_categories as pc', 'pc.Id', '=', 'p.CategoryId')
            ->leftJoin('product_categories as pd', 'pd.Id', '=', 'pc.ParentId')
            ->select(
                'p.Id',
                'p.Name',
                'u.Name as UnitName',
                'pc.Name as CategoryName',
                'pd.Name as DepartmentName',
                'p.Slug',
                'p.Key',
                'p.Description',
                'p.Image',
                'p.Active'
            )->get();
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

    public static function getProductsBySearch($search, $department = null, $order = 'name', $orderDirection = 'asc', $limit = 12, $page = 1, $branchId = 1)
    {
        switch ($order) {
            case 'name':
                $order = 'p.Name';
                break;
            case 'price':
                $order = 'pp.BasePrice';
                break;
        }

        $products = self::baseQuery($branchId);

        if (!is_null($department) && $department > 0) {
            $products = $products->where('pd.Id', $department);
        }

        $s = explode(' ', $search);

        $products = $products->where(function ($query) use ($search, $s) {
            $query->where('p.Name', 'like', '%' . $search . '%')
                ->orWhere('p.Key', 'like', '%' . $search . '%')
                ->orWhere('p.Description', 'like', '%' . $search . '%')
                ->orWhere('pc.Name', 'like', '%' . $search . '%')
                ->orWhere('pd.Name', 'like', '%' . $search . '%')
                ->orWhereRaw("POSITION('{$search}' IN (select group_concat(Tag) from product_tags where ProductId = p.Id)) > 0 ");
            foreach ($s as $word) {
                if (strlen($word) > 2) {
                    $query->orWhere('p.Name', 'like', '%' . $word . '%');
                    $query->orWhere('p.Key', 'like', '%' . $word . '%');
                    $query->orWhere('p.Description', 'like', '%' . $word . '%');
                    $query->orWhere('pc.Name', 'like', '%' . $word . '%');
                    $query->orWhere('pd.Name', 'like', '%' . $word . '%');
                    $query->orWhereRaw("POSITION('{$word}' IN (select group_concat(Tag) from product_tags where ProductId = p.Id)) > 0 ");
                }
            }
        });

        $k = 0;
        $products = $products->addSelect(DB::raw("if(POSITION('{$search}' IN p.Name) > 0, POSITION('{$search}' IN p.Name), 99) as position_{$k}"));
        $products = ($order == 'p.Name') ? $products->orderBy('position_' . $k, 'asc') : $products;

        foreach ($s as $word) {
            if (strlen($word) > 2) {
                $k++;
                $products = $products->addSelect(DB::raw("if(POSITION('{$word}' IN p.Name) > 0, POSITION('{$word}' IN p.Name), 99) as position_{$k}"));
                $products = ($order == 'p.Name') ? $products->orderBy('position_' . $k, 'asc') : $products;
            }
        }

        $totals = $products;
        $totals = $totals->count();

        $products = $products->orderBy($order, $orderDirection)->offset(($page - 1) * $limit)
            ->limit($limit);

        $sql = self::getQueryWithBindings($products);
        $products = $products->get();

        return [
            'products' => $products,
            'search' => $search,
            'department' => $department,
            'order' => $order,
            'orderDirection' => $orderDirection,
            'limit' => $limit,
            'page' => $page,
            'offset' => ($page - 1) * $limit,
            'totals' => $totals,
            'total_pages' => ceil($totals / $limit),
            'sql' => $sql
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
