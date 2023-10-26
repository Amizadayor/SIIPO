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
        Schema::create('unidadeconomica_ia', function (Blueprint $table) {
            $table->id();
            $table->string('RNPA', 50)->nullable();
            $table->string('Nombre', 100);
            $table->boolean('PropietarioArrendamiento');
            $table->unsignedBigInteger('UEDueno');

            $table->foreign('UEDueno')->references('id')->on('unidadeconomica_pa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidadeconomica_ia');
    }
};
