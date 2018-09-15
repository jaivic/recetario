@extends('layouts.partTable')
@section('Tabla')
    <thead>			                
        <tr>
            <th>id</th>
    <th>name</th>
    <th>tipo</th>
    <th>descripcion</th>
    <th>stock</th>
    <th>precio</th>
    <th>impuesto_id</th>
    <th>created_at</th>
    <th>updated_at</th>
    
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach($ingredientes as $row)
            <tr>
                <td>{!!  $row->id !!}</td>
    <td>{!!  $row->name !!}</td>
    <td>{!!  $row->tipo !!}</td>
    <td>{!!  $row->descripcion !!}</td>
    <td>{!!  $row->stock !!}</td>
    <td>{!!  $row->precio !!}</td>
    <td>{!!  $row->impuesto_id !!}</td>
    <td>{!!  $row->created_at !!}</td>
    <td>{!!  $row->updated_at !!}</td>
    
                <td>   
                    {!! Form::open(['route' => ['admin1.ingredientes.delete',$row->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('admin1.ingredientes.detail', [$row->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('admin1.ingredientes.edit', [$row->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estás seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>

@endsection
