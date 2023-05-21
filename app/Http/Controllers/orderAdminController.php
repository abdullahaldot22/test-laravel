<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\orderProduct;
use Carbon\Carbon;
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
        if ($request->status == 5) {
            Order::find($request->order_id)->update([
                'status' => $request->status,
                'delivery' => Carbon::now(),
            ]);
        }else{
            Order::find($request->order_id)->update([
                'status' => $request->status,
            ]);
        }
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

    function control_review() {
        $review = orderProduct::whereNotNull('review')->get();
        return view('admin.order.review.control_review', [
            'review' => $review,
        ]);
    }

    function admin_remove_review($cus_id) {
        // echo $cus_id;
        orderProduct::find($cus_id)->delete('review');
        return back();
    }

    function order_notification_status_update($not_id) {
        echo $not_id;
        Order::find($not_id)->update([
            'notification_status' => 1,
        ]);
        return redirect()->route('order.details', $not_id);
    }
}
