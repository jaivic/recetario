@extends('layouts.partForm')
@section('formulario')
<table class="table table-bordered">									
  <thead>			                
        <tr>
           <th>Campo</th>
            <th>información</th>
        </tr>
    </thead>
    <tbody>
        <tr>
<td><b>id</b></td>
<td>{!!  $row->id !!}</td>
</tr>
    <tr>
<td><b>name</b></td>
<td>{!!  $row->name !!}</td>
</tr>
    <tr>
<td><b>tipo</b></td>
<td>{!!  $row->tipo !!}</td>
</tr>
    <tr>
<td><b>descripcion</b></td>
<td>{!!  $row->descripcion !!}</td>
</tr>
    <tr>
<td><b>stock</b></td>
<td>{!!  $row->stock !!}</td>
</tr>
    <tr>
<td><b>precio</b></td>
<td>{!!  $row->precio !!}</td>
</tr>
    <tr>
<td><b>impuesto_id</b></td>
<td>{!!  $row->impuesto_id !!}</td>
</tr>
    <tr>
<td><b>created_at</b></td>
<td>{!!  $row->created_at !!}</td>
</tr>
    <tr>
<td><b>updated_at</b></td>
<td>{!!  $row->updated_at !!}</td>
</tr>
    
    </tbody>
</table>
@endsection
