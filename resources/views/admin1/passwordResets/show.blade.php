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
<td><b>email</b></td>
<td>{!!  $row->email !!}</td>
</tr>
    <tr>
<td><b>token</b></td>
<td>{!!  $row->token !!}</td>
</tr>
    <tr>
<td><b>created_at</b></td>
<td>{!!  $row->created_at !!}</td>
</tr>
    
    </tbody>
</table>
@endsection
