<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_driver';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_driver', 'id_user', 'driver_current_location'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'id_driver', 'id_driver');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class, 'id_driver', 'id_driver');
    }
}
