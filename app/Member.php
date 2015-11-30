<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model {

    protected $table = 'member';

    protected $fillable = [
        'project_id',
        'Developer_id'
    ];
}