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
        Schema::create('estatus_servidor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estatus_id');
            $table->unsignedBigInteger('servidor_id');
            $table->decimal('almacenamiento_disponible', 8, 2);
            $table->decimal('almacenamiento_ocupado', 8, 2);
            $table->decimal('porcentaje_disponible', 8, 2);
            $table->decimal('cpu', 8, 2);
            $table->decimal('memoria', 8, 2);
            $table->decimal('consumo_de_red', 8, 2);
            $table->timestamps();

            $table->foreign('estatus_id')->references('id')->on('estatus')->onDelete('cascade');
            $table->foreign('servidor_id')->references('id')->on('servidores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estatus_servidor');
    }
};
