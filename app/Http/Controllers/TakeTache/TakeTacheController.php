<?php

namespace App\Http\Controllers\TakeTache;

use App\Developer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TakeTacheController extends Controller
{
    /***
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     **/

    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $taches = Tache::all();
        $descriptions = Tache::lists('description','id');
        $user = Auth::user();
        return view('taketache.index',compact('taches','descriptions','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        

/*
   $ntaches = Tache::all();

        $ntaches = Tache::all();
        $descriptions = Tache::lists('description','id');
        $user = Auth::user();
        $taches = array();
        $i = 0;
        $cpt = 0;
		
		
		
		
		
        foreach($ntaches as $tache){
            if($tache->sprint_id == $id) {
					
                    if($tache->developer_id == Auth::id() && $tache->state == 1){
                        Session::flash('fail',"You have already a task, please finish your task !");
                        $taches= array();
                        break;
                    }
                    else if($tache->state != 1){
                        $taches[$i] = $tache ;
                    }
					 foreach($taches as $tache){
					$pred[$tache->code] = explode(",",$tache->predecessors);
					}
					
					for($i= 0 ; $i < count($pred[$tache->code]); $i++){
						if(!empty($tache->code)){
								$j=0;
								foreach($ntaches as $tac){
									if($tac->code==$pred[$tache->code][$i] ){
										if( $tac->state !=2){
											$depend[$tache->id][$j]=$pred[$tache->code][$i];
										}
										else{
											$depend[$tache->id][$j]=null;
										}
										$j++;
									}
								}	
						}


					}
				

				}

                $i++;
            }
		
            //dd($whoDoWhat);
            //dd($taches);
     //   return view('kanban.index', ['taches' => $taches, 'results'=> $whoDoWhat, 'id'=> $id]);



        return view('taketache.index',compact('taches','descriptions','user','id','depend'));*/


        $ntaches = Tache::all();
        $descriptions = Tache::lists('description','id');
        $user = Auth::user();
        $taches = array();
        $i = 0;
        $cpt = 0;
        foreach($ntaches as $tache){
            if($tache->sprint_id == $id) {

                if($tache->developer_id == Auth::id() && $tache->state == 1){
                    Session::flash('fail',"You have already a task, please finish your task !");
                    $taches= array();
                    break;
                }
                else if($tache->state != 1){
                    $taches[$i] = $tache ;
                }


            }

            $i++;
        }
        //dd($whoDoWhat);
        //dd($taches);
        //   return view('kanban.index', ['taches' => $taches, 'results'=> $whoDoWhat, 'id'=> $id]);



        return view('taketache.index',compact('taches','descriptions','user','id'));





    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tache = Tache::findOrNew($id)->developer()->associate(Auth::user());
        $tachet = $tache->attributesToArray();
        $tachet['state'] = 1;
        $tache->update($tachet);
        Session::flash('success',"It's yours now");
        return redirect(route('taketache.taches.show',$tache->sprint_id));

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
