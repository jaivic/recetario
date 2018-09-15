@extends('layouts.partForm')
@section('formulario')
              {!! Form::model($permissions, ['route' => ['admin1.permissions.update', $permissions->id], 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.permissions.editfields')
            {!! Form::close() !!}

@endsection
