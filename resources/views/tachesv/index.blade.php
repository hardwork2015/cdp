<?php

?>



@extends('default')
@section('content')

    <h1>Welcome Dear Visitor</h1>

    <div class="container">
        <h2>List of tasks</h2>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Code</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>User story</th>
                <th>Predecessors</th>
            </tr>
            </thead>
            <tbody>

            @foreach($taches as $tache)
                <tr>
                    <td>{{ $tache->code }}</td>
                    <td>{{ $tache->description }}</td>
                    <td>{{$tache->start_date }}</td>
                    <td>{{$tache->end_date  }}</td>
                    <td>{{$tache->us_story_id}}</td>
                    <td>{{$tache->predecessors  }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ URL::previous()}}" class="btn btn-default" >Back</a>
    </div>

@stop
