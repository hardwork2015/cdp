<?php
/**
 * User: oumaziz
 * Date: 10/11/15
 * Time: 17:34
 */

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Visitor;
use DB;

class VisitorController extends Controller
{

    public function __construct(\Illuminate\Http\Request $request){
        $this->middleware('auth');
    }

    public function show($project_id){
        $key = null;
        $visitor = Visitor::where("project_id", $project_id)->get()->first();

        if($visitor != null) $key = $visitor->Key;
        return view("visitor.show")->with('project_id', $project_id)->with('key', $key);
    }

    public function random($car) {
        $string = "";
        $chaine = "abcdefghijklmnpqrstuvwxy123456789";
        srand((double)microtime()*1000000);
        for($i=0; $i<$car; $i++) {
            $string .= $chaine[rand()%strlen($chaine)];
        }
        return $string;
    }

    public function allow($project_id){
        $key = Visitor::where("project_id", $project_id)->get()->first();
        try {
        if ($key == null) {
            $key =static::random(15);
            Visitor::create([
                "project_id" => $project_id,
                "Key" => $key
            ]);
        }
        }catch(\Illuminate\Database\QueryException $e){}
        return redirect()->action("VisitorController@show", [$project_id]);
    }

    public function forbid($project_id){
        $key = Visitor::where("project_id", $project_id)->get()->first();
            if ($key != null) {
			   DB::table('visitor')->where('project_id' , $project_id)->delete();
            }
		$key = Visitor::where("project_id", $project_id)->get()->first();	
        return redirect()->action("VisitorController@show", [$project_id]);
    }
}
