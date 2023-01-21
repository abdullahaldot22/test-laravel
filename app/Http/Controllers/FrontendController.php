<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\inventory;
use App\Models\product;
use App\Models\subcategory;
use App\Models\thumbnail;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Echo_;
use Str;

class FrontendController extends Controller
{
    function about() {
        return view('about');
    }

    function welcome(){
        return view('welcome');
    }

    function home() {
        $category = category::orderBy('category_name')->take(7)->get();
        $subcategory = subcategory::orderBy('subcategory_name')->take(12)->get();
        $product = product::take(8)->get();
        return view('frontend.index', [
            'cat'=>$category,
            'scat'=>$subcategory,
            'product'=>$product,
        ]);
    }

    function product_details($slug){
        $pro_info = product::where('slug', $slug)->get();
        $thumb = thumbnail::where('product_id', $pro_info->first()->id)->get();
        $releted_product = product::where('subcategory_id', $pro_info->first()->subcategory_id)->where('id', '!=', $pro_info->first()->id)->get();
        $in_color = inventory::where('product_id', $pro_info->first()->id)->groupBy('color_id')->selectRaw('sum(color_id) as sum, color_id')->get('sum','color_id');
        $in_size = inventory::where('product_id', $pro_info->first()->id)->groupBy('size_id')->selectRaw('sum(size_id) as sum, size_id')->get('sum','size_id');
     
        return view('frontend.product.details', [
            'pro_info'=>$pro_info,
            'thumb'=>$thumb,
            'sim_pro'=>$releted_product,
            'av_color'=>$in_color,
            'av_size'=>$in_size,
        ]);
    }

    function getsize(Request $request){
        $str = '';
        $sizes = inventory::where('product_id', $request->pro_id)->where('color_id', $request->color_id)->get();

        foreach($sizes as $itm){
            $str .= '<div class="form-check form-option size-option  form-check-inline mb-2">
                        <input class="form-check-input sesize" value="'.$itm->size_id.'" type="radio" name="size_id" id="large'.$itm->rel_size->id.'">
                        <label class="form-option-label" for="large'.$itm->rel_size->id.'">'.$itm->rel_size->product_size.'</label>
                    </div>';
        }
        
        echo $str;
    }

    function getavQuantity(Request $request){
        $quantity = inventory::where('product_id', $request->pro_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->get()->first()->quantity;
        $found = '';
        for ($i=1; $i <= $quantity; $i++) { 
            $found .=  '<option value="'.$i.'">'.$i.'</option>';
        }
        echo $found;
    }

    function invoice_check(){
        return view('mail.orderInvoice');
    }
}
