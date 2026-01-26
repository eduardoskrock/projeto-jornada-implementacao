<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('passos_apps', function (Blueprint $table) {
            // Adiciona a coluna prazo sem apagar o resto
            $table->string('prazo')->nullable()->after('responsabilidade');
        });
    }

    public function down()
    {
        Schema::table('passos_apps', function (Blueprint $table) {
            $table->dropColumn('prazo');
        });
    }
};
