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
    Schema::create('passos_apps', function (Blueprint $table) {
        $table->id();
        $table->integer('numero'); // Para a ordem dos passos (1, 2, 3...)
        $table->string('titulo'); // Ex: "Envio de Assets"
        $table->text('descricao'); // O texto explicativo
        $table->string('responsabilidade'); // Para salvar 'cliente' ou 'tecnofit'
        $table->timestamps();
    });
}
};
