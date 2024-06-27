<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'phone_number'; // Cambiando la clave primaria a phone_number
    public $incrementing = false; // Indicando que no es autoincremental
    protected $keyType = 'string'; // Especificando el tipo de clave

    protected $fillable = [
        'phone_number', 'first_name', 'middle_name', 'last_name', 'second_last_name', 'password',
        'country_code', 'authy_id', 'verified', 'user_type'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'verified' => 'boolean',
    ];

    public function driver()
    {
        return $this->hasOne(Driver::class, 'phone_number', 'phone_number'); // Ajustando las relaciones
    }

    public function passenger()
    {
        return $this->hasOne(Passenger::class, 'phone_number', 'phone_number'); // Ajustando las relaciones
    }
}