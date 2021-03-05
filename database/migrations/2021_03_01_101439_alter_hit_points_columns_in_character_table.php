<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterHitPointsColumnsInCharacterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->tinyInteger('current_hp')->after('cha')->default(0);
            $table->tinyInteger('max_hp')->after('current_hp')->default(0);
            $table->dropColumn('hp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropColumn('current_hp');
            $table->dropColumn('max_hp');
            $table->tinyInteger('hp')->default(0);
        });
    }
}
