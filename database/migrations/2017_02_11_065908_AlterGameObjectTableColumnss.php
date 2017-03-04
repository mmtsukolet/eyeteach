<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterGameObjectTableColumnss extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('game_object');

        Schema::create('game_object', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->integer('lang_id');
            $table->integer('theme_id');
            $table->string('obj_name');
            $table->string('obj_desc');
            $table->text('obj_image_path');
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
        
    }
}
