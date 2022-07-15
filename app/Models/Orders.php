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
        'DeliveryMethod',
        'DeliveryDate',
        'Slug',
        'PaymentMethodId'
    ];

    protected $table = 'orders';

    public static function getOrderById($orderId)
    {
        $order = Orders::where('Id', $orderId)->first();
        $order->Status = OrderStatus::where('Id', $order->StatusId)->first();
        $order->Items = OrderItems::ItemsByOrder($order->Id);
        $order->Branch = BranchOffices::find($order->BranchId);
        if ($order->DeliveryMethod == 1) {
            $order->PostalCode = PostalCoverage::where('Id', $order->PostalCodeId)->first();
            $order->PostalCode->State = States::where('Id', $order->PostalCode->StateId)->first();
        }
        $order->Added = new \DateTime($order->created_at);
        $order->Updated = new \DateTime($order->updated_at);
        $order->History = OrderHistory::getHistory($order->Id);

        return $order;
    }

    public static function getOrder($slug)
    {
        $order = Orders::where('Slug', $slug)->first();
        $order->Items = OrderItems::ItemsByOrder($order->Id);
        $order->Branch = BranchOffices::find($order->BranchId);
        if ($order->DeliveryMethod == 1) {
            $order->PostalCode = PostalCoverage::where('Id', $order->PostalCodeId)->first();
            $order->PostalCode->State = States::where('Id', $order->PostalCode->StateId)->first();
        }

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

    public static function getSales($start, $end)
    {
        return [
            'total' => number_format(self::getTotalSales($start, $end), 2),
            'totals_by_branch' => self::getTotalSalesByBranch($start, $end),
            'totals_by_branch_table' => self::getTotalSalesByBranchTable($start, $end),
            'totals_by_product' => self::getTotalSalesByProduct($start, $end),
            'totals_by_department' => self::getTotalSalesByDepartment($start, $end),
        ];
    }

    public static function getTotalSales($start, $end)
    {
        return DB::table('orders as o')
            ->join('order_items as oi', 'o.Id', '=', 'oi.OrderId')
            ->whereBetween('o.created_at', [$start . ' 00:00:00', $end . ' 23:59:59'])
            ->select(DB::raw('SUM((oi.BasePrice - oi.Discount) * oi.Quantity) as Total'))
            ->first()
            ->Total;
    }

    public static function getTotalSalesByBranch($start, $end)
    {
        $days = [];
        $aux = [];
        $values = [];

        $originalBranches = DB::table('branch_offices')->where('IsActive', 1)->get();

        $result =  DB::table('orders as o')
            ->join('order_items as oi', 'o.Id', '=', 'oi.OrderId')
            ->whereBetween('o.created_at', [$start . ' 00:00:00', $end . ' 23:59:59'])
            ->select(
                DB::raw('SUM((oi.BasePrice - oi.Discount) * oi.Quantity) as Total'),
                'o.BranchId',
                DB::raw("DATE_FORMAT(o.created_at,'%d/%m/%Y') as Day")
            )
            ->groupBy('o.BranchId', 'Day')
            ->orderBy('Day', 'asc')
            ->get();

        foreach ($result as $row) {
            if (!in_array($row->Day, $days)) {
                array_push($days, $row->Day);
            }
        }

        foreach ($days as $day) {
            $aux[$day] = [
                'branches' => []
            ];

            foreach ($originalBranches as $branch) {
                $aux[$day]['branches'][$branch->Id] = [
                    'name' => $branch->Name,
                    'value' => 0
                ];
            }
        }

        foreach ($result as $row) {
            $aux[$row->Day]['branches'][$row->BranchId]['value'] = $row->Total;
        }

        foreach ($originalBranches as $branch) {
            $values[$branch->Name] = [];
            foreach ($aux as $a) {
                array_push($values[$branch->Name], number_format($a['branches'][$branch->Id]['value'], 2));
            }
        }

        return [
            'days' => $days,
            'values' => $values
        ];
    }

    public static function getTotalSalesByBranchTable($start, $end)
    {
        $originalBranches = DB::table('branch_offices')->where('IsActive', 1)->get();
        $branches = [];

        $result = DB::table('orders as o')
            ->join('order_items as oi', 'o.Id', '=', 'oi.OrderId')
            ->whereBetween('o.created_at', [$start . ' 00:00:00', $end . ' 23:59:59'])
            ->addSelect(
                DB::raw("date_format(o.created_at,'%d/%m/%Y') as Day")
            );
        foreach ($originalBranches as $branch) {
            $result = $result->addSelect(DB::raw("sum(if(o.BranchId = {$branch->Id}, ((oi.BasePrice - oi.Discount) * oi.Quantity), 0)) as `{$branch->Name}`"));
            array_push($branches, $branch->Name);
        }
        $result = $result->groupBy('Day')->orderBy('Day', 'asc')->get();

        return [
            'branches' => $branches,
            'values' => $result
        ];
    }

    public static function getTotalSalesByProduct($start, $end)
    {
        return DB::table('orders as o')
            ->join('order_items as oi', 'o.Id', '=', 'oi.OrderId')
            ->join('products as p', 'oi.ProductId', '=', 'p.Id')
            ->whereBetween('o.created_at', [$start . ' 00:00:00', $end . ' 23:59:59'])
            ->select(
                'p.Name as x',
                DB::raw('SUM((oi.BasePrice - oi.Discount) * oi.Quantity) as y'),
            )->groupBy('p.Id')->orderBy('y', 'desc')->get();
    }

    public static function getTotalSalesByDepartment($start, $end)
    {
        return DB::table('orders as o')
            ->join('order_items as oi', 'o.Id', '=', 'oi.OrderId')
            ->join('products as p', 'oi.ProductId', '=', 'p.Id')
            ->join('product_categories as c', 'p.CategoryId', '=', 'c.Id')
            ->join('product_categories as d', 'c.ParentId', '=', 'd.Id')
            ->whereBetween('o.created_at', [$start . ' 00:00:00', $end . ' 23:59:59'])
            ->select(
                'd.Name as x',
                DB::raw('SUM((oi.BasePrice - oi.Discount) * oi.Quantity) as y'),
            )->groupBy('d.Id')->orderBy('y', 'desc')->get();
    }
}
