<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AddMemberToProject extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMyTestCase()
    {   $this->artisan('migrate');
    	$this->visit("/project/1/add");
        $this->type('test@test.com', 'email');
        $this->press('Ajouter');
        $this->seePageIs('/project/1/add/confirm');
    }

}
