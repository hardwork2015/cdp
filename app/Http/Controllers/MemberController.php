<?php
/**
 * User: oumaziz
 * Date: 06/11/15
 * Time: 14:43
 */

namespace App\Http\Controllers;

use App\Developer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Member;
use App\Http\Requests\NewMemberRequest;

class MemberController extends Controller
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

    public function show($project_id, $key=null){
        if($key != null){
            if(Visitor::where("Key", $key)->where("project_id", $project_id)->get() != null){

                $members = DB::table('member')->where('project_id', $project_id)
                            ->join('Developer', 'member.Developer_id', '=', 'Developer.id')->get();
                return view("member.show")->with('members',$members)->with('project_id', $project_id);
            }
               
        }
        else {

        $members = DB::table('member')->where('project_id', $project_id)
            ->join('Developer', 'member.Developer_id', '=', 'Developer.id')->get();
        return view("member.show")->with('members',$members)->with('project_id', $project_id);
        }
    }

    public function add(NewMemberRequest $r, $project_id){

        try {
            $Developer_id = Developer::where("email", $r->input("email"))->get()->first()->id;

            if ($Developer_id != null) {
                Member::create([
                    "Developer_id" => $Developer_id,
                    "project_id" => $project_id
                ]);
            }
        }catch(\Illuminate\Database\QueryException $e){}

        $members = DB::table('member')->where('project_id', $project_id)
            ->join('Developer', 'member.Developer_id', '=', 'Developer.id')->get();
        return view("member.show")->with('members',$members)->with('project_id', $project_id);
    }

    public function remove($dev_id, $project_id)
    {

        $member = DB::table('member')->where('Developer_id' , $dev_id)->delete();

        $members = DB::table('member')->where('project_id', $project_id)
            ->join('Developer', 'member.Developer_id', '=', 'Developer.id')->get();
        return view("member.show")->with('members',$members)->with('project_id', $project_id);
    }
}
