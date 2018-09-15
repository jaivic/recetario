@extends('layouts.partForm')
@section('formulario')
            {!! Form::open(['route' => 'ingredientereceta.store', 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.ingredienteReceta.fields')
            {!! Form::close() !!}        
@endsection
