@extends('layouts.partForm')
@section('formulario')
              {!! Form::model($procedimientos, ['route' => ['admin1.procedimientos.update', $procedimientos->id], 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.procedimientos.editfields')
            {!! Form::close() !!}

@endsection
