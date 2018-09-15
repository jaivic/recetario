<?php

namespace App\Http\Controllers\admin1;

use App\Http\Models\admin1\users;
use Illuminate\Http\Request;
use App\Http\Requests\CreateusersAPIRequest;
use App\Http\Requests\UpdateusersAPIRequest;
use App\Http\service\admin1\usersService;
use App\Sg\SgController;

class usersController extends SgController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new usersService(); 
    }
    public function index()
    {
      $users = users::all();
      return view('admin1.users.index',compact("users"));
    }
    public function create(){
      return view('admin1.users.create');
    }
    public function edit($id){
      $users = users::find($id);
      return view('admin1.users.edit',compact("users"));
    }
     public function show($id){
        $row = users::find($id);
        return view('admin1.users.show',compact("row"));
    }
    public function store(CreateusersAPIRequest $request)
    { 
        $users = $this->service->create($request->all());
        return redirect("users/edit/$users->id")
        ->with('status', 'Cambios agregada correctamente');
    }
    public function update(UpdateusersAPIRequest $request,$id)
    {
        $users = $this->service->update($request->all(),$id);
        return redirect("users/edit/$users->id")
        ->with('status', 'Cambios agregada correctamente');
    }
      public function delete($id)
    {        
        $this->service->delete($id);
        return redirect("users/index")->with('status', 'Cambios agregada correctamente');
    }  
}
