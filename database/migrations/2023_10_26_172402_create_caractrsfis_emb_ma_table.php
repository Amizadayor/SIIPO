<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('caractrsfis_emb_ma', function (Blueprint $table) {
            $table->id();
            $table->decimal('Eslora', 10, 2)->default(0.00);
            $table->decimal('Manga', 10, 2)->default(0.00);
            $table->decimal('Puntal', 10, 2)->default(0.00);
            $table->decimal('Calado', 10, 2)->default(0.00);
            $table->decimal('ArqueoNeto', 10, 2)->default(0.00);
            $table->unsignedBigInteger('DGEMMAid');

            $table->foreign('DGEMMAid')->references('id')->on('datosgenerales_emb_ma');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('caractrsfis_emb_ma');
    }
};
