<?php


use App\Userstory;

class TestUS extends PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $us1 = Userstory::create([

            'description' => 'this is a user story of our project',
            'priority'   => '20',
            'difficulty' => '1',
            'status'     => 'validated',
            'project_id' => '1'
        ]);

        $us2 = Userstory::create([

            'description' => 'yes client this is a user story for your satisfaction',
            'priority'   => '5',
            'difficulty' => '1',
            'status'     => 'validated',
            'project_id' => '1'
        ]);

        $this->assertEquals(2, Tache::all()->count());

    }

}
