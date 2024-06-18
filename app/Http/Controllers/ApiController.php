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

    public function ObtenerUsuarios()
    {
        $Users = User::all();

        return response()->json($Users);
    }

    public function ObtenerConductores()
    {
        $Drivers = Driver::all();

        return response()->json($Drivers);
    }

    public function ObtenerPasajeros()
    {
        $Passengers = Passenger::all();

        return response()->json($Passengers);
    }

    public function CrearUsuario(Request $request)
    {
        try {
            $id_User = $request->input('id_User');
            $first_name = $request->input('first_name');
            $middle_name = $request->input('middle_name');
            $last_name = $request->input('last_name');
            $second_last_name = $request->input('second_last_name');
            $password = $request->input('password');
            $phone_number = $request->input('phone_number');
            $user_type = $request->input('user_type');

            $User = new User();
            $User->id_User = $id_User;
            $User->first_name = $first_name;
            $User->middle_name = $middle_name;
            $User->last_name = $last_name;
            $User->second_last_name = $second_last_name;
            $User->password = $password;
            $User->phone_number = $phone_number;
            $User->user_type = $user_type;
            $User->save();

            if ($user_type === 'driver') {
                $Driver = Driver::factory()->create();
                $Driver->id_user = $id_User;
                $Driver->save();
            }else {
                $Passenger = Passenger::factory()->create();
                $Passenger->id_user = $id_User;
                $Passenger->save();
            }
            
            
            return response()->json(['message' => 'Usuario creado con éxito'], 200);
        } catch (\Exception $e) {
            // Manejo de errores generales
            return response()->json(['error' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
    }



    
}