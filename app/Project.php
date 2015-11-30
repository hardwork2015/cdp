<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    protected $table = 'project';

    protected $fillable = [
        'title',
        'description',
        'startDate',
        'developer_id',
        'repo',
        'branch'
    ];
}