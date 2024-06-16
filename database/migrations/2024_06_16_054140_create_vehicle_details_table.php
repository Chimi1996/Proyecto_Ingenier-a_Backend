<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleDetailsTable extends Migration
{
    
    public function up()
    {
        Schema::create('vehicle_details', function (Blueprint $table) {
            $table->string('id_detail', 20)->primary();
            $table->string('license_plate', 20);
            $table->string('brand', 20);
            $table->string('model', 20);
            $table->integer('year');
            $table->string('color', 20);
            $table->foreign('license_plate')->references('license_plate')->on('vehicles');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('vehicle_details');
    }
}
