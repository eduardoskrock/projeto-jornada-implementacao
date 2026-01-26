<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('passo_implementacaos', function (Blueprint $table) {
            // Armazenará um array, ex: ["gym", "box"]
            $table->json('segmentos')->nullable()->after('tipo');
        });
    }

    public function down()
    {
        Schema::table('passo_implementacaos', function (Blueprint $table) {
            $table->dropColumn('segmentos');
        });
    }
};
