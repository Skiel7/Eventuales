@extends('layouts.1')

@section('content')

	
	<div align="center"><img src="../img/Eventuales.png" width='400' height='175' /></div>
	<p><h3>BIENVENID@ a EventualEs {{Session::get('usuario_username')}}</h3></p>
	<p><h4><a href="/MisEventos">Ir a Mis Eventos</a></h4></p>
	<p><h4><a href="/logout">¿Salir?</a></h4></p>

@stop