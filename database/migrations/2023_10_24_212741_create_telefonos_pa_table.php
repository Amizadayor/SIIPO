<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('telefonos_pa', function (Blueprint $table) {
            $table->id();
            $table->string('Numero', 10)->nullable();
            $table->string('Tipo', 20)->nullable();
            $table->unsignedBigInteger('DGPAid');

            $table->foreign('DGPAid')->references('id')->on('datosgenerales_pa');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('telefonos_pa');
    }
};
