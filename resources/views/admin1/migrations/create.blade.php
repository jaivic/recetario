@extends('layouts.partForm')
@section('formulario')
            {!! Form::open(['route' => 'migrations.store', 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.migrations.fields')
            {!! Form::close() !!}        
@endsection
