<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityColumnToPivotTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('armour_character', function (Blueprint $table) {
            $table->tinyInteger('quantity')->after('character_id')->default(0);
        });

        Schema::table('character_equipment', function (Blueprint $table) {
            $table->tinyInteger('quantity')->after('character_id')->default(0);
        });

        Schema::table('character_weapon', function (Blueprint $table) {
            $table->tinyInteger('quantity')->after('character_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('armour_character', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });

        Schema::table('character_equipment', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });

        Schema::table('character_weapon', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
}
