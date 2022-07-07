<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'OrderId',
        'StatusId',
        'UserId',
        'Comment'
    ];

    protected $table = 'order_history';

    public static function getHistory($orderId)
    {
        return DB::table('order_history as oh')
            ->join('order_status as os', 'oh.StatusId', '=', 'os.Id')
            ->join('users as u', 'oh.UserId', '=', 'u.Id')
            ->select('oh.*', 'os.Name as StatusName', 'os.Color', 'u.Name as UserName')
            ->where('oh.OrderId', $orderId)
            ->orderBy('oh.Id', 'desc')
            ->get();
    }
}
