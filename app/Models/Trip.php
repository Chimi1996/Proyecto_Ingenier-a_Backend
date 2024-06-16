<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_trip';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_trip', 'id_passenger', 'id_driver', 'license_plate', 'start_point', 'end_point', 'start_datetime', 'end_datetime', 'fare', 'trip_status', 'rating'
    ];

    public function passenger()
    {
        return $this->belongsTo(Passenger::class, 'id_passenger', 'id_passenger');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'id_driver', 'id_driver');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'license_plate', 'license_plate');
    }
}
