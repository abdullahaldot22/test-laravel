<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\CustomerLogin;
use App\Models\customerEmailVerify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Notification;
use App\Notifications\customerEmailVerifyNotification;

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
        $request->validate([
            'name'=>'required|min:5',
            'email'=>'required|email|unique:customer_login,email',
            'password'=>'required|min:8',
            'password_confirmation'=>'required|min:8',
        ]);
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

    function redirectToGithub(){
        // $user = CustomerLogin::where('email',$data->email)->first();
        //     if(!$user){
        //         $user = new CustomerLogin();
        //         $user->name = $data->name;
        //         $user->email = $data->email;
        //         $user->provider_id = $data->id;
        //         $user->avatar = $data->avatar;
        //         $user->save();
        //     }
        // Auth::login($user);
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback(){
        $user = Socialite::driver('github')->user();
        $finduser = CustomerLogin::where('github_id', $user->id)->first();
        if($finduser){
            Auth::guard('customerlogin')->login($finduser);
            return redirect(route('customer.home'));
        }else{
            $newUser = CustomerLogin::updateOrCreate(['email' => $user->email],[
                'name' => $user->name,
                'email_verify_at' => Carbon::now(),
                'github_id'=> $user->id,
                'password' => encrypt('123456dummy')
            ]);
            Auth::guard('customerlogin')->login($newUser);
            return redirect()->route('customer.home');
        }
    }

}
