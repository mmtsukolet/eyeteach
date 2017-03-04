<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePronunciationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pronunciation_details');
        Schema::dropIfExists('pronunciation');

        Schema::create('pronunciation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_object_id');
            $table->text('word_pronunce');
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
