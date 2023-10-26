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
        Schema::create('datostecnicos_ia', function (Blueprint $table) {
            $table->id();
            $table->boolean('UsoComercial')->default(false);
            $table->boolean('UsoDidacta')->default(false);
            $table->boolean('UsoFomento')->default(false);
            $table->boolean('UsoInvestigacion')->default(false);
            $table->boolean('UsoRecreativo')->default(false);
            $table->text('UsoOtro');
            $table->boolean('TipoLaboratorio')->default(false);
            $table->boolean('TipoGranja')->default(false);
            $table->boolean('TipoCentroAcuicola')->default(false);
            $table->text('TipoOtro');
            $table->boolean('ModeloIntensivo')->default(false);
            $table->boolean('ModeloSemiintensivo')->default(false);
            $table->boolean('ModeloExtensivo')->default(false);
            $table->boolean('ModeloHiperintensivo')->default(false);
            $table->text('ModeloOtro');
            $table->decimal('AreaTotal', 10, 2)->default(0.00);
            $table->decimal('AreaAcuicola', 10, 2)->default(0.00);
            $table->text('AreaRestante');
            $table->integer('CapacidadProduccionMiles');
            $table->decimal('CapacidadProduccionToneladas', 10, 2)->default(0.00);
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
        Schema::dropIfExists('datostecnicos_ia');
    }
};
