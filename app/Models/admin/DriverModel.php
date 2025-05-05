<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class DriverModel extends Model
{
    use HasFactory;
    protected $table = "drivers";
    protected $fillable = ['name', 'email', 'phone', 'address','password'];
    public function driver()
    {
        return $this->belongsTo(DriverModel::class, 'driver_id');
    }
}
