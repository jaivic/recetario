@extends('layouts.partForm')
@section('formulario')
            {!! Form::open(['route' => 'recetas.store', 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.recetas.fields')
            {!! Form::close() !!}        
@endsection
