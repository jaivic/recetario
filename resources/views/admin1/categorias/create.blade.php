@extends('layouts.partForm')
@section('formulario')
            {!! Form::open(['route' => 'categorias.store', 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.categorias.fields')
            {!! Form::close() !!}        
@endsection
