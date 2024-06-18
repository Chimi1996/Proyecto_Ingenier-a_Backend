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
    public function ObtenerDriver()
    {
        $Driver = Driver::all();

        return response()->json($Driver);
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
    public function CrearVehiculo(Request $request)
    {
        try {
            // Obtener los datos del request
            $license_plate = $request->input('license_plate');
            $id_driver = $request->input('id_driver');
            $brand = $request->input('brand');
            $model = $request->input('model');
            $year = $request->input('year');
            $color = $request->input('color');
            // Crear el registro en la tabla 'vehicles'
            $vehicle = new Vehicle();
            $vehicle->license_plate = $license_plate;
            $vehicle->id_driver = $id_driver;
            $vehicle->save();

            // Crear el registro en la tabla 'vehicle_details'
            $vehicleDetail = new VehicleDetail();
            $vehicleDetail->id_detail = $license_plate; // Puedes usar el número de placa como id_detail
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
}