@extends('layouts.partForm')
@section('formulario')
            {!! Form::open(['route' => 'passwordresets.store', 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.passwordResets.fields')
            {!! Form::close() !!}        
@endsection
