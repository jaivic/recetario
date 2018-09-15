@extends('layouts.partForm')
@section('formulario')
              {!! Form::model($roles, ['route' => ['admin1.roles.update', $roles->id], 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.roles.editfields')
            {!! Form::close() !!}

@endsection
