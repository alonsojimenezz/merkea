<?php

namespace App\Http\Controllers;

use App\Models\Orders as ModelsOrders;
use App\Models\OrderStatus as ModelsOrderStatus;
use Illuminate\Http\Request;

class Orders extends Controller
{
    public function index()
    {
        return view('admin.orders.index', [
            'orders' => ModelsOrders::getOrders()
        ]);
    }

    public function show_order($orderId)
    {
        $order = ModelsOrders::getOrderById($orderId);
        return view('admin.orders.show', [
            'order' => $order,
            'status' => ModelsOrderStatus::where('Active', 1)->get()
        ]);
    }
}
