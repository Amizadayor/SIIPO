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
        Schema::create('datosgenerales_pa', function (Blueprint $table) {
            $table->id();
            $table->boolean('TipoPersona')->nullable();
            $table->string('CURP', 18)->nullable();
            $table->string('RFC', 13)->nullable();
            $table->string('Nombres', 50)->nullable();
            $table->string('ApPaterno', 30)->nullable();
            $table->string('ApMaterno', 30)->nullable();
            $table->date('FechaNacimiento')->nullable();
            $table->enum('Sexo', ['M', 'F'])->nullable();
            $table->string('GrupoSanguineo', 4)->nullable();
            $table->string('Email', 40)->nullable();
            $table->unsignedBigInteger('UEPAid');

            $table->foreign('UEPAid')->references('id')->on('unidadeconomica_pa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datosgenerales_pa');
    }
};
