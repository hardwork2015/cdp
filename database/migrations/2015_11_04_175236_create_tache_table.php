<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTacheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tache', function (Blueprint $table) {

            $table->increments('id');
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('code');
            $table->unique('code');
            $table->timestamps();
            $table->string('predecessors')->nullable();
            $table->integer('us_story_id')->unsigned();
            $table->foreign('us_story_id')->references('id')->on('userstory');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tache');
    }
}
