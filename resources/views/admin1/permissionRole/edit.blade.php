@extends('layouts.partForm')
@section('formulario')
              {!! Form::model($permissionRole, ['route' => ['admin1.permissionrole.update', $permissionRole->permission_id], 'method' => 'post','class' => 'smart-form  client-form']) !!}
                @include('admin1.permissionRole.editfields')
            {!! Form::close() !!}

@endsection
