<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItems;
use App\Models\PostalCoverage;
use App\Models\States;
use App\Models\OrderHistory;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\DB;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'BranchId',
        'StatusId',
        'Name',
        'Email',
        'Phone',
        'Address',
        'PostalCodeId',
        'Slug',
        'PaymentMethodId'
    ];

    protected $table = 'orders';

    public static function getOrderById($orderId)
    {
        $order = Orders::where('Id', $orderId)->first();
        $order->Status = OrderStatus::where('Id', $order->StatusId)->first();
        $order->Items = OrderItems::ItemsByOrder($order->Id);
        $order->PostalCode = PostalCoverage::where('Id', $order->PostalCodeId)->first();
        $order->PostalCode->State = States::where('Id', $order->PostalCode->StateId)->first();
        $order->Added = new \DateTime($order->created_at);
        $order->Updated = new \DateTime($order->updated_at);
        $order->History = OrderHistory::getHistory($order->Id);

        return $order;
    }

    public static function getOrder($slug)
    {
        $order = Orders::where('Slug', $slug)->first();
        $order->Items = OrderItems::ItemsByOrder($order->Id);
        $order->PostalCode = PostalCoverage::where('Id', $order->PostalCodeId)->first();
        $order->PostalCode->State = States::where('Id', $order->PostalCode->StateId)->first();

        return $order;
    }

    public static function getOrders()
    {
        return DB::table('orders as o')
            ->join('branch_offices as b', 'o.BranchId', '=', 'b.Id')
            ->join('order_status as os', 'o.StatusId', '=', 'os.Id')
            ->select('o.*', 'os.Name as StatusName', 'os.Color', 'b.Name as BranchName')
            ->addSelect(DB::raw('(SELECT SUM((oi.BasePrice - oi.Discount) * oi.Quantity) FROM order_items as oi WHERE oi.OrderId = o.Id) as Total'))
            ->orderBy('o.Id', 'desc')
            ->get();
    }
}
