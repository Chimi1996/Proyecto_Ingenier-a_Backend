<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->string('id_trip', 20)->primary();
            $table->string('id_passenger', 20);
            $table->string('id_driver', 20);
            $table->string('license_plate', 20);
            $table->string('start_point', 50);
            $table->string('end_point', 50);
            $table->date('start_datetime');
            $table->date('end_datetime')->nullable();
            $table->double('fare');
            $table->string('trip_status', 40);
            $table->double('rating')->nullable();
            $table->foreign('id_passenger')->references('id_passenger')->on('passengers');
            $table->foreign('id_driver')->references('id_driver')->on('drivers');
            $table->foreign('license_plate')->references('license_plate')->on('vehicles');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
