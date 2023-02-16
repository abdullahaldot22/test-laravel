<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{

    function store_wish(Request $request) {
        if (Auth::guard('customerlogin')->check()) {
            if ($request->color_id == null || $request->quantity == null || $request->size_id == null ) {
                // return $request->all();
                $request->validate([
                    'color_id'=>'required',
                    'size_id'=>'required',
                    'quantity'=>'required',
                ],[
                    'color_id.required' => 'Select a colour first.',
                    'size_id.required' => 'Size must selected.',
                    'quantity.required' => 'Quantity is necessary.',
                ]);
                return back();
                // echo 'input missing';
            }
            else{
                if (WishList::where('customer_id', Auth::guard('customerlogin')->id())->where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->exists()) {
                    WishList::where('customer_id', Auth::guard('customerlogin')->id())->where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->increment('quantity', $request->quantity);
                    return back()->with('store_message', 'Increased to Your cart successfully!');
                    echo 'found didnt increased';
                }
                else {
                    WishList::insert([
                        'customer_id'=>Auth::guard('customerlogin')->id(),
                        'product_id'=>$request->product_id,
                        'color_id'=>$request->color_id,
                        'size_id'=>$request->size_id,
                        'quantity'=>$request->quantity,
                        'created_at'=>Carbon::now(),
                    ]);
                    echo 'didnt insert';
                    return back()->with('store_message', 'Added to Your Wish-List successfully!');
                }
            }
        }
        else {
            return redirect()->route('user.login.page')->with('log_error', 'Please Log-In first to add your desirable product to the cart!');
        }
    }

    function wishitm_remove($cart_id) {
        WishList::find($cart_id)->delete();
        return back();
    }
}
