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
        Schema::create('redes_avisos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //constraint direccion 
            $table->foreignId('direccion_id')->constrained('direcciones');
            $table->foreignId('direccion_vecino_id')->constrained('direcciones');
            //bolean activo
            $table->boolean('activo')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redes_avisos');
    }
};
