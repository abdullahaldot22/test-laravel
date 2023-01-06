<?php

namespace App\Http\Controllers;

use App\Models\CartList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function store_cart(Request $request) {
        if (Auth::guard('customerlogin')->check()) {

            

            // if ($request->color_id == null || $request->quantity == null || $request->size_id == null || ($request->color_id == null && $request->size_id == null && $request->quantity == null)) {
            //     return back()->with('pinfo_err', 'Colour, Size or Quantity input missing! ');
            // }

            if ($request->color_id == null || $request->quantity == null || $request->size_id == null) {
                $request->validate([
                    'color_id'=>'required',
                    'size_id'=>'required',
                    'quantity'=>'required',
                ],[
                    'color_id.required' => 'Select a colour first.',
                    'size_id.required' => 'Size must selected.',
                    'quantity.required' => 'Quantity is necessary.',
                ]);
            }
            else{
                if (CartList::where('customer_id', Auth::guard('customerlogin')->id())->where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->exists()) {
                    // print_r($request->all());
                    // CartList::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->increment('quantity', $request->quantity);
                    return back()->with('store_message', 'Your Product has been already found in cart!');
                }
                else {
                    CartList::insert([
                        'customer_id'=>Auth::guard('customerlogin')->id(),
                        'product_id'=>$request->product_id,
                        'color_id'=>$request->color_id,
                        'size_id'=>$request->size_id,
                        'quantity'=>$request->quantity,
                        'created_at'=>Carbon::now(),
                    ]);
                    return back()->with('store_message', 'Added to Your cart successfully!');
                }
            }

        }
        else {
            return redirect()->route('user.login.page')->with('log_error', 'Please Log-In first to add your desirable product to the cart!');
        }
    }

    function cart_update(Request $request){
        // print_r($request->all());
        foreach ($request->quantity as $cart_id => $quantity) {
            // echo $cart_id.'=>'.$quantity.'<br>';
            CartList::find($cart_id)->update([
                'quantity'=>$quantity,
            ]);
        }
        return back();
    }

    function cart_remove($cart_id) {
        CartList::find($cart_id)->delete();
        return back();
    }
}
