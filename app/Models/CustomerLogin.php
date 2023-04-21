<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CustomerLogin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];

    protected $guard = 'customerlogin';

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function rel_to_opro() {
        return $this->hasMany(orderProduct::class, 'customer_id');
    }
}
