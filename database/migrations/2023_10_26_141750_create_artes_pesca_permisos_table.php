<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artes_pesca_permisos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('TPArtPescaid');
            $table->unsignedBigInteger('PPPAid');

            $table->foreign('TPArtPescaid')->references('id')->on('artes_pesca');
            $table->foreign('PPPAid')->references('id')->on('permisos_pesca_pa');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artes_pesca_permisos');
    }
};
