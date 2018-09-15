<?php

namespace App\Http\Controllers\admin1;

use App\Http\Models\admin1\procedimientos;
use Illuminate\Http\Request;
use App\Http\Requests\CreateprocedimientosAPIRequest;
use App\Http\Requests\UpdateprocedimientosAPIRequest;
use App\Http\service\admin1\procedimientosService;
use App\Sg\SgController;

class procedimientosController extends SgController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new procedimientosService(); 
    }
    public function index()
    {
      $procedimientos = procedimientos::all();
      return view('admin1.procedimientos.index',compact("procedimientos"));
    }
    public function create(){
      return view('admin1.procedimientos.create');
    }
    public function edit($id){
      $procedimientos = procedimientos::find($id);
      return view('admin1.procedimientos.edit',compact("procedimientos"));
    }
     public function show($id){
        $row = procedimientos::find($id);
        return view('admin1.procedimientos.show',compact("row"));
    }
    public function store(CreateprocedimientosAPIRequest $request)
    { 
        $procedimientos = $this->service->create($request->all());
        return redirect("procedimientos/edit/$procedimientos->id")
        ->with('status', 'Cambios agregada correctamente');
    }
    public function update(UpdateprocedimientosAPIRequest $request,$id)
    {
        $procedimientos = $this->service->update($request->all(),$id);
        return redirect("procedimientos/edit/$procedimientos->id")
        ->with('status', 'Cambios agregada correctamente');
    }
      public function delete($id)
    {        
        $this->service->delete($id);
        return redirect("procedimientos/index")->with('status', 'Cambios agregada correctamente');
    }  
}
