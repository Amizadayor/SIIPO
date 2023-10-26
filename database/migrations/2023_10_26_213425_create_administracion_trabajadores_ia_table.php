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
        Schema::create('administracion_trabajadores_ia', function (Blueprint $table) {
            $table->id();
            $table->integer('NumFamilias')->nullable();
            $table->integer('NumMujeres')->nullable();
            $table->integer('NumHombres')->nullable();
            $table->integer('Integ15Menos')->nullable();
            $table->integer('Integ16a25')->nullable();
            $table->integer('Integ26a35')->nullable();
            $table->integer('Integ36a45')->nullable();
            $table->integer('Integ46a60')->nullable();
            $table->integer('IntegMas60')->nullable();
            $table->boolean('RequiereCont')->default(false);
            $table->integer('Temporales')->nullable();
            $table->integer('Permanentes')->nullable();
            $table->integer('TotalIntegrantes');
            $table->unsignedBigInteger('DGIAid');

            $table->foreign('DGIAid')->references('id')->on('datosgenerales_ia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administracion_trabajadores_ia');
    }
};
