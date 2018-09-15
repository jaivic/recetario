@extends('layouts.partTable')
@section('Tabla')
    <thead>			                
        <tr>
            <th>id</th>
    <th>created_at</th>
    <th>updated_at</th>
    <th>procedimiento</th>
    <th>img</th>
    
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach($procedimientos as $row)
            <tr>
                <td>{!!  $row->id !!}</td>
    <td>{!!  $row->created_at !!}</td>
    <td>{!!  $row->updated_at !!}</td>
    <td>{!!  $row->procedimiento !!}</td>
    <td>{!!  $row->img !!}</td>
    
                <td>   
                    {!! Form::open(['route' => ['admin1.procedimientos.delete',$row->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('admin1.procedimientos.detail', [$row->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('admin1.procedimientos.edit', [$row->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estás seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>

@endsection
