<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewSprintRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Sprint;
use Redirect;
use DB;
use App\Visitor;

class SprintController extends Controller
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

    public function show($project_id){
        return view("sprint.add", compact("project_id"));
    }

     public function display($idProject, $idSprint, $i, $key = null){
        $userstories= DB::table('userstory')->where('project_id','=', $idProject)->get();

        return view("sprint.AddUsToSprint")->with('userstories',$userstories)->with('idProject',$idProject)->with('idSprint', $idSprint)->with('i', $i);
    }

    public function listSprint($idProject, $key = null){

        $sprint = DB::table('sprint')->where('project_id', '=', $idProject)->get();
        return view("sprint.SprintList")->with('sprint', $sprint)->with('idProject',$idProject)->with('key',$key);
    }

    public function add(NewSprintRequest $r, $project_id){
        $this->validate($r,[
            'StartDate' => 'required|date',
            'EndDate' => 'required|date|after:StartDate'
        ]);
        Sprint::create([
            "StartDate" => $r->input("StartDate"),
            "EndDate" => $r->input("EndDate"),
            "project_id" => $project_id
        ]);

        return Redirect::action("SprintController@listSprint", [$project_id]);
    }

    public function edit($project_id, $sprint_id){

        $sprint = DB::table('sprint')->where('id', '=', $sprint_id)->first();
        $StartDate = $sprint->StartDate;
        $EndDate = $sprint->EndDate;

        return view("sprint.edit", compact("project_id", "StartDate", "EndDate", "sprint_id"));
    }

    public function editConfirm(NewSprintRequest $r, $project_id, $sprint_id){

        $us = Sprint::where('id', $sprint_id)->first();

        $us->update([
            "StartDate" => $r->input("StartDate"),
            "EndDate" => $r->input("EndDate"),
        ]);

        return Redirect::action("SprintController@listSprint", [$project_id]);
    }
}