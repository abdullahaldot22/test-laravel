<?php

namespace App\Http\Controllers;

use Image;
use Illuminate\Http\Request;
use App\Models\CustomerLogin;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class customerProfileController extends Controller
{
    function customer_profile_update(Request $request) {
        // print_r($request->all());
        echo '<br>';
        
        // echo $current_pass;
        // die;
        if ($request->cpass == '' && $request->newpass == '') {
            if ($request->image == '') {
                CustomerLogin::where('id', Auth::guard('customerlogin')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'country'=>$request->country,
                    'phone'=>$request->mobile,
                    'address'=>$request->address,
                ]);
            }
            else{
                $pimage = $request->image;
                $ext = $pimage->getClientOriginalExtension();
                $fname = 'customer-'.Auth::guard('customerlogin')->id().'.'.$ext;

                Image::make($pimage)->save(public_path('uploads/customer/'.$fname));

                CustomerLogin::find(Auth::guard('customerlogin')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'country'=>$request->country,
                    'phone'=>$request->mobile,
                    'address'=>$request->address,
                    'profile_image' => $fname,
                ]);
            }
            return back();
            // echo 'password not found';
        }
        else{
            $current_pass = Auth::guard('customerlogin')->user()->password;
            echo $current_pass . '<br>';
            echo bcrypt($request->cpass);
            if (Hash::check($request->cpass, $current_pass)) {
                if ($request->image == '') {
                    CustomerLogin::where('id', Auth::guard('customerlogin')->id())->update([
                        'name'=>$request->name,
                        'email'=>$request->email,
                        'country'=>$request->country,
                        'phone'=>$request->mobile,
                        'address'=>$request->address,
                        'password'=>bcrypt($request->newpass),
                    ]);
                }
                else{
                    $pimage = $request->image;
                    $ext = $pimage->getClientOriginalExtension();
                    $fname = 'customer-'.Auth::guard('customerlogin')->id().'.'.$ext;
    
                    Image::make($pimage)->save(public_path('uploads/customer/'.$fname));
    
                    CustomerLogin::find(Auth::guard('customerlogin')->id())->update([
                        'name'=>$request->name,
                        'email'=>$request->email,
                        'country'=>$request->country,
                        'phone'=>$request->mobile,
                        'address'=>$request->address,
                        'profile_image' => $fname,
                        'password'=>bcrypt($request->newpass),
                    ]);
                }
                return back();
            }
            else {
                return back()->with('error', 'Your given password doesnt match our record !');
                
            }
            
            return back();
        }
    }
}
