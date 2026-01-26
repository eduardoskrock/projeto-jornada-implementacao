<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('passo_implementacaos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo'); // personalizada ou inteligente

            // AQUI ESTÁ A COLUNA QUE FALTAVA:
            $table->json('segmentos')->nullable();

            $table->integer('ordem')->default(1);
            $table->string('prazo')->nullable();
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->string('icone')->default('fas fa-check');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('passo_implementacaos');
    }
};
