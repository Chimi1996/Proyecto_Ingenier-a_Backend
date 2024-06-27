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
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;

class ApiController extends Controller
{

    public function ObtenerViajes()
    {
        $Trips = Trip::all();

        return response()->json($Trips);
    }

    public function ObtenerViajesEnEspera()
    {
        $Trips = Trip::where('trip_status', 'En espera')->get();

        return response()->json($Trips);
    }

    public function ObtenerVehiculos()
    {
        $vehicles = Vehicle::all();

        return response()->json($vehicles);
    }
  
    public function acceptTrip(Request $request)
    {
        try {
            $request->validate([
                'id_trip' => 'required|string',
                'id_driver' => 'required|string',
            ]);  
            $trip = Trip::find($request->id_trip);

            if (!$trip) {
                return response()->json(['error' => 'Trip not found'], 404);
            }

            $trip->id_driver = $request->id_driver;
            $trip->trip_status = 'Accepted';
            $trip->save();

            return response()->json(['message' => 'Viaje aceptado exitosamente', 'trip' => $trip], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
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
            $phone_number = $request->input('phone_number');
            $first_name = $request->input('first_name');
            $middle_name = $request->input('middle_name');
            $last_name = $request->input('last_name');
            $second_last_name = $request->input('second_last_name');
            $password = $request->input('password');
            $user_type = $request->input('user_type');

            $user = new User();
            $user->phone_number = $phone_number;
            $user->first_name = $first_name;
            $user->middle_name = $middle_name;
            $user->last_name = $last_name;
            $user->second_last_name = $second_last_name;
            $user->password = $password;
            $user->user_type = $user_type;
            $user->save();

            if ($user_type === 'driver') {
                $Driver = Driver::factory()->create();
                $Driver->phone_number = $phone_number;
                $Driver->save();
            }else {
                $Passenger = Passenger::factory()->create();
                $Passenger->phone_number = $phone_number;
                $Passenger->save();
            }
            
            
            return response()->json(['message' => 'Usuario creado con éxito'], 200);
        } catch (\Exception $e) {
            // Manejo de errores generales
            return response()->json(['error' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
    }
    
  
    public function CrearVehiculo(Request $request)
    {
        try {

            $license_plate = $request->input('license_plate');
            $id_driver = $request->input('id_driver');
            $brand = $request->input('brand');
            $model = $request->input('model');
            $year = $request->input('year');
            $color = $request->input('color');
            
            $vehicle = new Vehicle();
            $vehicle->license_plate = $license_plate;
            $vehicle->id_driver = $id_driver;
            $vehicle->save();

            
            $vehicleDetail = new VehicleDetail();
            $vehicleDetail->id_detail = $license_plate; 
            $vehicleDetail->license_plate = $license_plate;
            $vehicleDetail->brand = $brand;
            $vehicleDetail->model = $model;
            $vehicleDetail->year = $year;
            $vehicleDetail->color = $color;
            $vehicleDetail->save();

            return response()->json(['message' => 'Vehículo y detalles creados con éxito'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
    }

    public function sendSms(Request $request)
{
    // Validar los datos de entrada
    $validator = Validator::make($request->all(), [
        'country_code' => 'required|string|max:20',
        'phone_number' => 'required|string|max:20',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    $countryCode = $request->input('country_code');
    $phoneNumber = $request->input('phone_number');

    $to = '+' . $countryCode . $phoneNumber;

    $verificationCode = strval(mt_rand(100000, 999999));

    $messageBody = "Tu código de verificación es: " . $verificationCode;

    $sid = env("TWILIO_SID");
    $token = env("TWILIO_TOKEN");
    $from = env("TWILIO_PHONE");

    $twilio = new Client($sid, $token);

    try {
        
        $message = $twilio->messages->create($to, [
            'body' => $messageBody,
            'from' => $from
        ]);

        $user = User::where('phone_number', $phoneNumber)
                    ->where('country_code', $countryCode)
                    ->first();

        if ($user) {
            
            $user->authy_id = $verificationCode;
            $user->save();
        } else {
            $newUser = new User();
            $newUser->phone_number = $phoneNumber;
            $newUser->country_code = $countryCode;
            $newUser->authy_id = $verificationCode;
            $newUser->save();
        }

        return response()->json(['message' => 'Código de verificación enviado con éxito']);
    } catch (\Twilio\Exceptions\RestException $e) {
        return response()->json(['error' => 'Error al enviar el mensaje: ' . $e->getMessage()], 500);
    }
}
    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'verification_code' => 'required|string|size:6', // El código debe ser de 6 dígitos
            'phone_number' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $verificationCode = $request->input('verification_code');
        $phoneNumber = $request->input('phone_number');

        $user = User::where('phone_number', $phoneNumber)->first();

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        if ($user->authy_id === $verificationCode) {
            
            $user->verified = true;
            $user->save();

            return response()->json(['message' => 'Código verificado correctamente']);
        } else {
            return response()->json(['error' => 'Código de verificación incorrecto'], 400);
        }
    }

    public function login(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $phoneNumber = $request->input('phone_number');

        $user = User::where('phone_number', $phoneNumber)->first();

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'user' => $user
        ]);
    }
}