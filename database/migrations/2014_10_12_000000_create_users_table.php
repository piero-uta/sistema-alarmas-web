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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');   
            $table->boolean('activo')->default(true);

            $table->string('avatar')->nullable();
            $table->string('tipo_usuario')->nullable();         
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('token_celular')->nullable(); //token de celular para push notification
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
