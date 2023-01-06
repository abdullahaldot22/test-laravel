<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    function rel_to_cat(){
        return $this->belongsTo(category::class, 'category_id');
    }
}
