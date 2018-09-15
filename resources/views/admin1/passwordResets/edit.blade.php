@extends('layouts.partForm')
@section('formulario')
              {!! Form::model($passwordResets, ['route' => ['admin1.passwordresets.update', $passwordResets->id], 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.passwordResets.editfields')
            {!! Form::close() !!}

@endsection
