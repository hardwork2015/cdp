<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Visitor;
use DB;

class KanbanController extends Controller
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

    public function show($project_id, $sprint_id, $key = null){

        if($key != null){
            if(Visitor::where("key", $key)->where("project_id", $project_id)->get() != null){

                $todos = DB::table('userstory')->where("tache.Status", 0)
                    ->join('tache', 'tache.us_story_id', '=', 'userstory.id')
                    ->where('userstory.sprint_id', $sprint_id)
                    ->where('userstory.project_id', $project_id)->get();

                $goings = DB::table('userstory')->where("tache.Status", 1)
                    ->join('tache', 'tache.us_story_id', '=', 'userstory.id')
                    ->where('userstory.sprint_id', $sprint_id)
                    ->where('userstory.project_id', $project_id)->get();

                $dones = DB::table('userstory')->where("tache.Status", 2)
                    ->join('tache', 'tache.us_story_id', '=', 'userstory.id')
                    ->where('userstory.sprint_id', $sprint_id)
                    ->where('userstory.project_id', $project_id)->get();

                return view("kanban.show")
                    ->with('todos', $todos)
                    ->with('ongoings', $goings)
                    ->with('dones', $dones);

            }
        }

        return Redirect()->action('Auth\AuthController@getLogin');
    }
}
