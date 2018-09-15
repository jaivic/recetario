@extends('layouts.partForm')
@section('formulario')
              {!! Form::model($migrations, ['route' => ['admin1.migrations.update', $migrations->id], 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.migrations.editfields')
            {!! Form::close() !!}

@endsection
