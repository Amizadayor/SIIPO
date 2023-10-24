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
        Schema::create('unidadeconomica_pa', function (Blueprint $table) {
            $table->id();
            $table->date('FechaRegistro');
            $table->string('RNPA', 50);
            $table->unsignedBigInteger('Ofcid');

            $table->foreign('Ofcid')->references('id')->on('oficinas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidadeconomica_pa');
    }
};
