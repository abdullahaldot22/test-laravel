<?php

namespace App\Http\Controllers;

use App\Models\customerEmailVerify;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\CustomerLogin;
use App\Notifications\customerEmailVerifyNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules\Unique;

class CustomerRegisterController extends Controller
{

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        // return request()->ip(); // it will return the server IP if the client IP is not found using this method.
    }

    function user_register(Request $request) {
        $new_customer = CustomerLogin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now(),
        ]);

        $customer_mail_varify_info = customerEmailVerify::create([
            'customer_id' => $new_customer->id,
            'token' => uniqid(),
            'ip' => request()->ip(),
        ]);

        $token = $customer_mail_varify_info->token;
        Notification::send($new_customer, new customerEmailVerifyNotification($token));

        // if (Auth::guard('customerlogin')->attempt(['email' => $request->email, 'password' => $request->password])) {
        //     return redirect('/');
        // }
        return back()->with('reg_message', 'Customer Registered Successfully! Check your mail first to verify it!');
    }
}
