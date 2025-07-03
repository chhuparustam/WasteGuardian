<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class DriverModel extends Model
{
    use HasFactory;
    protected $table = "users";
    protected $guarded = ['id'];

    // public function driver()
    // {
    //     return $this->belongsTo(DriverModel::class, 'user');
    // }
}
