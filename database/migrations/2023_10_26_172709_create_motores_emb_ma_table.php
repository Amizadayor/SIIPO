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
        Schema::create('motores_emb_ma', function (Blueprint $table) {
            $table->id();
            $table->string('Marca', 50)->nullable();
            $table->string('Modelo', 50)->nullable();
            $table->string('Serie', 50)->nullable();
            $table->decimal('Potencia', 10, 2)->default(0.00);
            $table->boolean('MtrPrincipal');
            $table->unsignedBigInteger('DGEMMAid');

            $table->foreign('DGEMMAid')->references('id')->on('datosgenerales_emb_ma');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motores_emb_ma');
    }
};
