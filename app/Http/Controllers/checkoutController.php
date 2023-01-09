<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

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
        print_r($request->all());
    }
}
