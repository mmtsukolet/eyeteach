<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStrokesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strokes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_object_id');
            $table->string('name');
            $table->string('description');
            $table->text('file_path_url');
            $table->integer('language_id');
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
