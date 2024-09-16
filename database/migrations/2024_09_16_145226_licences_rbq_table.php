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
        Schema::create('licences_rbq', function (Blueprint $table) {
            $table->id("id_licence_rbq")->primary();
            $table->foreignId('id_fournisseurs');
            $table->string('categorie', lenght: 32);
            $table->string('sous_categorie', lenght: 250);
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
