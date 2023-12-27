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
        Schema::create('servidores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nodo_id');
            $table->string('nombre');
            $table->boolean('encendido');
            $table->decimal('almacenamiento_total', 8, 2);
            $table->text('descripción')->nullable();
            $table->timestamps();

            $table->foreign('nodo_id')->references('id')->on('nodos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servidores');
    }
};
