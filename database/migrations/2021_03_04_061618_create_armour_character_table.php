<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArmourCharacterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('armour_character', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('armour_id');
            $table->unsignedBigInteger('character_id');
            $table->boolean('carried')->default(0);
            $table->boolean('equipped')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('armour_character');
    }
}
