@extends('layouts.partTable')
@section('Tabla')
    <thead>			                
        <tr>
            <th>permission_id</th>
    <th>role_id</th>
    
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach($permissionRole as $row)
            <tr>
                <td>{!!  $row->permission_id !!}</td>
    <td>{!!  $row->role_id !!}</td>
    
                <td>   
                    {!! Form::open(['route' => ['admin1.permissionrole.delete',$row->permission_id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('admin1.permissionrole.detail', [$row->permission_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('admin1.permissionrole.edit', [$row->permission_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estás seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>

@endsection
