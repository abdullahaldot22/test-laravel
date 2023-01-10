<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\size;
use App\Models\color;
use App\Models\product;
use App\Models\category;
use App\Models\inventory;
use App\Models\thumbnail;
use App\Models\subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Ramsey\Collection\Collection;


use Intervention\Image\Facades\Image;

class productcontroller extends Controller
{

    function product_list(){
        $products = product::all();
        $temp = thumbnail::all();
        return view('admin.product.list', [
            'products'=>$products,
            'temp'=>$temp,
        ]);
    }

    function product(){
        $cat = category::all();
        $scat = subcategory::all();
        return view('admin.product.add_product', [
            'cat'=>$cat,
            'scat'=>$scat,
        ]);
    }

    function getscat(Request $request){
        $str = '<option>Select Subcategory</option>';
        $subcat = subcategory::where('category_id', $request->cid)->get();
        foreach ($subcat as $key => $scat) {
            $str .= "<option value='$scat->id'>$scat->subcategory_name</option>";
        }
        echo $str;
    }

    function product_store(Request $request){

        $product_id = product::insertGetId([
            'category_id'=>$request->cat_id,
            'subcategory_id'=>$request->scat_id,
            'product_name'=>$request->name,
            'slug'=>str_replace(' ', '', Str::lower($request->name)).'_'.rand(111111, 999999999999).'_'.$request->_token,
            'price'=>$request->price,
            'discount'=>$request->discount,
            'after_discount'=>((int)($request->price-($request->price*$request->discount/100))),
            'brand'=>$request->brand,
            'coupon_applicability'=>$request->cp_discount_applicability,
            'charge_ic'=>$request->charge_ic,
            'charge_oc'=>$request->charge_oc,
            'short_description'=>$request->short_des,
            'long_description'=>$request->long_des,
            'preview'=>$request->preview,
            'created_at'=>Carbon::now(),
        ]);

        $img = $request->preview;
        $ext = $img->getClientOriginalExtension();
        $fname = Str::lower(str_replace(' ', '', $request->name)).'_'.rand(1111111, 9999999999).'.'.$ext;
        Image::make($img)->resize(400, 460)->save(public_path('uploads/product/preview/'.$fname));
        product::find($product_id)->update([
            'preview'=>$fname,
        ]);
        

        $thumb = $request->thumbnail;
        foreach($thumb as $thumb){
            $ext = $thumb->getClientOriginalExtension();
            $fname = Str::lower(str_replace(' ', '', $request->name)).'_'.rand(1111, 99999999).'.'.$ext;
            Image::make($thumb)->resize(460, 400)->save(public_path('uploads/product/thumbnail/'.$fname));

                thumbnail::insert([
                    'product_id'=>$product_id,
                    'thumbnail'=>$fname,
                ]);
        }

        

        return back();
    }

    function color_store(Request $request){
        color::insert([
            'color_name'=>$request->cname,
            'color_code'=>$request->ccode,
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }

    function size_store(Request $request){
        size::insert([
            'product_size'=>$request->sname,
            'subcategory_id'=>$request->scat_id,
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }

    function product_variation(){
        $color = color::all();
        $size = size::all();
        $scat = subcategory::all();
        return view('admin.product.variation', [
            'color'=>$color,
            'size'=>$size,
            'scat'=>$scat,
        ]);
    }

    function product_inventory($pro_id){
        $color = color::orderBy('color_name')->get();
        $size = size::all();
        $product_info = product::find($pro_id);
        $inventory = inventory::where('product_id', $pro_id)->get();
        return view('admin.product.inventory', [
            'color'=>$color,
            'size'=>$size,
            'info'=>$product_info,
            'ivpro'=>$inventory,
        ]);
    }

    function product_delete($id) {
        $delete_pre = product::where('id', $id)->first()->preview;
        $delete_from_pre = public_path('uploads/product/preview/'.$delete_pre);
        unlink($delete_from_pre);

        $delete_tmp = thumbnail::where('product_id', $id)->get();
        foreach($delete_tmp as $temp){
            $delete_tmp = $temp->thumbnail;
            $delete_from_tem = public_path('uploads/product/thumbnail/'.$delete_tmp);
            unlink($delete_from_tem);
        }
        inventory::where('product_id', $id)->delete();
        product::find($id)->delete();
        return back();
    }

    function inventory_add(Request $request){
        inventory::insert([
            'product_id'=>$request->product_id,
            'color_id'=>$request->color_id,
            'size_id'=>$request->size_id,
            'quantity'=>$request->quantity,
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }
}
