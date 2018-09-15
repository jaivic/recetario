@extends('layouts.partTable')
@section('Tabla')
    <thead>			                
        <tr>
            <th>id</th>
    <th>migration</th>
    <th>batch</th>
    
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach($migrations as $row)
            <tr>
                <td>{!!  $row->id !!}</td>
    <td>{!!  $row->migration !!}</td>
    <td>{!!  $row->batch !!}</td>
    
                <td>   
                    {!! Form::open(['route' => ['admin1.migrations.delete',$row->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('admin1.migrations.detail', [$row->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('admin1.migrations.edit', [$row->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estás seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>

@endsection
