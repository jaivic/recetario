@extends('layouts.partTable')
@section('Tabla')
    <thead>			                
        <tr>
            <th>user_id</th>
    <th>role_id</th>
    
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach($roleUser as $row)
            <tr>
                <td>{!!  $row->user_id !!}</td>
    <td>{!!  $row->role_id !!}</td>
    
                <td>   
                    {!! Form::open(['route' => ['admin1.roleuser.delete',$row->user_id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('admin1.roleuser.detail', [$row->user_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('admin1.roleuser.edit', [$row->user_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estás seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>

@endsection
