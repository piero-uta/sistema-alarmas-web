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
        Schema::create('chequeos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('alarma_id')->constrained('alarmas');
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            // guardia
            $table->string('usuario_chequeo')->nullable()->default(null);   
            // bool chequeo
            $table->boolean('estado_chequeo')->default(false);
            // usuario que activo la alarma
            $table->string('vecino_chequeo')->nullable()->default(null);
            $table->string('observacion');   

            // TO DO: crear las tablas y agregar las restricciones
            $table->foreignId('tipo_chequeo')->nullable()->default(null);
            $table->foreignId('tipo_evento')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chequeos');
    }
};
