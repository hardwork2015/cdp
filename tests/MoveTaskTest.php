<?php

use App\Http\Controllers\TakeTache\TakeTacheController;
use App\Tache;

class MoveTaskTest extends TestCase
{

    /**
     * Fonction permettant de tester la
     * suppression d'un membre d'un projet
     *
     * @return void
     */
    public function testMoveTask()
    {
        $tache = Tache::create([
            'description'=>'Ma tache',
            'code' => "MoncodeTest",
            'start_date' =>'2015-11-15',
            'end_date'   =>'2015-11-30',
            'us_story_id' => '1'
        ]);

        $take = new TakeTacheController();
        $take->edit($tache->id);

        $tacheUpdated = Tache::where("code", "MoncodeTest")->get()->first();

        $this->assertEquals(1, $tacheUpdated->state);

        $tacheUpdated->delete();
    }
}

