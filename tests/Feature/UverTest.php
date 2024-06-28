<?php

use App\Models\User;
use App\Models\Trip;
use App\Models\Driver;
use App\Models\Passenger;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    
});

it('can get waiting trips', function () {
    $trip = Trip::factory()->create(['trip_status' => 'En espera']);

    $response = $this->getJson('/api/ObtenerViajesEnEspera');

    $response->assertStatus(200)
        ->assertJsonFragment(['trip_status' => 'En espera']);
});

it('can get all users', function () {
    $users = User::factory()->count(3)->create();

    $response = $this->getJson('/api/ObtenerUsuarios');

    $response->assertStatus(200)
        ->assertJsonCount(3);
});

it('can get all drivers', function () {
    $drivers = Driver::factory()->count(3)->create();

    $response = $this->getJson('/api/ObtenerConductores');

    $response->assertStatus(200)
        ->assertJsonCount(3);
});

it('can get all passengers', function () {
    $passengers = Passenger::factory()->count(3)->create();

    $response = $this->getJson('/api/ObtenerPasajeros');

    $response->assertStatus(200)
        ->assertJsonCount(3);
});

it('can create a user', function () {
    $data = [
        'phone_number' => '1234567890',
        'first_name' => 'John',
        'middle_name' => 'Doe',
        'last_name' => 'Smith',
        'second_last_name' => 'Johnson',
        'password' => 'password',
        'user_type' => 'driver'
    ];

    $response = $this->postJson('/api/CrearUsuario', $data);

    $response->assertStatus(200)
        ->assertJsonFragment(['message' => 'Usuario creado con éxito']);

    $this->assertDatabaseHas('users', ['phone_number' => '1234567890']);
    $this->assertDatabaseHas('drivers', ['phone_number' => '1234567890']);

    $this->assertDatabaseHas('users', [
        'phone_number' => '1234567890',
        'first_name' => 'John',
        'last_name' => 'Doe',
        'user_type' => 'driver'
    ]);
});

it('can create a vehicle', function () {
    $user = User::factory()->create(['phone_number' => '1234567890']);
    $driver = Driver::factory()->create(['phone_number' => '1234567890']);

    $data = [
        'phone_number' => '1234567890',
        'license_plate' => 'ABC123',
        'brand' => 'Toyota',
        'model' => 'Corolla',
        'year' => '2020',
        'color' => 'Blue',
    ];

    $response = $this->postJson('/api/CrearVehiculo', $data);

    $response->assertStatus(200)
        ->assertJsonFragment(['message' => 'Vehículo y detalles creados con éxito']);

    $this->assertDatabaseHas('vehicles', ['license_plate' => 'ABC123']);
    $this->assertDatabaseHas('vehicle_details', ['license_plate' => 'ABC123']);
});

it('can create a trip', function () {
    $user = User::factory()->create(['phone_number' => '1234567890']);
    $passenger = Passenger::factory()->create(['phone_number' => '1234567890']);
    
    $data = [
        'phone_number' => '1234567890',
        'start_point' => 'Point A',
        'end_point' => 'Point B',
    ];

    $response = $this->postJson('/api/CrearViaje', $data);

    $response->assertStatus(200)
        ->assertJsonFragment(['message' => 'Viaje creado con éxito']);

    $this->assertDatabaseHas('trips', [
        'id_passenger' => $passenger->id_passenger,
        'start_point' => 'Point A',
        'end_point' => 'Point B',
    ]);
});
