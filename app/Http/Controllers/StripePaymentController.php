<?php

    

namespace App\Http\Controllers;

use App\Mail\invoiceMail as MailInvoiceMail;
use Session;
use Carbon\Carbon;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Order;
use App\Models\CartList;
use App\Models\inventory;
use App\Models\orderProduct;
use Illuminate\Http\Request;
use App\Models\billingDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StripePaymentController extends Controller

{

    /**

     * success response method.

     *

     * @return \Illuminate\Http\Response

     */

    public function stripe()

    {

        return view('frontend.payment.stripe');

    }

    

    /**

     * success response method.

     *

     * @return \Illuminate\Http\Response

     */

    public function stripePost(Request $request)

    {
        $total = $request->total;
        $data = session('all_data');
        $order_id = $request->order_id;
        $so_data = $request->so_data;

        print_r($data);
        echo '<br>';
        echo $total;
        echo '<br>';
        echo $order_id;
        echo '<br>';
        echo $so_data;

        // die();


        Stripe::setApiKey(env('STRIPE_SECRET'));

        // $customer = Auth::guard('customerlogin')->user()->name;

        Charge::create ([
            "amount" => 100 * $total,
            "currency" => "bdt",
            "source" => $request->stripeToken,
            "description" => $order_id, 
        ]);


        Order::insert([
            'order_id' => $order_id,
            'customer_id' => Auth::guard('customerlogin')->id(),
            'phone' => $data['phone'],
            'sub_total' => $data['sub_total'],
            'discount' => $data['discount'],
            'discount_amount' => $so_data,
            'discount_method' => $data['method'],
            'charge' => $data['charge_tg'],
            'payment_method' => $data['payment_method'],
            'total' => $total,
            'created_at' => Carbon::now(),
        ]);
        
        billingDetails::insert([
            'order_id'=>$order_id,
            'customer_id'=>Auth::guard('customerlogin')->id(),
            'name'=>$data['name'],
            'mail'=>$data['mail'],
            'company'=>$data['company'],
            'phone'=>$data['phone'],
            'address'=>$data['address'],
            'country_id'=>$data['country'],
            'city_id'=>$data['city'],
            'state_id'=>$data['state'],
            'zip'=>$data['zip'],
            'notes'=>$data['note'],
            'created_at'=>Carbon::now(),
        ]);
        
        $carts = CartList::where('customer_id', Auth::guard('customerlogin')->id())->get();
        foreach ($carts as $cart) {
            orderProduct::insert([
                'order_id'=>$order_id,
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


        Mail::to($data['mail'])->send(new MailInvoiceMail($order_id));

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
      

        // Session::flash('success', 'Payment successful!');

              

        return redirect('/success');

    }

}