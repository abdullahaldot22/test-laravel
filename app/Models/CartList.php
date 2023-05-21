<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartList extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    function rel_to_product() {
        return $this->belongsTo(product::class, 'product_id');
    }
    function rel_to_color() {
        return $this->belongsTo(color::class, 'color_id');
    }
    function rel_to_size() {
        return $this->belongsTo(size::class, 'size_id');
    }
}
 