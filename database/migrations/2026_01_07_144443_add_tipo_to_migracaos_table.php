<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('migracaos', function (Blueprint $table) {
            // Removida a linha 'secao' para evitar erro de duplicação
            // Se houver outras colunas para adicionar, coloque aqui.
            // Se não, pode deixar vazio. O importante é não quebrar o banco.
        });
    }

    public function down()
    {
        Schema::table('migracaos', function (Blueprint $table) {
            // $table->dropColumn('secao'); // Comentado para não dar erro ao voltar
        });
    }
};
