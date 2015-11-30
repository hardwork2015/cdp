<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

//Open resources for all !
Route::resource('bdchart','BurnDownChart\BDCController');

// Special url for visitors
Route::get('bdchart/{id}/{key}','BurnDownChart\BDCController@show');


//Resources opened for all visitors
Route::resource('pert/taches','Pert\PertController');

// Special url for visitors
Route::get('pert/taches/{id}/{pid}/{key}','Pert\PertController@show');


//Resources opened also to Visitors
Route::resource('kanban/taches','Kanban\KanbanController');

// Special url for visitors
Route::get('kanban/taches/{id}/{pid}/{key}','Kanban\KanbanController@show');

//for connected developers to make task in done state
Route::resource('finishtask/taches','FinishTask\FinishTaskController');


//Only connected users can see those resources
Route::resource('taketache/taches','TakeTache\TakeTacheController');

//Only connected users can see those resources
Route::resource('taches/taches','Taches\TachesController');

//Open resources for all visitor
Route::resource('tachesv/taches','TachesVisitor\TachesVisitorController');


Route::get('home', '\App\Http\Controllers\HomeController@index');
//Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


//Route::get('backlog/{idProject}','BacklogController@show');
Route::get('backlog/{idProject}/{key?}','BacklogController@show');

Route::get('project/new','ProjectController@show');
Route::get('project/add','ProjectController@add');

Route::get('project/list','ProjectController@projectList');

Route::get('project/disply/{idProject}','ProjectController@disply');

Route::get('backlog/userstory/create/{idProject}','UsController@create');
Route::get('backlog/userstory/modify/{idUs}','UsController@modify');
Route::post('backlog/userstory/create/confirm/{idProject}','UsController@createConfirm');
Route::post('backlog/userstory/modify/confirm/{idProject}','UsController@modifyConfirm');

Route::get('userstory/finish/{idProject}/{idUs}','UsController@finish');
Route::get('userstory/isfinish/{idProject}','UsController@isFinish');

Route::get('visitor/backlog/{id}/{key}','BacklogController@visitor');


// Suppression d'une User Story
Route::get('backlog/userstory/remove/{id}','UsController@remove');

// Page d'ajout d'un Sprint
Route::get('sprint/list/{idProject}/{key?}', 'SprintController@listSprint');

Route::get('sprint/{project_id}/add/', 'SprintController@show');

Route::post('sprint/{project_id}/add/confirm', 'SprintController@add');

Route::get('sprint/{project_id}/edit/{sprint_id}', 'SprintController@edit');

Route::post('sprint/{project_id}/edit/{sprint_id}/confirm', 'SprintController@editConfirm');


//Route::get('sprint/{idProject}/userstory/{idSprint}/{i}', 'SprintController@display');

Route::get('sprint/{idProject}/userstory/{idSprint}/{i}/{key?}', 'SprintController@display');


//us to sprint
Route::get('AddUsToSprint/{idProject}','UsSprintController@show');
Route::get('usSprint/add/{idProject}/{idUs}/{idSprint}/{i}','UsSprintController@add');

Route::get('usSprint/{idSprint}/{key?}','UsSprintController@showSprint');
Route::get('usSprint/delete/{idProject}/{idSprint}/{idUs}/{i}','UsSprintController@delete');


Route::get('project/{project_id}/kanban/{sprint_id}/{key?}', 'KanbanController@show');


// Page d'affichage des commits
Route::get('project/commits/{task_id}/{key?}', 'CommitsController@show');

// Page d'affichage du BurnDownChart
Route::get('project/{project_id}/burndownchart/{key?}', 'BurnDownChartController@show');

Route::get("project/pert", 'PERTViewerController@show');


// Page d'ajout d'un Membre à un projet
Route::get('project/{project_id}/add', 'MemberController@show');
Route::post('project/{project_id}/add/confirm', 'MemberController@add');
Route::get('project/{project_id}/remove/{dev_id}', 'MemberController@remove');

Route::get('project/{project_id}/visitor/', 'VisitorController@show');
Route::get('project/{project_id}/visitor/allow', 'VisitorController@allow');
Route::get('project/{project_id}/visitor/forbid', 'VisitorController@forbid');

//Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

//Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('/', function () {
    return redirect()->action('Auth\AuthController@getLogin');
});
