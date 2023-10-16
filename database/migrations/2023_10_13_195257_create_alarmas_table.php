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
        Schema::create('alarmas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('direccion_id')->constrained('direcciones');
            $table->timestamps();
            $table->date('fecha');
            $table->time('hora');
            // nombre usuario
            $table->string('nombre_usuario');            
            $table->string('codigo');
            // bool activo
            $table->boolean('activo')->default(true);
            // bool chequeo
            $table->boolean('chequeo')->default(false);
            $table->foreignId('dispositivo_id')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alarmas');
    }
};
