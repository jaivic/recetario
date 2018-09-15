@extends('layouts.partForm')
@section('formulario')
              {!! Form::model($roleUser, ['route' => ['admin1.roleuser.update', $roleUser->user_id], 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.roleUser.editfields')
            {!! Form::close() !!}

@endsection
