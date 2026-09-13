<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $table = 'users'; 
    protected $guarded = ['id']; 
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'specialization', 'photo', 'password'
    ];
}
