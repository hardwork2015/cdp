<?php



?>

@extends('default')
@section('content')



    <h2>Finish your task</h2>

    <table class="table table-bordered">
        <tbody>


                <tr>
                    <td>{{ $tache->description }} </td>
                    <td><a class="btn btn-primary" style="width:130px" href="{{ route('#',$tache->id) }}">Finish</a></td>
                </tr>
        </tbody>
    </table>
    <a href="{{ URL::previous()}}" class="btn btn-default" >Back</a>

@stop