<?php

namespace App\Http\Controllers;
use App\Http\Requests\NewProjectRequest;
use App\Member;
use App\Project;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Session;
use DB;
use App\Visitor;

class ProjectController extends Controller
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

    public function show(){
        return view("project.add");
    }

    public function projectList(){

        $projects_member_id = Member::where("Developer_id", auth()->User()->id)->get()->pluck("project_id");
        $project_owner_id = Project::where("developer_id", auth()->User()->id)->get()->pluck("id");

        $projects_id = array_merge($projects_member_id->toArray(), $project_owner_id->toArray());

        $project = Project::whereIn("id", $projects_id)->get();
        $developer= DB::table('Developer')->get();

        return view("project.list")->with('project',$project)->with('developer',$developer);
    }

    public function disply($idProject){
        //return view("Backlog")->with('idProject',$idProject);
       // return Redirect::action("BacklogController@show")->with('idProject', $idProject);
        $userstories= DB::table('userstory')->with('project_id','=', $idProject)->get();
        return view("Backlog")->with('idProject', $idProject)->with('userstories',$userstories);
    }
    

    public function add(NewProjectRequest $request){

        $developer_id = Auth::user()->id;
        $title = $request->input("title");
        $description = $request->input("description");
        $startDate = $request->input("startDate");
        $repo = $request->input("repo");
        $branch = $request->input("branch");

        Project::create(["title" => $title,
                         "description" => $description,
                         "startDate" => $startDate,
                         "developer_id" => $developer_id,
                         "repo" => $repo,
                         "branch" => $branch
        ]);

        Session::flash("success", "Votre projet a bien été crée.");

        return Redirect::action("ProjectController@show");
    }
}
