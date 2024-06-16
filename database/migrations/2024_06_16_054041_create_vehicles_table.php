<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->string('license_plate', 20)->primary();
            $table->string('id_driver', 20);
            $table->foreign('id_driver')->references('id_driver')->on('drivers');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
