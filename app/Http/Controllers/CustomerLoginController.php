<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\passReset;
use Illuminate\Http\Request;
use App\Models\CustomerLogin;
use App\Notifications\passResetNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class CustomerLoginController extends Controller
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

    function user_login(Request $request) {

        if (Auth::guard('customerlogin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/');
        }
        else{
            return back()->with('log_error', 'wrong information provided!');
        }
    }

    function user_logout() {
        Auth::guard('customerlogin')->logout();
        return redirect()->route('customer.home');
    }

    function cpass_reset_request(Request $request) {
        $customer_info = CustomerLogin::where('email', $request->email)->firstOrFail();
        // return $customer_info;
        passReset::where('customer_id', $customer_info->id)->delete();
        $info = passReset::create([
            'customer_id' => $customer_info->id,
            'token' => uniqid(),
            'ip' => request()->ip(),
            // 'created_at' => Carbon::now(),
        ]);
        $token = $info->token;
        Notification::send($customer_info, new passResetNotification($token));
        return back()->with('log_error', 'We have sent password reset link to your mail, please check .. ');
    }

    function password_set(Request $request) {
        $info = passReset::where('token', $request->token)->firstOrFail();
        CustomerLogin::find($info->customer_id)->update([
            'password' => Hash::make($request->cpass),
        ]);

        passReset::find($info->id)->delete();
        return back()->with('log_error', 'Password reset successfullly!');
    }
}
