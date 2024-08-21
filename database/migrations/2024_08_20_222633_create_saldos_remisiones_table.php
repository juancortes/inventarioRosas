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
        Schema::create('saldos_remisiones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('remision_id')->nullable();
            $table->foreign('remision_id')
                ->references('id')
                ->on('remisiones');
            $table->integer('produccion_freedom');
            $table->integer('produccion_color');
            $table->integer('devolucion_freedom');
            $table->integer('devolucion_color');
            $table->decimal('valor_freedom');
            $table->decimal('valor_color');
            $table->decimal('valor_pagar_color');
            $table->decimal('valor_pagar_freedom');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saldos_remisiones');
    }
};
