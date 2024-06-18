<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Driver;
use App\Models\Passenger;
use App\Models\Trip;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleDetail;
use Illuminate\Support\Facades\Hash;


class ApiController extends Controller
{

    public function ObtenerViajes()
    {
        $Trips = Trip::all();

        return response()->json($Trips);
    }

    public function ObtenerViaje()
    {
        $Trips = Trip::all();

        return response()->json($Trips);
    }





    
}