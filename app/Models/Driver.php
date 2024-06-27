<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Trip;

class Driver extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_driver';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_driver', 'phone_number', 'driver_current_location'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'phone_number', 'phone_number');
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'id_driver', 'id_driver');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class, 'id_driver', 'id_driver');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_driver)) {
                // Generar un valor único (por ejemplo, un UUID)
                $model->id_driver = Str::uuid()->toString();
            }
        });
    }
}
