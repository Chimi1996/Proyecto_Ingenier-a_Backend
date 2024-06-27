<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Passenger extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_passenger';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_passenger', 'phone_number', 'passenger_current_location'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'phone_number', 'phone_number');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class, 'id_passenger', 'id_passenger');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_passenger)) {
                // Generar un valor único (por ejemplo, un UUID)
                $model->id_passenger = Str::uuid()->toString();
            }
        });
    }
}
