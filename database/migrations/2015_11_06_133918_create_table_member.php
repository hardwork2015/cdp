<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('member', function (Blueprint $table) {
            $table->integer('project_id');
            $table->integer('Developer_id');
            $table->primary(array('project_id', 'Developer_id'));
            $table->timestamps();
        });

        DB::table('member')->insert(
            array(
                'project_id' => 1,
                'Developer_id' => 1
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
        Schema::drop('member');
    }
}
