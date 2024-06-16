<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $primaryKey = 'license_plate';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'license_plate', 'id_driver'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'id_driver', 'id_driver');
    }

    public function details()
    {
        return $this->hasOne(VehicleDetail::class, 'license_plate', 'license_plate');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class, 'license_plate', 'license_plate');
    }
}
