<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->string('id_driver', 20)->primary();
            $table->string('phone_number', 20);
            $table->string('driver_current_location', 50);
            $table->foreign('phone_number')->references('phone_number')->on('users');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('drivers');
    }
}
