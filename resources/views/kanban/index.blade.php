<?php

?>
@extends('default')
@section('content')

    <h2>Kanban</h2>

    <table class="table table-bordered">
        @if(!empty($taches))
        <thead >
        <tr class="success">
            <th style="width:30%;">To Do</th>
            <th style="width:30%;">Doing</th>
            <th style="width:30%;">Done</th>
        </tr>
        </thead>
        <tbody>
        
        @endif
        @if(empty($taches))
            <h3>There is no task in your sprint</h3>
        @endif
        @foreach($taches as $tache)

            @if($tache->state == 0)
                <tr>
                    <td>{{ $tache->description }} </td>
                    <td> </td>
                    <td> </td>
                </tr>
            @endif

            @if($tache->state == 1)
                <tr>
                    <td> </td>
                    <td>{{ $tache->description." [".$whoDoWhat[$tache->id]."]" }} </td>
                    <td> </td>
                </tr>
            @endif

            @if($tache->state == 2)
                <tr>
                    <td> </td>
                    <td> </td>
                    <td>{{ $tache->description." [".$whoDoWhat[$tache->id]."]" }} </td>
                </tr>
            @endif

        @endforeach



        </tbody>
    </table>
	@if(!auth()->guest())
<div class="center-block">
    <a class="btn btn-info center-block"  href="{{ route('taketache.taches.show',$id) }}">Take a Task</a> </br>
</div>
	@endif
@stop