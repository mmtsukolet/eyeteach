<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQuestionsAnswerTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('questions');

        Schema::create('questions_and_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('qna_desc');
            $table->text('qna_answer');
            $table->text('qna_image_question');
            $table->text('qna_video_question');
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
        Schema::dropIfExists('questions_and_answers');
    }
}
