<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('passo_implementacaos', function (Blueprint $table) {
        $table->id();
        $table->string('tipo'); // 'personalizada' ou 'inteligente'
        $table->integer('ordem')->default(1);
        $table->string('prazo')->nullable(); // Ex: 'Dia 1', 'Semana 2'
        $table->string('titulo');
        $table->text('descricao')->nullable();
        $table->string('icone')->default('fas fa-check'); // FontAwesome
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passo_implementacaos');
    }
};
