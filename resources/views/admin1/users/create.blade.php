@extends('layouts.partForm')
@section('formulario')
            {!! Form::open(['route' => 'users.store', 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.users.fields')
            {!! Form::close() !!}        
@endsection
