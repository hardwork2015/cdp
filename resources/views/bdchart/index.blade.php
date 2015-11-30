<?php


?>
@extends('default')
@section('content')

    <h2>Burn Down Chart of Project {{$id}}</h2>

    <img src="data:image/png;base64, {{ $image }}" alt="texte alternatif4" /><br><br>

@stop