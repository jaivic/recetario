<?php

namespace App\Http\Controllers\admin1;

use App\Http\Models\admin1\permissionRole;
use Illuminate\Http\Request;
use App\Http\Requests\CreatepermissionRoleAPIRequest;
use App\Http\Requests\UpdatepermissionRoleAPIRequest;
use App\Http\service\admin1\permissionRoleService;
use App\Sg\SgController;

class permissionRoleController extends SgController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new permissionRoleService(); 
    }
    public function index()
    {
      $permissionRole = permissionRole::all();
      return view('admin1.permissionRole.index',compact("permissionRole"));
    }
    public function create(){
      return view('admin1.permissionRole.create');
    }
    public function edit($id){
      $permissionRole = permissionRole::find($id);
      return view('admin1.permissionRole.edit',compact("permissionRole"));
    }
     public function show($id){
        $row = permissionRole::find($id);
        return view('admin1.permissionRole.show',compact("row"));
    }
    public function store(CreatepermissionRoleAPIRequest $request)
    { 
        $permissionRole = $this->service->create($request->all());
        return redirect("permissionrole/edit/$permissionRole->id")
        ->with('status', 'Cambios agregada correctamente');
    }
    public function update(UpdatepermissionRoleAPIRequest $request,$id)
    {
        $permissionRole = $this->service->update($request->all(),$id);
        return redirect("permissionrole/edit/$permissionRole->id")
        ->with('status', 'Cambios agregada correctamente');
    }
      public function delete($id)
    {        
        $this->service->delete($id);
        return redirect("permissionrole/index")->with('status', 'Cambios agregada correctamente');
    }  
}
