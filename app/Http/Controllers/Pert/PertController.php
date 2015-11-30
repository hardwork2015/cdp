<?php

namespace App\Http\Controllers\Pert;

use App\Arc;
use App\Etat;
use App\Pert;
use App\Tache;
use App\Visitor;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PertController extends Controller
{

    public function __construct(\Illuminate\Http\Request $request){
        $key = $request->route()->key;
        $id = $request->route()->pid;

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
        $handle = fopen(public_path('D3/app/pert.js'), "r+");
        ftruncate($handle,0);

        $file_start = "loadData(\n\t{\n\t\t name: 'PERT Diagram',\n\t\t nodes: [\n";
        $file_half  = "\t\t ],\n\t\t links:[\n";
        $file_end   = "\t\t ]\n\t}\n);";

        $pred = array();
        $succ = array();
        $gaph = array();

        file_put_contents(public_path('D3/app/pert.js'), $file_start, FILE_APPEND | LOCK_EX);

        $taches = Tache::all();

        //Calculate duration of tasks
        foreach($taches as $tache){
            $duree[$tache->code] = ((((abs(strtotime($tache->start_date)-strtotime($tache->end_date))/60)/60)/24));
        }

        //Extract predecessors
        foreach($taches as $tache){
            $pred[$tache->code] = explode(",",$tache->predecessors);
        }

        //successors from predecessors
        $m = 0;
        foreach($taches as $tache){
            for($i= 0 ; $i < count($pred[$tache->code]); $i++){
                if(!empty($tache->code)){
                    $succ[$pred[$tache->code][$i]][$m] = $tache->code;
                    $m++;
                }

            }
        }

        $listEtat = array();
        $listArc = array();


        static $j = 1;
        $k = 0;
        //$graph = array();
        file_put_contents(public_path('D3/app/pert.js'),"\t\t\t{ id: 'node0', value: { label: 'Start' } },\n", FILE_APPEND | LOCK_EX);


        $etatInit = new Etat(0,0,0);
        $etatFin = new Etat(0,0,0);

        foreach($taches as $tache){
            if(empty($tache->predecessors)){
                $listEtat[$j] = new Etat($duree[$tache->code],0,$j);
                $listArc[$j]  = new Arc($etatInit,$listEtat[$j],$tache,true);
                //$graph[$k][$j] = $tache;
                $j++;
            }

           else {
                for ($i = 1; $i <= count($listEtat); $i++) {
                    if(array_key_exists($listArc[$i]->getTache()->code,$succ)){
                    if (in_array($tache->code, $succ[$listArc[$i]->getTache()->code])==true) {
                        $etatI = new Etat($duree[$tache->code]+$duree[$listArc[$i]->getTache()->code],0,$j);
                        array_push($listEtat,$etatI);
                        array_push($listArc, new Arc($listArc[$i]->getDestination(),$etatI,$tache,true));
                       $j++;
                    }
                    }
                }

            }
        }
        //dd($listEtat);
        //dd($listArc);
        //dd($graph);


        $pert = new Pert($listEtat,null,$listArc,$etatInit,$etatFin);
        //dd($pert);

        for($i = 1 ; $i <= count($listEtat); $i++){
            file_put_contents(public_path('D3/app/pert.js'),"\t\t\t{ id: 'node".$i."', value: { label: '".$i."' } },\n", FILE_APPEND | LOCK_EX);
        }
        file_put_contents(public_path('D3/app/pert.js'), $file_half, FILE_APPEND | LOCK_EX);

        for($i = 1 ; $i <= count($listArc); $i++){
            file_put_contents(public_path('D3/app/pert.js'),"\t\t\t{ u: 'node".$listArc[$i]->getSource()->getNom()."', v: 'node".$listArc[$i]->getDestination()->getNom().
                "', value: { label: '".$listArc[$i]->getTache()->code." ".$duree[$listArc[$i]->getTache()->code]."' } },\n", FILE_APPEND | LOCK_EX);

        }



        //dd(file_put_contents(public_path('D3/app/pert.js'), $file_end, FILE_APPEND | LOCK_EX));

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
        $handle = fopen(public_path('D3/app/pert.js'), "r+");
        ftruncate($handle,0);

        $file_start = "loadData(\n\t{\n\t\t name: 'PERT Diagram',\n\t\t nodes: [\n";
        $file_half  = "\t\t ],\n\t\t links:[\n";
        $file_end   = "\t\t ]\n\t}\n);";


        $pred = array();
        $succ = array();
        $gaph = array();

        file_put_contents(public_path('D3/app/pert.js'), $file_start, FILE_APPEND | LOCK_EX);



        $taches = Tache::all();





        //Calculate duration of tasks
        foreach($taches as $tache){
            if($tache->sprint_id == $id){
                $duree[$tache->code] = ((((abs(strtotime($tache->start_date)-strtotime($tache->end_date))/60)/60)/24));
            }
        }

        //Extract predecessors
        foreach($taches as $tache){
            if($tache->sprint_id == $id) {

                $pred[$tache->code] = explode(",", $tache->predecessors);
            }
        }


        //successors from predecessors
        $m = 0;
        foreach($taches as $tache){
            if($tache->sprint_id == $id) {

                for ($i = 0; $i < count($pred[$tache->code]); $i++) {
                    if (!empty($tache->code)) {
                        $succ[$pred[$tache->code][$i]][$m] = $tache->code;
                        $m++;
                    }


                }
            }
        }


        $listEtat = array();
        $listArc = array();


        static $j = 1;
        $k = 0;
        //$graph = array();
        file_put_contents(public_path('D3/app/pert.js'),"\t\t\t{ id: 'node0', value: { label: 'Start | 0 | 0' } },\n", FILE_APPEND | LOCK_EX);


        $etatInit = new Etat(0,0,0);
        $etatFin = new Etat(0,0,0);


        foreach($taches as $tache){
            if($tache->sprint_id == $id) {

                if (empty($tache->predecessors)) {
                    $listEtat[$j] = new Etat($duree[$tache->code], 0, $j);
                    $listArc[$j] = new Arc($etatInit, $listEtat[$j], $tache, true);
                    //$graph[$k][$j] = $tache;
                    $j++;
                } else {
                    for ($i = 1; $i <= count($listEtat); $i++) {
                        if (array_key_exists($listArc[$i]->getTache()->code, $succ)) {
                            if (in_array($tache->code, $succ[$listArc[$i]->getTache()->code]) == true) {
                                $etatI = new Etat($duree[$tache->code] + $duree[$listArc[$i]->getTache()->code],$duree[$tache->code] + $duree[$listArc[$i]->getTache()->code] , $j);
                                array_push($listEtat, $etatI);
                                array_push($listArc, new Arc($listArc[$i]->getDestination(), $etatI, $tache, true));
                                $j++;
                            }
                        }
                    }

                }
            }
        }
        //dd($listEtat);
        //dd($listArc);
        //dd($graph);


        $pert = new Pert($listEtat,null,$listArc,$etatInit,$etatFin);
        $pert->calculAuPlusTot();
        $pert->calculatePlusTard();

        $listEtat = $pert->etats;
        $listArc  = $pert->arcReals;



        for($i = 1 ; $i <= count($listEtat); $i++){
            file_put_contents(public_path('D3/app/pert.js'),"\t\t\t{ id: 'node".$i."', value: { label: '".$i." | ".$listEtat[$i]->getAuPlusTot()." | ".$listEtat[$i]->getAuPlusTard()."' } },\n", FILE_APPEND | LOCK_EX);
        }


        file_put_contents(public_path('D3/app/pert.js'), $file_half, FILE_APPEND | LOCK_EX);

        for($i = 1 ; $i <= count($listArc); $i++){
            file_put_contents(public_path('D3/app/pert.js'),"\t\t\t{ u: 'node".$listArc[$i]->getSource()->getNom()."', v: 'node".$listArc[$i]->getDestination()->getNom().
                "', value: { label: '".$listArc[$i]->getTache()->code."[".$duree[$listArc[$i]->getTache()->code]."]' } },\n", FILE_APPEND | LOCK_EX);

        }




        file_put_contents(public_path('D3/app/pert.js'), $file_end, FILE_APPEND | LOCK_EX);


        return redirect()->to('project/pert?../D3/app/pert.js');


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
