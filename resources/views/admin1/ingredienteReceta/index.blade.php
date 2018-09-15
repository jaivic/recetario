@extends('layouts.partTable')
@section('Tabla')
    <thead>			                
        <tr>
            <th>id</th>
    <th>ingrediente_id</th>
    <th>receta_id</th>
    <th>cantidad</th>
    <th>created_at</th>
    <th>updated_at</th>
    <th>unidad</th>
    
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach($ingredienteReceta as $row)
            <tr>
                <td>{!!  $row->id !!}</td>
    <td>{!!  $row->ingrediente_id !!}</td>
    <td>{!!  $row->receta_id !!}</td>
    <td>{!!  $row->cantidad !!}</td>
    <td>{!!  $row->created_at !!}</td>
    <td>{!!  $row->updated_at !!}</td>
    <td>{!!  $row->unidad !!}</td>
    
                <td>   
                    {!! Form::open(['route' => ['admin1.ingredientereceta.delete',$row->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('admin1.ingredientereceta.detail', [$row->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('admin1.ingredientereceta.edit', [$row->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estás seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>

@endsection
