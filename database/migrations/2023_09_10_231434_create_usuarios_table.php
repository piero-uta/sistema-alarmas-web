<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {

            //TO DO revisar si necesita rut

            $table->id();
            $table->timestamps();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');   
            $table->boolean('activo')->default(true);

            $table->string('avatar')->nullable();
            $table->string('tipo_usuario')->nullable();         
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('token_celular')->nullable(); //token de celular para push notification
            $table->rememberToken(); // token para recordar sesion
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
