<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\category;
use Image;
use Str;

class CategoryController extends Controller
{
    function category(){
        $categories = category::all();
        $trash = category::onlyTrashed()->get();
        // echo $categories;
        return view('admin.category.category', [
            'cat'=>$categories,
            'trash'=>$trash,
        ]);
    }

    function category_add(Request $request){

        $request->validate([
            'category_name' => 'required|unique:categories',
            'category_image' => 'required',
        ]);

        $category_id = category::insertGetId([
            'category_name' => $request->category_name,
            'added_by' => Auth::id(),
        ]);

        $imgfile = $request->category_image;
        $catname = $request->category_name;
        $ext = $imgfile->getClientOriginalExtension();
        $filename = Str::lower($category_id.'_'.str_replace(' ', '_', $catname)).'_'.rand(111111, 999999).'.'.$ext;


        Image::make($imgfile)->save(public_path('uploads/category/'.$filename));

        category::find($category_id)->update([
            'category_image' => $filename,
        ]);

        return back();
    }

    function cat_sdel($cat_id){
        category::find($cat_id)->delete();
        return back();
    }

    function cat_rstr($cat_id){
        category::onlyTrashed()->find($cat_id)->restore();
        return back();
    }

    function cat_fdel($cat_id){
        // $cat_img = category::where('id', $cat_id)->get($cat_id); [error]

        $cat_img = category::onlyTrashed()->find($cat_id)->category_image;
        $delete_from = public_path('uploads/category/'.$cat_img);
        unlink($delete_from);
        category::onlyTrashed()->find($cat_id)->forceDelete();
        return back();
    }

    function cat_edit($cat_id){
        $cat = category::find($cat_id);
        return view('admin.category.cat_edit', [
            'cat_all' => $cat,
            // 'to the name send' => the variabel name in this funciton, 
        ]);
    }

    function cat_update(Request $request){
        // print_r($request->all());
        
        if (category::where('id', $request->cat_id)->where('category_name', $request->cat_name)->exists()) {
            if ($request->cat_img == "") {
                category::find($request->cat_id)->update([
                    'category_name'=>$request->cat_name,
                ]);
                return back();
            }
            else{
                $cat_img = category::find($request->cat_id)->category_image;
                $delete_from = public_path('uploads/category/'.$cat_img);
                unlink($delete_from);
                
                $id = $request->cat_id;
                $imgfile = $request->cat_img;
                $catname = $request->cat_name;
                $ext = $imgfile->getClientOriginalExtension();
                $filename = Str::lower($id.'_'.str_replace(' ', '_', $catname)).'_'.rand(111111, 999999).'.'.$ext;
    
    
                Image::make($imgfile)->save(public_path('uploads/category/'.$filename));
    
                category::find($id)->update([
                    'category_image' => $filename,
                ]);
                
                return back();
            }
        }
        else {
            if (category::where('category_name', $request->cat_name)->exists()) {
                return back()->with('found', 'Its already exist in the category! So, try with a new one!');
            }
            else{
                if ($request->cat_img == "") {
                    category::find($request->cat_id)->update([
                        'category_name'=>$request->cat_name,
                    ]);
                    return back();
                }
                else{
                    $cat_img = category::find($request->cat_id)->category_image;
                    $delete_from = public_path('uploads/category/'.$cat_img);
                    unlink($delete_from);
                    
                    $id = $request->cat_id;
                    $imgfile = $request->cat_img;
                    $catname = $request->cat_name;
                    $ext = $imgfile->getClientOriginalExtension();
                    $filename = Str::lower($id.'_'.str_replace(' ', '_', $catname)).'_'.rand(111111, 999999).'.'.$ext;
        
        
                    Image::make($imgfile)->save(public_path('uploads/category/'.$filename));
        
                    category::find($id)->update([
                        'category_image' => $filename,
                    ]);
                    
                    return back();
                }
            }
        }
        
        
        
        
    }
}
