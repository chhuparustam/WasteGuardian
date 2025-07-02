<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; 
 

class PickupRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'landmark',
        'photo',
        'message',
        'driver_id', 
        'status',    
    ];
    
    protected $table = 'requests'; 

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
