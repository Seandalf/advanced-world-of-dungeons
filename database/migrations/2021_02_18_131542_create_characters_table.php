<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->unsignedBigInteger('background_id')->nullable();
            $table->tinyInteger('str')->default(0);
            $table->tinyInteger('dex')->default(0);
            $table->tinyInteger('con')->default(0);
            $table->tinyInteger('int')->default(0);
            $table->tinyInteger('wis')->default(0);
            $table->tinyInteger('cha')->default(0);
            $table->tinyInteger('hp')->default(0);
            $table->tinyInteger('hit_dice')->default(0);
            $table->tinyInteger('power')->default(0);
            $table->tinyInteger('xp')->default(0);
            $table->tinyInteger('level')->default(1);
            $table->tinyInteger('coin')->default(0);
            $table->unsignedBigInteger('status_id')->nullable()->default(null);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
