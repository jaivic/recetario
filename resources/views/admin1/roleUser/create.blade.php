@extends('layouts.partForm')
@section('formulario')
            {!! Form::open(['route' => 'roleuser.store', 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.roleUser.fields')
            {!! Form::close() !!}        
@endsection
