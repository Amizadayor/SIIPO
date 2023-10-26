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
        Schema::create('especies_objetivo_ia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('DTIAid');
            $table->unsignedBigInteger('EspecieOid');

            $table->foreign('DTIAid')->references('id')->on('datostecnicos_ia');
            $table->foreign('EspecieOid')->references('id')->on('especies_objetivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especies_objetivo_ia');
    }
};
