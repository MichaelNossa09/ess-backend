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
        Schema::create('conectividad', function (Blueprint $table) {
            $table->id();
            $table->string('estado_conectate');
            $table->decimal('velocidad_conectate', 8, 2);
            $table->string('estado_itelkom');
            $table->decimal('velocidad_itelkom', 8, 2);
            $table->string('alertas_graves');
            $table->text('observaciones_graves');
            $table->string('alertas_medias');
            $table->text('observaciones_medias');
            $table->string('alertas_menores');
            $table->text('observaciones_menores');
            $table->integer('alertas_totales');
            $table->text('informacion_workspace');
            $table->decimal('pico_entrante_max_itelkom', 8, 2);
            $table->decimal('pico_salida_max_itelkom', 8, 2);
            $table->decimal('pico_entrante_max_conectate', 8, 2);
            $table->decimal('pico_salida_max_conectate', 8, 2);
            $table->decimal('temperatura_datacenter', 8, 2);
            $table->string('registrado_por');
            $table->string('aprobado_por')->nullable();
            $table->text('observaciones')->nullable();
            $table->text('v_fisica_1');
            $table->text('v_fisica_2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conectividad');
    }
};
