<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGameObjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_object', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->integer('lang_id');
            $table->string('game_character_name');
            $table->string('game_character_desc');
            $table->string('game_character_type');
            $table->text('game_character_path');
            $table->tinyInteger('is_deleted');
            $table->string('created_by');
            $table->string('updated_by');
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
        //
    }
}
