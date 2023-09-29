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
        Schema::create('usuarios_comunidad', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //bolean activo
            $table->boolean('activo')->default(true);
            //constraint usuario
            $table->foreignId('usuario_id')->constrained('users');
            //constraint comunidad
            $table->foreignId('comunidad_id')->constrained('comunidades');
            //constraint perfil
            // TO DO: quitar nullable
            $table->foreignId('perfil_id')->nullable()->constrained('perfiles');
            //constraint direccion nullable
            $table->foreignId('direccion_id')->nullable()->constrained('direcciones');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios_comunidad');
    }
};
