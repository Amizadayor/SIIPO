<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('motores_emb_me', function (Blueprint $table) {
            $table->id();
            $table->string('Marca', 20);
            $table->decimal('Potencia', 10, 2)->default(0.00);
            $table->string('Serie', 20);
            $table->string('Combustible', 20);
            $table->unsignedBigInteger('TPMotorid');
            $table->unsignedBigInteger('DGEMMEid')->nullable();

            $table->foreign('TPMotorid')->references('id')->on('tipos_motor');
            $table->foreign('DGEMMEid')->references('id')->on('datosgenerales_emb_me');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('motores_emb_me');
    }
};
