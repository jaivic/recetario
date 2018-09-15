@extends('layouts.partForm')
@section('formulario')
              {!! Form::model($recetas, ['route' => ['admin1.recetas.update', $recetas->id], 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.recetas.editfields')
            {!! Form::close() !!}

@endsection
