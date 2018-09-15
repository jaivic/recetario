<?php

namespace App\Http\Controllers\admin1;

use App\Http\Models\admin1\ingredienteReceta;
use Illuminate\Http\Request;
use App\Http\Requests\CreateingredienteRecetaAPIRequest;
use App\Http\Requests\UpdateingredienteRecetaAPIRequest;
use App\Http\service\admin1\ingredienteRecetaService;
use App\Sg\SgController;

class ingredienteRecetaController extends SgController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new ingredienteRecetaService(); 
    }
    public function index()
    {
      $ingredienteReceta = ingredienteReceta::all();
      return view('admin1.ingredienteReceta.index',compact("ingredienteReceta"));
    }
    public function create(){
      return view('admin1.ingredienteReceta.create');
    }
    public function edit($id){
      $ingredienteReceta = ingredienteReceta::find($id);
      return view('admin1.ingredienteReceta.edit',compact("ingredienteReceta"));
    }
     public function show($id){
        $row = ingredienteReceta::find($id);
        return view('admin1.ingredienteReceta.show',compact("row"));
    }
    public function store(CreateingredienteRecetaAPIRequest $request)
    { 
        $ingredienteReceta = $this->service->create($request->all());
        return redirect("ingredientereceta/edit/$ingredienteReceta->id")
        ->with('status', 'Cambios agregada correctamente');
    }
    public function update(UpdateingredienteRecetaAPIRequest $request,$id)
    {
        $ingredienteReceta = $this->service->update($request->all(),$id);
        return redirect("ingredientereceta/edit/$ingredienteReceta->id")
        ->with('status', 'Cambios agregada correctamente');
    }
      public function delete($id)
    {        
        $this->service->delete($id);
        return redirect("ingredientereceta/index")->with('status', 'Cambios agregada correctamente');
    }  
}
