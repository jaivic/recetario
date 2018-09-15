@extends('layouts.partForm')
@section('formulario')
            {!! Form::open(['route' => 'ingredientes.store', 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.ingredientes.fields')
            {!! Form::close() !!}        
@endsection
