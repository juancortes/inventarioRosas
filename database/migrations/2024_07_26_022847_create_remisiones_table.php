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
        Schema::create('remisiones', function (Blueprint $table) {
            $table->id();
            $table->date('date');
             $table->foreignIdFor(\App\Models\Lands::class)
                ->constrained()
                ->nullOnDelete();
            $table->string('variety');
            $table->integer('quantity_stems');
            $table->string('support');
            $table->text('observations')->nullable();
            $table->foreignId("user_id")->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remisiones');
    }
};
