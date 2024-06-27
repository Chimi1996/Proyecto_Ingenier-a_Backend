<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('phone_number', 20)->primary(); // Utilizando phoneNumber como primary key
            $table->string('first_name', 20)->nullable();
            $table->string('middle_name', 20)->nullable();
            $table->string('last_name', 20)->nullable();
            $table->string('second_last_name', 20)->nullable();
            $table->string('password', 20)->nullable();
            
            $table->string('country_code', 20)->nullable();
            $table->string('authy_id', 20)->nullable(); // El código que se genera para validar el número
            $table->boolean('verified')->default(false);
            
            $table->string('user_type', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
