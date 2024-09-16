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
        Schema::create('fournisseur_licence_rbq_liaison', function (Blueprint $table) {
            $table->id("id_fournisseur_licence_rbq_liaison")->primary();
            $table->foreignId('id_fournisseurs');
            $table->foreignId('id_licence_rbq');
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
