<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class orderAdminController extends Controller
{
    function order_controller_page(){
        $orders = Order::all();
        $running_orders = Order::where('delivery', null)->get();
        return view('admin.order.order_control', [
            'orders' => $orders,
            'running_orders' => $running_orders,
        ]);
    }

    function order_status_update(Request $request) {
        print_r($request->all());
        Order::find($request->order_id)->update([
            'status' => $request->status,
        ]);
        return back();
    }
}
