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
        Schema::create('detalle_remisiones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('remision_id')->nullable();
            $table->foreign('remision_id')
                ->references('id')
                ->on('remisiones');
            $table->unsignedBigInteger('variety_id')->nullable();
            $table->foreign('variety_id')
                ->references('id')
                ->on('varieties');
            $table->integer('quantity_stems');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_remisiones');
    }
};
