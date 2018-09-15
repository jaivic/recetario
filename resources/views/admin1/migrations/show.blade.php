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
<td><b>migration</b></td>
<td>{!!  $row->migration !!}</td>
</tr>
    <tr>
<td><b>batch</b></td>
<td>{!!  $row->batch !!}</td>
</tr>
    
    </tbody>
</table>
@endsection
