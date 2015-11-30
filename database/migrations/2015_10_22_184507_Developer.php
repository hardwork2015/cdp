<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Developer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('Developer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('FirstName');
            $table->string('FamilyName');
            $table->string('email')->unique();
            $table->string('password', 100);
            $table->rememberToken();
            $table->timestamps();
        });


        DB::table('Developer')->insert(
            array(
                'FirstName' => 'Test',
                'FamilyName' => 'Test',
                'email' => 'test@test.com',
                'password' => Hash::make("password")
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
         Schema::drop('Developer');
    }
}
