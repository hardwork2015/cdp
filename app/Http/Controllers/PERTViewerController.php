<?php

namespace App\Http\Controllers;

class PERTViewerController extends Controller
{

    public function show(){
        return view("pert.pert");
    }
}