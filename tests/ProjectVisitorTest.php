<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectVisitorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
       $this->visit("http://localhost/laravel/cdp/public/project/1/visitor");
        $this->seePageIs('http://localhost/laravel/cdp/public/project/1/visitor');
    }
}