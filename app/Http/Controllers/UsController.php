<?php

namespace App\Http\Controllers;

use App\Userstory;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Session;
use DB;

class UsController extends Controller
{
    public function create($idProject){
        return view("UsForm")->with('us',[])->with('idProject',$idProject);
    }
    public function modify($idUs){

        $us =DB::table('userstory')->where('id', '=', $idUs)->get() ;
        return view("UsForm")->with('us',head($us));
    }

    public function createConfirm(Request $r , $idProject){

       /* $developer_id = 1;
        $project_id = DB::table('project')->where('developer_id', $developer_id)->first()->id;*/

        Userstory::create([
            "description" => $r->input('description'),
            "priority" => $r->input('priority'),
            "difficulty" => $r->input('difficulty'),
            "status" => 0,
            "project_id" => $idProject,
            "sprint_id" => 0 ]);

        return Redirect::action("BacklogController@show", [$idProject]);
    }
    public function modifyConfirm(Request $r, $idProject){

        $us = Userstory::where('id', $r->input("us"))->first();

        $us->update([
            "description" => $r->input('description'),
            "priority" => $r->input('priority'),
            "difficulty" => $r->input('difficulty'),
            "status" => ($r->input("done"))?1:0
        ]);

        return Redirect::action("BacklogController@show", [$idProject]);
    }

    public function remove($id) {

        $us = Userstory::where('id', $id)->first();
         
        if($us != null) $us->delete();
        Session::flash("success", "la us est bien supprimée.");
        return Redirect::action("BacklogController@show" , [$us->project_id]);
    }

    public function finish ($idProject, $idSprint) {

        $userstories = Userstory::where('project_id', '=' , $idProject)->where('sprint_id', '=', $idSprint)->get();
        if($userstories != null)
            return view("UsFinish")->with('userstories', $userstories)->with('idProject', $idProject);
    }
}
