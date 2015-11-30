<?php
?>

@extends('default')
@section('content')

    <div class="center-block"><a class="btn btn-info btn-lg " style="width:500px" href="{{route('finishtask.taches.show',$id)}}">Finish your task</a>    <a class="btn btn-info btn-lg" style="width:500px" href="{{ route('kanban.taches.show',$id) }}">Current Kanban</a></div>


    <h2>Take a Task</h2>

    @if(Session::has('success'))
        <div class="alert alert-success">

          {{ Session::get('success') }}

        </div>
    @endif

    @if(Session::has('fail'))
        <div class="alert alert-danger">

            {{ Session::get('fail') }}

        </div>
    @endif
    <table class="table table-bordered">
        <tbody>
        @foreach($taches as $tache)
            @if($tache->state == 0 && $tache->developer_id !=  Auth::id())
            <tr>
                <td>{{ $tache->description }} </td>
                <td><a class="btn btn-primary" style="width:130px" href="{{ route('taketache.taches.edit',$tache->id) }}">Take</a></td>
				{{--@if($depend[$tache->id] != null)--}}
						{{--@foreach($depend[$tache->id] as $d)--}}
							{{--@if($d!=null)--}}
								{{--<td>Remaining dependencies : {{$d}}</td> --}}
							{{--@endif--}}
						{{--@endforeach--}}
				{{--@endif--}}
            </tr>
			
			
            @endif
        @endforeach

        </tbody>
    </table>
    <a href="{{ URL::previous()}}" class="btn btn-default" >Back</a>
@stop


