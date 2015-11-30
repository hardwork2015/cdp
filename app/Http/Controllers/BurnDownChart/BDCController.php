<?php

namespace App\Http\Controllers\BurnDownChart;

use App\Sprint;
use App\Userstory;
use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Http\Request;

use JpGraph\JpGraph;

use App\Http\Requests;
use App\Visitor;
use App\Http\Controllers\Controller;

class BDCController extends Controller
{

    public function __construct(\Illuminate\Http\Request $request){
        $key = $request->route()->key;
        $id = $request->route()->id;

        if($key != null){
            if(Visitor::where("Key", $key)->where("project_id", $id)->get()->first() == null){
                $this->middleware('auth');
            }
        }
        else { $this->middleware('auth'); }
    }

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

        $userstories = Userstory::all();
        $selectedUserStories = array();
        $i = 0;
        foreach($userstories as $userstory){
            if($userstory->project_id == $id){
                $selectedUserStories[$i] = $userstory;
                $i++ ;
            }
        }

        $sprints = Sprint::all();

        $realisedUS = array();

        $somme = 0;
        for($i= 0 ; $i < count($selectedUserStories);$i++) {
            $somme = $somme + $selectedUserStories[$i]->difficulty ;

        }

        $cptt = 0;
        $cpt  = $somme;
        foreach($sprints as $sprint){

                for($i= 0 ; $i < count($selectedUserStories);$i++){
                    if($selectedUserStories[$i]->sprint_id == $sprint->id && $selectedUserStories[$i]->status == 1){
                        $cptt = $cptt + $selectedUserStories[$i]->difficulty;
                    }
                }
                $realisedUS[$sprint->id] = $cpt - $cptt;

        }
        //dd($realisedUS);

        $j= 1;
        $userstori = array();
        $time = array();

        $userstori[0] =  $somme;
        $time[0] = 0;

        //dd($realisedUS);
        foreach($realisedUS as $key => $value){
            $userstori[$j] = $value;
            $time[$j]  = $key;
            $j++;
        }


        //dd($time);
        //$userstori[0] = count($selectedUserStories);
        JpGraph::load();
        JpGraph::module('line');


        //$time = array_keys($realisedUS);
        //dd($realisedUS);


        //dd($time);
        //dd($userstori);


        $graph = new \Graph(900,300);
        $ydata = $userstori;
        $xdata = $time;

        //dd($time);
        //dd($userstori);

        $graph->SetScale('intint');
        $lineplot = new \LinePlot($ydata, $xdata);
        $lineplot->SetColor('forestgreen');
        $graph->Add($lineplot);
        $graph->title->Set('BurnDownChart');
        $graph->xaxis->title->Set('Sprint\'s Time');
        $graph->yaxis->title->Set('Difficulties');
        $lineplot->SetWeight(3);

        $gdImgHandler = $graph->Stroke(_IMG_HANDLER);

        //Start buffering
        ob_start();
        //Print the data stream to the buffer
        $graph->img->Stream();
        //Get the contents of the buffer
        $image_data = ob_get_contents();
        //Stop the buffer/clear it.
        ob_end_clean();
        //Set the variable equal to the base 64 encoded value of the stream.
        //This gets passed to the browser and displayed.
        $image = base64_encode($image_data);


        return view('bdchart.index', compact('realisedUS','id','data','texte','image'));


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
