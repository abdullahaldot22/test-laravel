<?php

namespace App\Http\Controllers;
use App\Models\category;
use App\Models\subcategory;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Str;
use Image;

class subcategorycontroller extends Controller
{
    function subcat(){
        $cat = category::all();
        $trash = subcategory::onlyTrashed()->get();
        $scat = subcategory::all();
        return view('admin.subcategory.subcategory', [
            'cat' => $cat,
            'scat' => $scat,
            'trash' => $trash,
        ]);
    }

    function scat_add(Request $request){
        $scat_id = subcategory::insertGetId([
            'category_id'=>$request->cat_id,
            'subcategory_image'=>$request->scat_img,
            'subcategory_name'=>$request->scat_name,
            'created_at'=>Carbon::now(),
        ]);

        $scatname = $request->scat_name;
        $ext = $request->scat_img->getClientOriginalExtension();
        $filename = Str::lower($scat_id.'_'.str_replace(' ', '_', $request->scat_name)).'_'.rand(111111, 999999).'.'.$ext;

        Image::make($request->scat_img)->save(public_path('uploads/subcategory/'.$filename));

        subcategory::find($scat_id)->update([
            'subcategory_image'=>$filename,
        ]);

        return back();
    }

    function scat_edit($scat_id){
        $cat = category::all();
        $scat = subcategory::find($scat_id);
        return view('admin.subcategory.edit', [
            'cat'=>$cat,
            'scat'=>$scat,
        ]);
    }

    function scat_update(Request $request){


        if (subcategory::where('id', $request->scat_id)->where('subcategory_name', $request->scat_name)->exists()) {
            if ($request->scat_img == "") {
                subcategory::find($request->scat_id)->update([
                    'subcategory_name'=>$request->scat_name,
                ]);
                return back();
            }
            else{
                $scat_img = subcategory::find($request->scat_id)->subcategory_image;
                $delete_from = public_path('uploads/subcategory/'.$scat_img);
                unlink($delete_from);
                
                $id = $request->scat_id;
                $imgfile = $request->scat_img;
                $scatname = $request->scat_name;
                $ext = $imgfile->getClientOriginalExtension();
                $filename = Str::lower($id.'_'.str_replace(' ', '_', $scatname)).'_'.rand(111111, 999999).'.'.$ext;
    
    
                Image::make($imgfile)->save(public_path('uploads/subcategory/'.$filename));
    
                subcategory::find($id)->update([
                    'subcategory_image' => $filename,
                    'subcategory_name'=>$request->scat_name,
                ]);
                
                return back();
            }
        }
        else {
            if (subcategory::where('subcategory_name', $request->scat_name)->exists()) {
                return back()->with('found', 'Its already exist in the category! So, try with a new one!');
            }
            else{
                if ($request->scat_img == "") {
                    category::find($request->scat_id)->update([
                        'subcategory_name'=>$request->scat_name,
                    ]);
                    return back();
                }
                else{
                    $scat_img = subcategory::find($request->scat_id)->subcategory_image;
                    $delete_from = public_path('uploads/subcategory/'.$scat_img);
                    unlink($delete_from);
                    
                    $id = $request->scat_id;
                    $imgfile = $request->scat_img;
                    $scatname = $request->scat_name;
                    $ext = $imgfile->getClientOriginalExtension();
                    $filename = Str::lower($id.'_'.str_replace(' ', '_', $scatname)).'_'.rand(111111, 999999).'.'.$ext;
        
        
                    Image::make($imgfile)->save(public_path('uploads/subcategory/'.$filename));
        
                    subcategory::find($id)->update([
                        'subcategory_image' => $filename,
                        'subcategory_name'=>$request->scat_name,
                    ]);
                    
                    return back();
                }
            }
        }

// =========================================================================================================

        // subcategory::find($request->scat_id)->update([
        //     'category_id'=>$request->cat_id,
        //     'subcategory_name'=>$request->scat_name,
        //     'subcategory_image'=>$request->scat_img,
        // ]);
        return back();
    }

    function scat_sdel($scat_id){
        subcategory::find($scat_id)->delete();
        return back();
    }

    function scat_rstr($scat_id){
        subcategory::onlyTrashed()->find($scat_id)->restore();
        return back();
    }

    function scat_fdel($scat_id){
        subcategory::onlyTrashed()->find($scat_id)->forceDelete();
        return back();
    }
}
