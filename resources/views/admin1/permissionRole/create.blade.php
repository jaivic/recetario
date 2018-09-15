@extends('layouts.partForm')
@section('formulario')
            {!! Form::open(['route' => 'permissionrole.store', 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.permissionRole.fields')
            {!! Form::close() !!}        
@endsection
