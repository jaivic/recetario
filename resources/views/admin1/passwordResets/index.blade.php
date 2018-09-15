@extends('layouts.partTable')
@section('Tabla')
    <thead>			                
        <tr>
            <th>email</th>
    <th>token</th>
    <th>created_at</th>
    
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach($passwordResets as $row)
            <tr>
                <td>{!!  $row->email !!}</td>
    <td>{!!  $row->token !!}</td>
    <td>{!!  $row->created_at !!}</td>
    
                <td>   
                    {!! Form::open(['route' => ['admin1.passwordresets.delete',$row->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('admin1.passwordresets.detail', [$row->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('admin1.passwordresets.edit', [$row->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estás seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>

@endsection
