<?php

namespace App\Http\Controllers;

use App\Models\CouponStore;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    function product_coupon(){
        $coupons = CouponStore::all();
        return view('admin.product.coupon', [
            'coupons' => $coupons,
        ]);
    }

    function coupon_add(Request $request) {
        if ($request->event_name == null || $request->coupon_code == null || $request->discount_method == null || $request->discount_amount == null || $request->validity_date == null) {
            $request->validate([
                'event_name'=>'required|string|max:130',
                'coupon_code'=>'required|string|max:255',
                // unique:coupon_list,coupon_code|
                'discount_method'=>'required|digits_between:1,2|max:2',
                'discount_amount'=>'required|digits_between:1,99999|max:5',
                'discount_range'=>'nullable|digits_between:1,99999|max:5',
                'lowest_amount_range'=>'nullable|digits_between:1,999999',
                'validity_date'=>'required|date',
            ],[
                'event_name.required'=>'This name is required!',
                'coupon_code.required'=>'This field is required!',
                'discount_method.required'=>'Please select a discount method!',
                'discount_amount.required'=>'This field cannot be empty!',
                'validity_date.required'=>'Please select a date, the coupon will be accepted until.',
            ]);
        }
        else {
            CouponStore::insert([
                'event_name'=>$request->event_name,
                'coupon_code'=>$request->coupon_code,
                'discount_method'=>$request->discount_method,
                'discount_amount'=>$request->discount_amount,
                'discount_range'=>$request->discount_range,
                'lowest_total_amount'=>$request->lowest_amount_range,
                'validity_date'=>$request->validity_date,
                'created_at'=>Carbon::now(),
                'added_by'=>Auth::id(),
            ]);
        }
        // print_r($request->all());
        // echo Auth::id();
        return back();
    }
}
