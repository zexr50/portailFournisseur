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
        Schema::create('demandesFournisseurs', function (Blueprint $table) {
            $table->id('id_demande')->primary();
            $table->foreignId('id_fournisseur');
            $table->string('etat_demande', 32);
            $table->string('raison_refus', 255);
            $table->string('commentaire', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandesFournisseurs');
    }
};
