<?php

namespace App\Http\Controllers;

use App\Userstory;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Redirect;
use App\Tache;
use Session;
use DB;
use App\Visitor;

class UsController extends Controller
{

    public function __construct(\Illuminate\Http\Request $request){
        $key = $request->route()->key;
        $idProject = $request->route()->idProject;

        if($key != null){
            if(Visitor::where("Key", $key)->where("project_id", $idProject)->get()->first() == null){
                $this->middleware('auth');
            }
        }
        else { $this->middleware('auth'); }
    }

    public function create($idProject){
        return view("UsForm")->with('us',[])->with('idProject',$idProject);
    }
    public function modify($idUs){

        $us =DB::table('userstory')->where('id', '=', $idUs)->get() ;
        return view("UsForm")->with('us',head($us));
    }

    public function createConfirm(Requests\NewUsRequest $r , $idProject){

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
    public function modifyConfirm(Requests\NewUsRequest $r, $idProject){

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

    public function finish ($idProject, $idUs) {

        $ntaches = Tache::where('us_story_id', '=', $idUs)->get();
        $nbrtaches = Tache::where('us_story_id', '=', $idUs)->count();
        $i = 0;
        foreach($ntaches as $tache){
            if($tache->state == 2 ){ 
                $i=$i+1;
            }          
        }
        if($i == $nbrtaches){
          $userstories = Userstory::where('id', '=', $idUs)->update(["status"=> 1]);
            return Redirect::action("UsController@isFinish" , [$idProject]);
        }

        else return Redirect::action("BacklogController@show", [$idProject]);
    }

    public function isFinish ($idProject){
         $userstories = Userstory::where('status', '=', 1)->get();
        
            return view("UsFinish")->with('userstories', $userstories)->with('idProject', $idProject);
    }
}