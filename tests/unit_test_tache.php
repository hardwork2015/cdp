<?php

use App\Tache;

class TestTache extends TestCase
{
    /**
     * Add test.
     *
     * @return void
     */
    public function testAdd()
    {
        $tache1 = Tache::create([

            'description'=>'yes you can !',
            // Our code of task must be unique
            'code' => hash('ripemd160', 'Your task you can love it before you can do it !!'),
            'start_date' =>'2015-10-29',
            'end_date'   =>'2015-10-30',
            'us_story_id' => '1',
            'predecessors' => '1 2 4'



        ]);
        $tache2 = Tache::create([

            'description'=>'yes you can !',
            // Our code of task must be unique
            'code' => hash('ripemd160', 'Your task is good, do it for you before all !!'),
            'start_date' =>'2015-10-29',
            'end_date'   =>'2015-10-30',
            'us_story_id' => '1',
            'predecessors' => '1 2 4'

        ]);

        $this->assertEquals(2,Tache::all()->count());


        $tache2->update([

            'description' => 'yours is yours',
            'code'        => hash('ripemd160', 'Your task is good, do it !!'),
            'start_date'  => '2015-11-01',
            'end_date'    => '2015-11-06',
            'us_story_id' => '1',
            'predecessors' => '1 2 5'


        ]);


        $this->assertEquals('yours is yours',$tache2->description);
        $this->assertEquals('2015-11-01',$tache2->start_date);
        $this->assertEquals('2015-11-06',$tache2->end_date);

        $this->assertEquals(2,Tache::all()->count());

        $tache2->delete();

        Tache::destroy($tache2->id);
        $this->assertEquals(1,Tache::all()->count());



    }
}
