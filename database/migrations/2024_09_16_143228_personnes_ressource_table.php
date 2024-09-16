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
        Schema::create('telephone', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('id_fournisseurs');
            $table->foreignId('id_telephone');
            $table->string('prenom_contact', lenght: 32);
            $table->string('nom_contact', lenght: 32);
            $table->string('fonction', lenght: 32);
            $table->string('email_contact', lenght: 64);
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
