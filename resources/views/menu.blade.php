@extends('portada')

@section('menu')
<div id="header">
    <a href="{{ url('/') }}">
        <div class="option">Inicio</div>
    </a>
    <a href="{{ url('/historia') }}">
        <div class="option">Historia</div>
    </a>
    <a href="{{ url('/jugadores') }}">
        <div class="option">Jugadores</div>
    </a>
</div>
@stop