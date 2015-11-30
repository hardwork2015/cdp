<?php

?>

@extends('default')
@section('content')

   <!--  <p><a class="btn btn-info btn-lg center-block" style="width:1000px" href="{{ route('taches.taches.create') }}">Add Task</a></p>  -->

@if(Session::has('success1'))
    <div class="alert alert-success">

        {{ Session::get('success1') }}

    </div>
@endif
@if(Session::has('success2'))
    <div class="alert alert-success">

        {{ Session::get('success2') }}

    </div>
@endif
@if(Session::has('update'))
    <div class="alert alert-success">

        {{ Session::get('update') }}

    </div>
@endif


    <div class="container">
        @if(!empty($taches))
        <h2>List of tasks in your sprint</h2>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Code</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Predecessors</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @endif
            @if(empty($taches))
                <h2>There is no task in your sprint, please add one !</h2>
            @endif

            @foreach($taches as $tache)
                <tr>
                    <td><a href="{{ URL::action("CommitsController@show", [$tache->code]) }}">{{ $tache->code }}</a></td>
                    <td>{{ $tache->description }}</td>
                    <td>{{$tache->start_date }}</td>
                    <td>{{$tache->end_date  }}</td>
                    <td>{{$tache->predecessors  }}</td>
                    <td>
                        <p><a class="btn btn-warning btn-xs"  href="{{ route('taches.taches.edit',$tache->id) }}">Edit</a>
                        {!! Form::open(['method'=>'delete', 'url'=>route('taches.taches.destroy',$tache->id)]) !!}
                        <button  class="btn btn-danger btn-xs">Destroy</button>
                        {!! Form::close() !!}
                        </p>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <p><a class="btn btn-info center-block" href="{{ route('taches.taches.create') }}">Add Task</a></p>
        <a href= {{ route('kanban.taches.show',$id) }} class= 'btn btn-default'> show Kanban</a></br>
        <a href="{{ URL::previous()}}" class="btn btn-default" >Back</a>
    </div>

@stop

