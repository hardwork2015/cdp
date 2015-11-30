<?php

namespace App\Http\Controllers\TachesVisitor;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tache;
class TachesVisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $taches = Tache::all();
        return view('tachesv.index', ['taches' => $taches]);
    }
}