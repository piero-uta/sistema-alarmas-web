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
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('rut');
            $table->string('digito');
            $table->string('codigo')->nullable();
            $table->string('calle');
            $table->integer('numero'); // numero de casa
            
            $table->integer('piso')->nullable();
            // create latitude
            $table->float('latitud', 10, 6)->default(-33.4569400);
            // create longitude
            $table->float('longitud', 10, 6)->default(-70.6482700);

            $table->string('representante');
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();

            // para especificar si esta al dia o debe
            $table->string('motivo_activo')->nullable()->default('Al Dia');
            $table->boolean('activo')->default(true);

            //constraint comunidad
            $table->foreignId('comunidad_id')->constrained('comunidades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direcciones');
    }
};
