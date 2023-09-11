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
        Schema::create('permisos_perfil', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('perfil_id')->constrained('perfiles');
            $table->foreignId('permiso_id')->constrained('permisos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permisos_perfil');
    }
};
