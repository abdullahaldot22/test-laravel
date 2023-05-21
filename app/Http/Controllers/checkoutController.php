<?php

namespace App\Http\Controllers;

use App\Mail\invoiceMail as MailInvoiceMail;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Order;
use App\Models\State;
use App\Models\CartList;
use App\Models\inventory;
use Illuminate\Support\Str;
use App\Models\orderProduct;
use Illuminate\Http\Request;
use App\Models\billingDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $request->validate([
            'name'=>'required|regex:/([A-Za-z]\w+\s)/|min:4',
            'mail'=>'required|email',
            'company'=>'nullable',
            'phone'=>'required|numeric',
            'address'=>'required|min:8',
            'country'=>'required',
            'state'=>'required',
            'city'=>'required',
            'zip'=>'required|numeric',
            'note'=>'nullable|max:250',
            'charge'=>'required|numeric',
            'payment_method'=>'required|numeric|min:1|max:3',
            'sub_total'=>'required|numeric',
            'discount'=>'required|numeric',
            'percentage'=>'nullable|numeric',
            'method'=>'nullable|numeric',
            'charge_tg'=>'required|numeric',
        ],[
            'phone.numeric'=>'input your phone number correctly it must only contain numbers',
        ]);
        $city = City::find($request->city);
        $rand = substr($city->name, 0, 3);
        $order_str = '#'.Str::upper($rand).'-'.random_int(1000999, 999999999);
        $order_product = '';
        $grand_total = $request->sub_total + $request->charge_tg - $request->discount;

        if($request->percentage == ''){
            $so_data = $request->discount;}
        else{
            $so_data = $request->percentage;
        }
        $so_data;

        if ($request->payment_method == 1) {
            $order_product = Order::create([
                'order_id' => $order_str,
                'customer_id' => Auth::guard('customerlogin')->id(),
                'phone' => $request->phone,
                'sub_total' => $request->sub_total,
                'discount' => $request->discount,
                'discount_amount' => $so_data,
                'discount_method' => $request->method,
                'charge' => $request->charge_tg,
                'payment_method' => $request->payment_method,
                'total' => $grand_total,
                'created_at' => Carbon::now(),
            ]);
            
            billingDetails::insert([
                'order_id'=>$order_str,
                'customer_id'=>Auth::guard('customerlogin')->id(),
                'name'=>$request->name,
                'mail'=>$request->mail,
                'company'=>$request->company,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'country_id'=>$request->country,
                'city_id'=>$request->city,
                'state_id'=>$request->state,
                'zip'=>$request->zip,
                'notes'=>$request->note,
                'created_at'=>Carbon::now(),
            ]);
            
            $carts = CartList::where('customer_id', Auth::guard('customerlogin')->id())->get();
            foreach ($carts as $cart) {
                orderProduct::insert([
                    'order_id'=>$order_str,
                    'customer_id'=>Auth::guard('customerlogin')->id(),
                    'product_id'=>$cart->product_id,
                    'price'=>$cart->rel_to_product->after_discount,
                    'color_id'=>$cart->color_id,
                    'size_id'=>$cart->size_id,
                    'quantity'=>$cart->quantity,
                    'created_at'=>Carbon::now(),
                ]);

                inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->decrement('quantity', $cart->quantity);
            }
            // $created_at = $order_product->created_at;
            // echo $created_at;

            CartList::where('customer_id', Auth::guard('customerlogin')->id())->delete();


            Mail::to($request->mail)->send(new MailInvoiceMail($order_str));

            // send sms  ----------------------------------------------------------------------

                                                    
                // $url = "http://bulksmsbd.net/api/smsapi";
                // $api_key = "gvLw5sSnEymkfY2aSNKY";
                // $senderid = "abdullah";
                // $number = $request->phone;
                // $message = "Congratulation! your order has successfully been placed! your bill is - " . $grand_total;
            
                // $data = [
                //     "api_key" => $api_key,
                //     "senderid" => $senderid,
                //     "number" => $number,
                //     "message" => $message
                // ];
                // $ch = curl_init();
                // curl_setopt($ch, CURLOPT_URL, $url);
                // curl_setopt($ch, CURLOPT_POST, 1);
                // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                // $response = curl_exec($ch);
                // curl_close($ch);

            // send sms  ----------------------------------------------------------------------

            return route('success.page');
        }
        elseif ($request->payment_method == 2) {
            $total = $request->sub_total + $request->charge_tg - $request->discount;
            $all_data = $request->all();
            $so_data;

            return redirect('/pay')->with([
                'data' => $all_data,
                'total' => $total,
                'order_id' => $order_str,
                'so_data' => $so_data,
                'order_product' => $order_product,
            ]);
        }
        elseif ($request->payment_method == 3) {

            $total = $request->sub_total + $request->charge_tg - $request->discount;
            $all_data = $request->all();
            $so_data;

            return redirect('stripe')->with([
                'data' => $all_data,
                'total' => $total,
                'order_id' => $order_str,
                'so_data' => $so_data,
                'order_product' => $order_product,
            ]);
        }
        else{
            echo 'something went wrong';
        }

    }

}
