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
        Schema::table('passo_aplicativos', function (Blueprint $table) {
        $table->string('prazo')->nullable(); // Ex: "5 dias úteis"
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('passo_aplicativos', function (Blueprint $table) {
            //
        });
    }
};
