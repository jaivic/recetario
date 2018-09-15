<?php

namespace App\Http\Controllers\admin1;

use App\Http\Models\admin1\roleUser;
use Illuminate\Http\Request;
use App\Http\Requests\CreateroleUserAPIRequest;
use App\Http\Requests\UpdateroleUserAPIRequest;
use App\Http\service\admin1\roleUserService;
use App\Sg\SgController;

class roleUserController extends SgController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new roleUserService(); 
    }
    public function index()
    {
      $roleUser = roleUser::all();
      return view('admin1.roleUser.index',compact("roleUser"));
    }
    public function create(){
      return view('admin1.roleUser.create');
    }
    public function edit($id){
      $roleUser = roleUser::find($id);
      return view('admin1.roleUser.edit',compact("roleUser"));
    }
     public function show($id){
        $row = roleUser::find($id);
        return view('admin1.roleUser.show',compact("row"));
    }
    public function store(CreateroleUserAPIRequest $request)
    { 
        $roleUser = $this->service->create($request->all());
        return redirect("roleuser/edit/$roleUser->id")
        ->with('status', 'Cambios agregada correctamente');
    }
    public function update(UpdateroleUserAPIRequest $request,$id)
    {
        $roleUser = $this->service->update($request->all(),$id);
        return redirect("roleuser/edit/$roleUser->id")
        ->with('status', 'Cambios agregada correctamente');
    }
      public function delete($id)
    {        
        $this->service->delete($id);
        return redirect("roleuser/index")->with('status', 'Cambios agregada correctamente');
    }  
}
