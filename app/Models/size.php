<?php

namespace App\Models;

use App\Models\subcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class size extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function rel_to_scat(){
        return $this->belongsTo(subcategory::class, 'subcategory_id');
    }

    // function relto_subcata(){
    //     return $this->belongsTo(subcategory::class, 'scat_id');
    // }
}
