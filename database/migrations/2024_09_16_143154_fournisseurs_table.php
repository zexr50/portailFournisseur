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
            $table->id("id_fournisseurs")->primary();
            $table->string('NEQ', lenght: 10)->nullable();
            $table->string('nom_entreprise', lenght: 64)->required();
            $table->string('email', lenght: 64);
            $table->longText('mdp');
            $table->string('no_rue', lenght: 8);
            $table->string('rue', lenght: 64);
            $table->string('no_bureau', lenght: 8);
            $table->string('ville', lenght: 64);
            $table->string('province', lenght: 64);
            $table->string('code_postal', lenght: 6);
            $table->string('region_admin', lenght: 64);
            $table->string('site_internet', lenght: 64);
            $table->string('commentaire', lenght: 500);
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
