<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // CORREÇÃO: O nome correto da tabela é 'item_migracaos'
        Schema::table('item_migracaos', function (Blueprint $table) {
            $table->string('arquivo')->nullable();
        });
    }

    public function down()
    {
        Schema::table('item_migracaos', function (Blueprint $table) {
            $table->dropColumn('arquivo');
        });
    }
};
