<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller
{
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
}
