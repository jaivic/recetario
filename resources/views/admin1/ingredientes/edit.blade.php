@extends('layouts.partForm')
@section('formulario')
              {!! Form::model($ingredientes, ['route' => ['admin1.ingredientes.update', $ingredientes->id], 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.ingredientes.editfields')
            {!! Form::close() !!}

@endsection
