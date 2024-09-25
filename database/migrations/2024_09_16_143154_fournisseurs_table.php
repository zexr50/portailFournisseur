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
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id("id_fournisseurs");
            $table->string('NEQ', length: 10)->nullable();
            $table->string('nom_entreprise', length: 64)->required();
            $table->string('email', length: 64);
            $table->longText('mdp');
            $table->string('no_rue', length: 8);
            $table->string('rue', length: 64);
            $table->string('no_bureau', length: 8);
            $table->string('ville', length: 64);
            $table->string('province', length: 64);
            $table->string('code_postal', length: 6);
            $table->string('region_admin_id', length: 16);
            $table->string('site_internet', length: 64);
            $table->string('commentaire', length: 500)->nullable();
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
