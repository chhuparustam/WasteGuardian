<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $table = 'users'; 
    protected $guarded = ['id']; 
}
