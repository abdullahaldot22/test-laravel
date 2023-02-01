<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class customerProfileController extends Controller
{
    function customer_profile_update(Request $request) {
        print_r($request->all());
        echo '<br>';
        if ($request->cpass == '' && $request->newpass == '') {
            if ($request->image == '') {
                echo 'image not found';
            }
            else{
                echo 'image found';
            }
        }
        else{
            echo 'password found';
        }
    }
}
