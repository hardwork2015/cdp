<?php

use App\Sprint;

class TestSprint extends PHPUnit_Framework_TestCase
{

    public function testAdd()
    {
        $sprint1 = Sprint::create([

            'StartDate' => '2015-11-10',
            'EndDate' => '2015-11-16',
            'project_id' => '1'
        ]);

        $sprint2 = Sprint::create([

            'StartDate' => '2015-11-19',
            'EndDate' => '2015-11-26',
            'project_id' => '1'
        ]);

        $this->assertEquals(2, Tache::all()->count());

    }

    public function testUpdate(){

        $sprint1 = Sprint::create([

            'StartDate' => '2015-11-10',
            'EndDate' => '2015-11-16',
            'project_id' => '1'
        ]);

        $$sprint1->update([
            'StartDate' => '2015-11-17',
            'EndDate' => '2015-11-25',
            'project_id' => '1'
        ]);

        $this->assertEquals('2015-11-10',$sprint1->StartDate);
        $this->assertEquals('2015-11-16',$sprint1->EndDate);

        $this->assertEquals(1,Tache::all()->count());
    }
}
