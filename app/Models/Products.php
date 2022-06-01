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
        'Name',
        'Active',
        'Slug',
        'Key',
        'BarCode',
        'Image',
        'Description'
    ];


    protected $table = 'products';

    public static function AllData($productId)
    {
        $product = Products::find($productId);
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
            $stock[$stockItem->UnitId] = $stockItem;
        }

        return $stock;
    }

    public static function movements($pid)
    {
        return DB::table('product_stock_movements as psm')
            ->join('units as u', 'psm.UnitId', '=', 'u.Id')
            ->join('users as us', 'psm.UserId', '=', 'us.id')
            ->where('psm.ProductId', $pid)
            ->select('psm.*', 'us.Name as UserName', 'u.Name as UnitName')
            ->orderBy('psm.Id', 'desc')
            ->get();
    }
}
