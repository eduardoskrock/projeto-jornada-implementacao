<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
       if (!Schema::hasColumn('passo_implementacaos', 'segmentos')) {
        Schema::table('passo_implementacaos', function (Blueprint $table) {
            $table->text('segmentos')->nullable(); // ou o tipo que você definiu
        });
    }
    }

    public function down()
    {
        Schema::table('passo_implementacaos', function (Blueprint $table) {
            $table->dropColumn('segmentos');
        });
    }
};
