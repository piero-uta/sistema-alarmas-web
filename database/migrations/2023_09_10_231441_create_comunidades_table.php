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
        Schema::create('comunidades', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            //TO DO ver si se hace unico el rut
            $table->integer('rut');
            $table->string('digito');
            $table->string('razon_social');
            $table->string('representante_legal')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('direccion');
            $table->string('giro')->nullable()->default(null);
            $table->string('tipo_servicio');
            $table->integer('costo_mensual');
            $table->string('telefono')->nullable()->default(null);
            $table->string('celular')->nullable()->default(null);
            $table->string('logo')->nullable()->default(null);
            $table->boolean('activo')->default(true);

            // zoom level
            $table->integer('zoom')->default(13);
            // create latitude
            $table->float('latitud', 10, 6)->default(null);
            // create longitude
            $table->float('longitud', 10, 6)->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comunidades');
    }
};
