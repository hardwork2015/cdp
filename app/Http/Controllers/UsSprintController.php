<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddUsToSprintRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Userstory;
use Redirect;
use Session;
use DB;
use App\Visitor;


class UsSprintController extends Controller
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

    public function show($idProject){
        $userstories= DB::table('userstory')->Where('sprint_id','=', 0)->where('project_id', '=', $idProject)->get();
        return view("sprint.AddUsToSprint")->with('userstories',$userstories)->with($idProject);
    }

    public function showSprint ($idSprint){
        $userstories= DB::table('userstory')->Where('sprint_id','=', $idSprint)->get();
        return view("sprint.DeleteUsFromSprint")->with('userstories', $userstories);
    }

    public function add (Request $request, $idProject, $idUs, $idSprint, $i){

        $userstory = DB::table('userstory')->where('id', '=', $idUs)->update(["sprint_id" => $idSprint]);
        $userstories= DB::table('userstory')->where('project_id','=', $idProject)->get();
        Session::flash("success1", "Votre us a bien été ajoutée.");
        //return Redirect::action("SprintController@display")->with('idProject', $idProject)->with('idSprint', $idSprint);
        return view("sprint.AddUsToSprint")->with('userstories',$userstories)->with('idProject', $idProject)->with('idSprint', $idSprint)->with('i', $i);
    }

    public function delete (Request $request, $idProject, $idSprint, $idUs, $i){

        $userstory = DB::table('userstory')->where('id', '=', $idUs)->update(["sprint_id" => 0]);
        $userstories= DB::table('userstory')->where('project_id','=', $idProject)->get();
        Session::flash("success2", "Votre us a bien supprimée.");
        //return Redirect::action("UsSprintController@show")->with('idProject', $idProject);
        return view("sprint.AddUsToSprint")->with('userstories',$userstories)->with('idProject', $idProject)->with('idSprint', $idSprint)->with('i', $i);
    }

}
