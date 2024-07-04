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
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('branch_stem_id')->nullable();
            $table->foreign('branch_stem_id')
                ->references('id')
                ->on('branch_stems');
            
            $table->unsignedBigInteger('type_branche_id')->nullable();
            $table->foreign('type_branche_id')
                ->references('id')
                ->on('type_branches');

            $table->unsignedBigInteger('table_id')->nullable();
            $table->foreign('table_id')
                ->references('id')
                ->on('tables');

            $table->unsignedBigInteger('varietie_id')->nullable();
            $table->foreign('varietie_id')
                ->references('id')
                ->on('varieties');
                
            $table->string('grades')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
