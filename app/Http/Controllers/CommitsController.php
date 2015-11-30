<?php
/**
 * User: oumaziz
 * Date: 12/11/15
 * Time: 11:32
 */

namespace App\Http\Controllers;

use App\Project;
use App\Tache;
use Illuminate\Support\Facades\Auth;
use App\Visitor;
use App\Userstory;
use jyggen\Curl\Exception\CurlErrorException;
use jyggen\Curl\HeaderBag;
use jyggen\Curl\Request;

use GrahamCampbell\GitHub\Facades\GitHub;

class CommitsController extends Controller
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

    private $commits = array();
    private $position = 0;

    public function show($task_id, $key = null)
    {
        try {

            $task = Tache::where("code", $task_id)->get()->first();
            $project_id = Userstory::where("id", $task->us_story_id)->get()->first()->project_id;

            if ($key != null) {
                if (Visitor::where("key", $key)->where("project_id", $project_id)->get() != null)
                    return $this->showCommits($task, $project_id);
                else
                    return Redirect()->action('Auth\AuthController@getLogin');
            }else{
                if (Auth::user()->id) return $this->showCommits($task, $project_id);
                else return Redirect()->action('Auth\AuthController@getLogin');
            }

        }catch(\Exception $e){
            //dd($e);
            return "Une erreur s'est produite.";
        }
    }

    private function showCommits($task, $project_id){

        try {

            $project = Project::where("id", $project_id)->get()->first();
            $taskCode = $task->code;
            $repo = explode('/', $project->repo);
            $sha = $project->branch;

            try {

                $oldReturn = null;
                $return = $this->parseData($taskCode,
                    GitHub::repo()->commits()->all($repo[0], $repo[1],
                        array('sha' => $sha, 'per_page' => 100)));

                while (($return != null) && ($oldReturn != $return)) {

                    $oldReturn = $return;
                    $return = $this->parseData($taskCode,
                        GitHub::repo()->commits()->all($repo[0], $repo[1],
                            array('sha' => $return, 'per_page' => 100)));

                }

                //dd($this->commits);

                return view("commits.index")->with('commits', $this->commits);

            } catch (CurlErrorException $e) {
                return "Oups. Une erreur réseau est survenue :(";
            }
        }catch(\Exception $e){
            return view("commits.index")->with('commits', null);
        }


        //return GitHub::repo()->commits()->all('hardwork2015', 'cdp', array('sha' => 'dev'));
    }

    private function parseData($taskCode, $data){

        $commits = $data;

        for($i = 0; $i < count($commits); $i++){
            if(strstr($commits[$i]["commit"]["message"], $taskCode)){
                $this->commits[$this->position]["message"] = $commits[$i]["commit"]["message"];
                $this->commits[$this->position]["url"] = $commits[$i]["html_url"];
                $this->commits[$this->position]["user"] = $commits[$i]["commit"]["author"]["name"];
                $this->commits[$this->position]["date"] = $commits[$i]["commit"]["author"]["date"];
                //$this->commits[$this->position]["user_url"] = $commits[$i]->author->html_url;

                $this->position++;
            }
        }

        return $commits[count($commits) - 1]["sha"];
    }
}