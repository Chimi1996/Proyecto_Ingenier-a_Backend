<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\smsController;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/ObtenerViajes',[ApiController::class,'ObtenerViajes']);
Route::get('/ObtenerUsuarios',[ApiController::class,'ObtenerUsuarios']);
Route::get('/ObtenerConductores',[ApiController::class,'ObtenerConductores']);
Route::get('/ObtenerPasajeros',[ApiController::class,'ObtenerPasajeros']);
Route::post('/CrearUsuario',[ApiController::class,'CrearUsuario']);
Route::post('/acceptTrip', [ApiController::class, 'acceptTrip']);
Route::post('/CrearVehiculo', [ApiController::class, 'CrearVehiculo']);
Route::get('/ObtenerVehiculos',[ApiController::class,'ObtenerVehiculos']);
Route::get('/ObtenerViajesEnEspera',[ApiController::class,'ObtenerViajesEnEspera']);

Route::post('/sendSms',[ApiController::class, 'sendSms']);
Route::post('/verifycode', [ApiController::class, 'verifyCode']);