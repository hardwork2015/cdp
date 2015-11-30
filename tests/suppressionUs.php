<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class suppressionUs extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {	
    	$this->open("http://localhost/cdp/public/backlog/userstory/remove/1");
    	$this->seePageIs('http://localhost/cdp/public/backlog');
    }
}
