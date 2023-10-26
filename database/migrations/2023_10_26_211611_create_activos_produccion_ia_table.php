<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activos_produccion_ia', function (Blueprint $table) {
            $table->id();
            $table->string('Clave', 50);
            $table->integer('Cantidad');
            $table->decimal('Largo', 10, 2)->default(0.00);
            $table->decimal('Ancho', 10, 2)->default(0.00);
            $table->decimal('Altura', 10, 2)->default(0.00);
            $table->decimal('Capacidad', 10, 2)->default(0.00);
            $table->enum('UnidadMedida', ['METRO CUADRADO', 'METRO CUBICO', 'KILOGRAMO', 'LITRO', 'PIEZA']);
            $table->unsignedBigInteger('DGIAid');
            $table->unsignedBigInteger('TPActivoid');

            $table->foreign('DGIAid')->references('id')->on('datosgenerales_ia');
            $table->foreign('TPActivoid')->references('id')->on('tipos_activo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activos_produccion_ia');
    }
};
