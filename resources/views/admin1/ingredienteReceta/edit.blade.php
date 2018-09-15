@extends('layouts.partForm')
@section('formulario')
              {!! Form::model($ingredienteReceta, ['route' => ['admin1.ingredientereceta.update', $ingredienteReceta->id], 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.ingredienteReceta.editfields')
            {!! Form::close() !!}

@endsection
