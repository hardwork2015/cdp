<?php

namespace App\Http\Controllers\Taches;
use App\Sprint;
use App\Userstory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tache;
use App\Developer;
class TachesController extends Controller
{
    /*
      Display a listing of the resource.
      @return \Illuminate\Http\Response
     */


    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $taches = Tache::all();
        return view('taches.index', ['taches' => $taches]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sprints = Sprint::lists('id','id');
        $us_stories = Userstory::lists('description','id');
        $predecessors = Tache::lists('code','code');
        $tache = new Tache();
        $id = $tache->right($this->getRedirectUrl(),1);
        return view('taches.create',compact('sprints','us_stories','id','predecessors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'code' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'

        ]);
        if(!empty($request->get('predecessors'))){
            $preds = implode(",",$request->get('predecessors'));
            $request['predecessors'] = $preds;
        }

        $taches = Tache::all('code')->toArray();
        $ttaches = array();
        $i= 0 ;
        foreach($taches as $tachee){
            $ttaches[$i] = $tachee['code'];
            $i++;
        }

        if(in_array($request->get('code'), $ttaches)){
            Session::flash('danger',"This code already exists  !");
            return redirect(route('taches.taches.create'));
        }
        if(in_array($request->get('code'), $ttaches)== false){
            $tache = Tache::create($request->all());
            Session::flash('success1',"You Task was added with success !");

            return redirect(route('taches.taches.show',$tache->sprint_id));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ntaches = Tache::all();
        $taches = array();
        $i = 0;
        foreach($ntaches as $tache){
            if($tache->sprint_id == $id)
            {
                $taches[$i] = $tache;
            }
            $i++;

            //dd($whoDoWhat);
        }
        return view('taches.index', compact('taches','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sprints = Sprint::lists('id','id');
        $us_stories = Userstory::lists('description','id');
        $tache = Tache::findOrNew($id);
        $predecessors = Tache::lists('code','code');
        return view('taches.edit', compact('tache','sprints','us_stories','predecessors'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tache = Tache::findOrNew($id);
        $this->validate($request,[
            'code' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $preds = implode(",",$request->get('predecessors'));
        $request['predecessors'] = $preds;
        $tache->update($request->all());
        Session::flash('update',"Your task was updated with success !");

        return redirect(route('taches.taches.show',$tache->sprint_id));

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $tache = Tache::findOrFail($id);
        $sprint_id = $tache->sprint_id ;
        DB::table('tache')->delete($id);
        Session::flash('success2',"You Task was deleted with success !");
        return redirect(route('taches.taches.show',$sprint_id));
    }




}