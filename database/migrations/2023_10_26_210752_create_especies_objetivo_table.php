<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('especies_objetivo', function (Blueprint $table) {
            $table->id();
            $table->string('NombreComun', 50);
            $table->string('NombreCientifico', 100);
            $table->unsignedBigInteger('TPEspecieid');

            $table->foreign('TPEspecieid')->references('id')->on('especies');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('especies_objetivo');
    }
};
