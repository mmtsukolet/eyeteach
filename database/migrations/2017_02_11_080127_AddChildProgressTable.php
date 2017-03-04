<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChildProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_progress', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('child_id');
            $table->integer('activity_id');
            $table->integer('played_game_answer_id');
            $table->text('played_game');
            $table->string('progress_status');
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
        Schema::dropIfExists('child_progress');
    }
}
