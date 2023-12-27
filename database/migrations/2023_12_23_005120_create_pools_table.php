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
        Schema::create('pools', function (Blueprint $table) {
            $table->id();
            $table->decimal('capacidad_pool_a', 8, 2);
            $table->decimal('capacidad_disponible_pool_a', 8, 2);
            $table->decimal('porcentaje_disponible_pool_a', 8, 2);

            $table->decimal('capacidad_pool_b', 8, 2);
            $table->decimal('capacidad_disponible_pool_b', 8, 2);
            $table->decimal('porcentaje_disponible_pool_b', 8, 2);

            $table->text('v_fisica_1');
            $table->text('v_fisica_2');
            $table->string('registrado_por');
            $table->string('aprobado_por')->nullable();
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pools');
    }
};
