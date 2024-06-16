<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_passenger';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_passenger', 'id_user', 'passenger_current_location'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class, 'id_passenger', 'id_passenger');
    }
}
