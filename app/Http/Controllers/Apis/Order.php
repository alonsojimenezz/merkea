<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Orders as ModelsOrders;
use App\Models\OrderHistory as ModelsOrderHistory;
use Throwable;

class Order extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeOrderStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $order = ModelsOrders::where('Id', $request->input('id'))->first();

            $prev_status = OrderStatus::where('Id', $order->StatusId)->first();
            $new_status = OrderStatus::where('Id', $request->input('status'))->first();

            ModelsOrders::where('Id', $request->input('id'))->update([
                'StatusId' => $request->input('status')
            ]);

            ModelsOrderHistory::create([
                'OrderId' => $request->input('id'),
                'StatusId' => $request->input('status'),
                'UserId' => auth()->user()->id,
                'Comment' => __("The order changed from ':prev_status' to ':new_status'", [
                    'prev_status' => __($prev_status->Name),
                    'new_status' => __($new_status->Name)
                ])
            ]);

            DB::commit();
            return $this->jsonResponse(200, __('Updated'));
        } catch (Throwable $e) {
            DB::rollback();
            return $this->jsonResponse(500, __('Internal Server Error'), [
                'exception' => $e->getMessage(),
            ]);
        }
    }
}
