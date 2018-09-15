@extends('layouts.partForm')
@section('formulario')
            {!! Form::open(['route' => 'permissions.store', 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.permissions.fields')
            {!! Form::close() !!}        
@endsection
