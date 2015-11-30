<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVisitor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('visitor', function (Blueprint $table) {
            $table->integer('project_id');
            $table->string('Key');
            $table->primary(array('project_id', 'Key'));
            $table->timestamps();
        });

        DB::table('visitor')->insert(
            array(
                'project_id' => 1,
                'Key' => "heythere"
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('visitor');
    }
}
