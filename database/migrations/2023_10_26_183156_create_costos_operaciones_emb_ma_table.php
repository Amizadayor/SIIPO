<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('costos_operaciones_emb_ma', function (Blueprint $table) {
            $table->id();
            $table->decimal('Combustible', 10, 2)->default(0.00);
            $table->decimal('Lubricantes', 10, 2)->default(0.00);
            $table->decimal('Mantenimiento', 10, 2)->default(0.00);
            $table->decimal('Salarios', 10, 2)->default(0.00);
            $table->decimal('Seguros', 10, 2)->default(0.00);
            $table->decimal('Permisos', 10, 2)->default(0.00);
            $table->decimal('Impuestos', 10, 2)->default(0.00);
            $table->decimal('Avituallamiento', 10, 2)->default(0.00);
            $table->decimal('Preoperativos', 10, 2)->default(0.00);
            $table->decimal('AsistenciaTecnica', 10, 2)->default(0.00);
            $table->decimal('Administrativos', 10, 2)->default(0.00);
            $table->decimal('Otros', 10, 2)->default(0.00);
            $table->decimal('Total', 10, 2)->default(0.00)->nullable(false);
            $table->unsignedBigInteger('DGEMMAid');

            $table->foreign('DGEMMAid')->references('id')->on('datosgenerales_emb_ma');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('costos_operaciones_emb_ma');
    }
};
