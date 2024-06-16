<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'id_user';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_user', 'first_name', 'middle_name', 'last_name', 'second_last_name', 'password', 'phone_number', 'user_type'
    ];

    public function driver()
    {
        return $this->hasOne(Driver::class, 'id_user', 'id_user');
    }

    public function passenger()
    {
        return $this->hasOne(Passenger::class, 'id_user', 'id_user');
    }
}