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
        Schema::create('code_unspsc', function (Blueprint $table) {
            $table->id("id_code_unspsc")->primary();
            $table->string('categorie', lenght: 250);
            $table->string('code_unspsc', lenght: 8);
            $table->string('description_code_unspsc', lenght: 500);
            $table->string('nature_contrat', lenght: 64);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};