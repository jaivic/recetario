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
<td><b>permission_id</b></td>
<td>{!!  $row->permission_id !!}</td>
</tr>
    <tr>
<td><b>role_id</b></td>
<td>{!!  $row->role_id !!}</td>
</tr>
    
    </tbody>
</table>
@endsection
