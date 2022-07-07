<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'OrderId',
        'ProductId',
        'Quantity',
        'BasePrice',
        'Discount'
    ];

    protected $table = 'order_items';

    public static function ItemsByOrder($order)
    {
        return DB::table('order_items as oi')
            ->join('products as p', 'oi.ProductId', '=', 'p.Id')
            ->select('oi.*', 'p.Name as ProductName', 'p.Slug', 'p.Image', 'p.Key')
            ->where('oi.OrderId', $order)
            ->get();
    }

    public static function getOrderItemById($id)
    {
        return DB::table('order_items as oi')
            ->join('orders as o', 'oi.OrderId', '=', 'o.Id')
            ->join('products as p', 'oi.ProductId', '=', 'p.Id')
            ->join('units as u', 'p.UnitId', '=', 'u.Id')
            ->select('oi.*', 'o.BranchId', 'o.StatusId', 'p.Id as ProductId', 'p.Name as ProductName', 'p.Slug', 'p.Image', 'p.Key', 'p.Granel', 'u.Name as UnitName')
            ->where('oi.Id', $id)
            ->first();
    }
}
