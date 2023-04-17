<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\orderProduct;
use Illuminate\Http\Request;

class orderAdminController extends Controller
{
    function order_controller_page(){
        $orders = Order::all();
        $running_orders = Order::where('delivery', null)->get();
        $finished_orders = Order::whereNotNull('delivery')->get();
        return view('admin.order.order_control', [
            'orders' => $orders,
            'running_orders' => $running_orders,
            'finished_orders' => $finished_orders,
        ]);
    }

    function order_status_update(Request $request) {
        print_r($request->all());
        Order::find($request->order_id)->update([
            'status' => $request->status,
        ]);
        return back();
    }

    function order_details($ordr_id) {
        // echo $ordr_id;
        $order = Order::find($ordr_id);
        $order_pro = orderProduct::where('order_id', $order->order_id)->get();
        // return $order_pro; 
        return view('admin.order.order_details', [
            'order' => $order,
            'order_pro' => $order_pro,
        ]);
    }
}
