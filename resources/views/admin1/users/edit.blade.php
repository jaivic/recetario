@extends('layouts.partForm')
@section('formulario')
              {!! Form::model($users, ['route' => ['admin1.users.update', $users->id], 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.users.editfields')
            {!! Form::close() !!}

@endsection
