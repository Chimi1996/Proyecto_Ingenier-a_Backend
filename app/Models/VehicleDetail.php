<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_detail';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_detail', 'license_plate', 'brand', 'model', 'year', 'color'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'license_plate', 'license_plate');
    }
}
