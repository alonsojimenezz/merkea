<?php

namespace App\Lib;

use App\Models\BranchOffices;
use App\Models\Orders;

class Utilities
{
    public static function fullOrderNumber($orderId)
    {
        $order = Orders::where('Id', $orderId)->first();
        $branch = BranchOffices::where('Id', $order->BranchId)->first();
        return strtoupper($branch->Prefix) . '-' . str_pad($orderId, 8, "0", STR_PAD_LEFT);
    }
}
