<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'specialization',
        'profile_photo',
        'password'
    ];
}
