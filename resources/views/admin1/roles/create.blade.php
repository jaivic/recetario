@extends('layouts.partForm')
@section('formulario')
            {!! Form::open(['route' => 'roles.store', 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.roles.fields')
            {!! Form::close() !!}        
@endsection
