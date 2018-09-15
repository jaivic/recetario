@extends('layouts.partForm')
@section('formulario')
              {!! Form::model($categorias, ['route' => ['admin1.categorias.update', $categorias->id], 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.categorias.editfields')
            {!! Form::close() !!}

@endsection
