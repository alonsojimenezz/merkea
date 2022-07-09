<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Products;
use App\Models\Products as ModelsProducts;
use App\Models\OrderItems as ModelsOrderItem;
use App\Models\OrderHistory as ModelsOrderHistory;
use App\Models\Orders as ModelsOrders;
use App\Models\ProductStock as ModelsProductStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderItem extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $item = ModelsOrderItem::where('OrderId', $request->input('order'))
                ->where('ProductId', $request->input('pid'))
                ->first();
            $order = ModelsOrders::where('Id', $request->input('order'))->first();
            $product = ModelsProducts::where('Id', $request->input('pid'))->first();

            if (!$item) {
                ModelsOrderItem::create([
                    'OrderId' => $request->input('order'),
                    'ProductId' => $request->input('pid'),
                    'Quantity' => $request->input('quantity'),
                    'BasePrice' => $request->input('price'),
                    'Discount' => $request->input('discount'),
                ]);

                ModelsOrderHistory::create([
                    'OrderId' => $order->Id,
                    'StatusId' => $order->StatusId,
                    'UserId' => auth()->user()->id,
                    'Comment' => __("The product ':product' has been added to the order", ['product' => $product->Name])
                ]);
            } else {
                ModelsOrderItem::where('Id', $item->Id)->update([
                    'Quantity' => ($item->Quantity + $request->input('quantity'))
                ]);

                ModelsOrderHistory::create([
                    'OrderId' => $order->Id,
                    'StatusId' => $order->StatusId,
                    'UserId' => auth()->user()->id,
                    'Comment' => __("The quantity of the product ':product' has been changed from :from to :to", ['product' => $product->Name, 'from' => $item->Quantity, 'to' => $request->input('quantity')])
                ]);
            }

            DB::commit();
            return $this->jsonResponse(200, __('Updated'));
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = ModelsOrderItem::getOrderItemById($id);
        $item->Image = !is_null($item->Image) && $item->Image != '' ? asset($item->Image) : Products::product_image($item->Key);
        $item->Stock =  ModelsProductStock::where('ProductId', $item->ProductId)->where('BranchId', $item->BranchId)->first();
        return $this->jsonResponse(200, 'Loaded', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $item = ModelsOrderItem::getOrderItemById($id);
            if ($item->Quantity != $request->input('quantity')) {
                DB::beginTransaction();
                ModelsOrderItem::where('Id', $id)->update([
                    'Quantity' => $request->input('quantity')
                ]);

                ModelsOrderHistory::create([
                    'OrderId' => $item->OrderId,
                    'StatusId' => $item->StatusId,
                    'UserId' => auth()->user()->id,
                    'Comment' => __("The quantity of the product ':product' has been changed from :from to :to", ['product' => $item->ProductName, 'from' => $item->Quantity, 'to' => $request->input('quantity')])
                ]);

                DB::commit();
                return $this->jsonResponse(200, __('Updated'));
            } else {
                return $this->jsonResponse(500, __('Nothing to update'));
            }
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $item = ModelsOrderItem::getOrderItemById($id);
            DB::beginTransaction();
            ModelsOrderHistory::create([
                'OrderId' => $item->OrderId,
                'StatusId' => $item->StatusId,
                'UserId' => auth()->user()->id,
                'Comment' => __("The product ':product' has been removed from the order", ['product' => $item->ProductName])
            ]);

            ModelsOrderItem::where('Id', $id)->delete();

            DB::commit();
            return $this->jsonResponse(200, 'Deleted');
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $e->getMessage(),
            ]);
        }
    }
}
