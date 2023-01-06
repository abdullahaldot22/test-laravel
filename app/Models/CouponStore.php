<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponStore extends Model
{
    use HasFactory;

    function rel_user(){
        return $this->belongsTo(User::class, 'added_by');
    }
}
