<?php

use App\Http\Controllers\MemberController;
use App\Member;

class DeleteMemberTest extends TestCase
{

    /**
     * Fonction permettant de tester la
     * suppression d'un membre d'un projet
     *
     * @return void
     */
    public function testDeleteMember()
    {

        Member::create([
            "project_id" => 2,
            "Developer_id" => 2
        ]);

        $cnt = new MemberController();
        $cnt->remove(2,2);

        $this->assertEquals(null, Member::where("project_id", 2)->where("Developer_id", 2)->get()->first());
    }
}

