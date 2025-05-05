<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupRequest extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'landmark', 'photo', 'message'];
    
    protected $table = 'requests'; 
}
