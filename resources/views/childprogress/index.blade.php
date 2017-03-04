@extends('master')
@section('content')
    
    @include('widgets.table', [
        'class' => $class, 
        'thead' => $thead, 
        'tdata' => $tdata
    ])

@stop