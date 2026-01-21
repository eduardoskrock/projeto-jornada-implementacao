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
       Schema::create('passo_aplicativos', function (Blueprint $table) {
        $table->id();
        $table->integer('numero'); // 1) O número do passo
        $table->string('titulo');   // 2) O nome da instrução
        $table->text('descricao'); // 3) Uma descrição
        $table->enum('responsavel', ['cliente', 'tecnofit']); // Define a cor (preto ou amarelo)
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passo_aplicativos');
    }
};
