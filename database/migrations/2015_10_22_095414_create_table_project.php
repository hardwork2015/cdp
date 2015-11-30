<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->timestamp('startDate');
            $table->string('repo')->nullable();
            $table->string('branch')->default("master");
            $table->integer('developer_id');
            $table->timestamps();
        });

        DB::table('project')->insert(
            array(
                'title' => 'Mon projet',
                'description' => 'Mon premier projet',
                'startDate' => time(),
                'repo' => "hardwork2015/cdp",
                'branch' => 'dev',
                'developer_id' => 1
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
        Schema::drop('project');
    }
}
