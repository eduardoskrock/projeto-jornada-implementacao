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
    // 1. Requisitos Obrigatórios
    Schema::create('acesso_requisitos', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->text('descricao');
        $table->string('icone')->default('fas fa-check'); // Ex: 'fas fa-desktop'
        $table->timestamps();
    });

    // 2. Perguntas Tecnofit Catraca
    Schema::create('acesso_perguntas', function (Blueprint $table) {
        $table->id();
        $table->string('titulo'); // A Pergunta
        $table->text('descricao'); // A Resposta
        $table->timestamps();
    });

    // 3. Equipamentos (Modelos Compatíveis)
    Schema::create('acesso_equipamentos', function (Blueprint $table) {
        $table->id();
        $table->string('marca');
        $table->string('modelo');
        $table->string('conexao'); // USB, Rede, Serial, etc.
        // Enum para as categorias pedidas
        $table->enum('categoria', ['catracas', 'facial', 'biometria', 'impressoras']);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('controle_acesso_tables');
    }
};
