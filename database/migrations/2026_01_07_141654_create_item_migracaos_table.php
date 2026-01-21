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
        Schema::create('item_migracaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('migracao_id')->constrained()->onDelete('cascade');
            $table->string('dado'); // Ex: Alunos
            $table->boolean('importa')->default(true); // Check verde ou X vermelho
            $table->string('observacao'); // Texto da direita
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_migracaos');
    }
};
