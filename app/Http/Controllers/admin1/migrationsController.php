<?php

namespace App\Http\Controllers\admin1;

use App\Http\Models\admin1\migrations;
use Illuminate\Http\Request;
use App\Http\Requests\CreatemigrationsAPIRequest;
use App\Http\Requests\UpdatemigrationsAPIRequest;
use App\Http\service\admin1\migrationsService;
use App\Sg\SgController;

class migrationsController extends SgController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new migrationsService(); 
    }
    public function index()
    {
      $migrations = migrations::all();
      return view('admin1.migrations.index',compact("migrations"));
    }
    public function create(){
      return view('admin1.migrations.create');
    }
    public function edit($id){
      $migrations = migrations::find($id);
      return view('admin1.migrations.edit',compact("migrations"));
    }
     public function show($id){
        $row = migrations::find($id);
        return view('admin1.migrations.show',compact("row"));
    }
    public function store(CreatemigrationsAPIRequest $request)
    { 
        $migrations = $this->service->create($request->all());
        return redirect("migrations/edit/$migrations->id")
        ->with('status', 'Cambios agregada correctamente');
    }
    public function update(UpdatemigrationsAPIRequest $request,$id)
    {
        $migrations = $this->service->update($request->all(),$id);
        return redirect("migrations/edit/$migrations->id")
        ->with('status', 'Cambios agregada correctamente');
    }
      public function delete($id)
    {        
        $this->service->delete($id);
        return redirect("migrations/index")->with('status', 'Cambios agregada correctamente');
    }  
}
