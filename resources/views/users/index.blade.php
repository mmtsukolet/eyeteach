@extends('master')
@section('content')
	
	@include('layouts.list', [
		'class' => $class, 
		'thead' => $thead, 
		'tdata' => $tdata
	])

@stop