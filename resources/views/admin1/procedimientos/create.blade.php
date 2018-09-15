@extends('layouts.partForm')
@section('formulario')
            {!! Form::open(['route' => 'procedimientos.store', 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.procedimientos.fields')
            {!! Form::close() !!}        
@endsection
