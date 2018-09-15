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
<td><b>email</b></td>
<td>{!!  $row->email !!}</td>
</tr>
    <tr>
<td><b>password</b></td>
<td>{!!  $row->password !!}</td>
</tr>
    <tr>
<td><b>remember_token</b></td>
<td>{!!  $row->remember_token !!}</td>
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
