<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\CartList;
use App\Models\CouponStore;
use App\Models\inventory;
use Illuminate\Http\Request;
use App\Models\customerlogin;
use Illuminate\Support\Facades\Auth;

class customerController extends Controller
{
    function login_page(){
        return view('frontend.register&login.register');
    }

    function cart_page(Request $request){
        $coupon = $request->coupon_code;
        $discount_amount = 0;
        $err_msg = null;
        $discount_method = null;
        $discount_range = null;
        if ($coupon == '') {
            $discount_amount = 0;
            $err_msg = null;
        }
        else {
            if (CouponStore::where('coupon_code', $coupon)->exists()) {
                $all_info = CouponStore::where('coupon_code', $coupon)->get()->first();
                if (Carbon::now()->format('Y-m-d') < $all_info->validity_date) {
                    $discount_amount = $all_info->discount_amount;
                    $discount_method = $all_info->discount_method;
                    $discount_range = $all_info->discount_range;
                }
                else {
                    $discount_amount = 0;
                    $err_msg = 'This coupon has expired';
                }
            }
            else {
                $discount_amount = 0;
                $err_msg = 'This coupon does not exist';
            }
        }

        $customer_id = Auth::guard('customerlogin')->id();
        $cart = CartList::where('customer_id', $customer_id)->get();
        return view('frontend.profile_personal.cart_page', [
            'cart'=>$cart,
            'discount'=>$discount_amount,
            'method'=>$discount_method,
            'drange'=>$discount_range,
            'err_msg'=>$err_msg,
        ]);
    }

    function checkout_page(){
        $carts = CartList::where('customer_id', Auth::guard('customerlogin')->id())->get();
        return view('frontend.profile_personal.checkout', [
            'carts' => $carts,
        ]);
    }

    
}
