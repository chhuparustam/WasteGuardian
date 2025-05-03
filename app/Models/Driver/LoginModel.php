<?php

namespace App\Models\Driver;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginModel extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'address', 'password'];

}
