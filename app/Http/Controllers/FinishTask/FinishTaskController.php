<?php

namespace App\Http\Controllers\FinishTask;

use App\Userstory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tache;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FinishTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $taches = Tache::all();
        $test = true ;
        foreach($taches as $tache){
            if($tache->sprint_id == $id){
                if($tache->developer_id == Auth::id() && $tache->state == 1){
                    $tache->update(['state'=> 2]);
                    $tachesn = Tache::where('us_story_id', $tache->us_story_id)->get();
                    foreach($tachesn as $tachen){
                        if($tachen->state != 2){
                            $test = false ;
                            break;
                        }

                    }
                    $userstory = Userstory::findOrFail($tache->us_story_id);

                  /*  if($test == true){
                        $userstory->update(['status'=> 1]);
                    }
                    else{
                        $userstory->update(['status'=> 0]);
                    }*/

                }

            }
        }

        return redirect(route('kanban.taches.show',$id));
       // return view('kanban.taches.show',compact('id'));


   //     return redirect(route('kanban.taches.index',$id));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
