<?php

namespace App\Http\Controllers\admin1;

use App\Http\Models\admin1\permissions;
use Illuminate\Http\Request;
use App\Http\Requests\CreatepermissionsAPIRequest;
use App\Http\Requests\UpdatepermissionsAPIRequest;
use App\Http\service\admin1\permissionsService;
use App\Sg\SgController;

class permissionsController extends SgController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new permissionsService(); 
    }
    public function index()
    {
      $permissions = permissions::all();
      return view('admin1.permissions.index',compact("permissions"));
    }
    public function create(){
      return view('admin1.permissions.create');
    }
    public function edit($id){
      $permissions = permissions::find($id);
      return view('admin1.permissions.edit',compact("permissions"));
    }
     public function show($id){
        $row = permissions::find($id);
        return view('admin1.permissions.show',compact("row"));
    }
    public function store(CreatepermissionsAPIRequest $request)
    { 
        $permissions = $this->service->create($request->all());
        return redirect("permissions/edit/$permissions->id")
        ->with('status', 'Cambios agregada correctamente');
    }
    public function update(UpdatepermissionsAPIRequest $request,$id)
    {
        $permissions = $this->service->update($request->all(),$id);
        return redirect("permissions/edit/$permissions->id")
        ->with('status', 'Cambios agregada correctamente');
    }
      public function delete($id)
    {        
        $this->service->delete($id);
        return redirect("permissions/index")->with('status', 'Cambios agregada correctamente');
    }  
}
