<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassengersTable extends Migration
{
    
    public function up()
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->string('id_passenger', 20)->primary();
            $table->string('id_user', 20);
            $table->string('passenger_current_location', 50);
            $table->foreign('id_user')->references('id_user')->on('users');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('passengers');
    }
}
