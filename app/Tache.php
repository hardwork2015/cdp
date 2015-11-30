<?php

namespace App;

use Illuminate\Database\Eloquent\Model;




class Tache extends Model
{

    protected $table = 'tache';
    protected $fillable = array('description','code','start_date','end_date','us_story_id','predecessors','state','sprint_id');


    public function developer(){
        return $this->belongsTo('App\Developer');
    }


    public function sprint(){
        return $this->belongsTo('App\Sprint');
    }

    public function userStory(){
        return $this->belongsTo('App\Userstory');
    }


    public function setState($state){
            $this->attributes['state'] = $state;
    }

    public function getState(){
        return $this->attributes['state'];
    }


    public function right($string,$chars)
    {
        $vright = substr($string, strlen($string)-$chars,$chars);
        return $vright;

    }

    public function calculateGraph($taches, $pred, $succ){



    }

}