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
        Schema::create('peces', function (Blueprint $table) {
            $table->id();
            $table->string('NombreComun', 50)->nullable();
            $table->string('NombreCientifico', 100)->nullable();
            $table->unsignedBigInteger('Especieid');

            $table->foreign('Especieid')->references('id')->on('especies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peces');
    }
};
