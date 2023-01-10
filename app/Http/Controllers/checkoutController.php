<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Order;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class checkoutController extends Controller
{
    function getState(Request $request){
        $val = '<option value="null">Select State</option>';
        $states = State::where('country_id', $request->country)->orderBy('name')->get();
        foreach ($states as $state) {
            $val .= '<option value="'.$state->id.'">'.$state->name.'</option>';
        }
        echo $val;
    }

    function getCity(Request $request){
        $val = '<option value="null">Select City / Town</option>';
        $cities = City::where('state_id', $request->state)->orderBy('name')->get();
        foreach ($cities as $city) {
            $val .= '<option value="'.$city->id.'">'.$city->name.'</option>';
        }
        echo $val;
    }

    function order_store(Request $request){
        // print_r($request->all());
        // die();
        $city = City::find($request->city);
        $rand = substr($city->name, 0, 3);
        $order_str = '#'.Str::upper($rand).'-'.random_int(1000999, 999999999);

        if ($request->payment_method == 1) {
            Order::insert([
                'order_id' => $order_str,
                'customer_id' => Auth::guard('customerlogin')->id(),
                'phone' => $request->phone,
                'sub_total' => $request->sub_total,
                'discount' => $request->discount,
                'discount_amount' => $request->percentage,
                'discount_method' => $request->method,
                'charge' => $request->charge_tg,
                'payment_method' => $request->payment_method,
                'total' => $request->sub_total + $request->charge_tg - $request->discount,
                'created_at' => Carbon::now(),
            ]);
            return back();
        }
        elseif ($request->payment_method == 2) {
            echo 'SSL';
        }
        elseif ($request->paymene_method == 3) {
            echo 'Stripe';
        }

    }
}
