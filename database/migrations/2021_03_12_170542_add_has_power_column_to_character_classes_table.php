<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHasPowerColumnToCharacterClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('character_classes', function (Blueprint $table) {
            $table->boolean('has_power')->default(0)->after('has_spells');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('character_classes', function (Blueprint $table) {
            $table->dropColumn('has_power');
        });
    }
}
