<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class backlogVisitor extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {	
    	$this->open("http://localhost/cdp/public/visitor/backlog/1");
    	$this->seePageIs('http://localhost/cdp/public/visitor/backlog/1');
    }
}
