<?php

namespace App\Http\Controllers\admin1;

use App\Http\Models\admin1\ingredientes;
use Illuminate\Http\Request;
use App\Http\Requests\CreateingredientesAPIRequest;
use App\Http\Requests\UpdateingredientesAPIRequest;
use App\Http\service\admin1\ingredientesService;
use App\Sg\SgController;

class ingredientesController extends SgController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new ingredientesService(); 
    }
    public function index()
    {
      $ingredientes = ingredientes::all();
      return view('admin1.ingredientes.index',compact("ingredientes"));
    }
    public function create(){
      return view('admin1.ingredientes.create');
    }
    public function edit($id){
      $ingredientes = ingredientes::find($id);
      return view('admin1.ingredientes.edit',compact("ingredientes"));
    }
     public function show($id){
        $row = ingredientes::find($id);
        return view('admin1.ingredientes.show',compact("row"));
    }
    public function store(CreateingredientesAPIRequest $request)
    { 
        $ingredientes = $this->service->create($request->all());
        return redirect("ingredientes/edit/$ingredientes->id")
        ->with('status', 'Cambios agregada correctamente');
    }
    public function update(UpdateingredientesAPIRequest $request,$id)
    {
        $ingredientes = $this->service->update($request->all(),$id);
        return redirect("ingredientes/edit/$ingredientes->id")
        ->with('status', 'Cambios agregada correctamente');
    }
      public function delete($id)
    {        
        $this->service->delete($id);
        return redirect("ingredientes/index")->with('status', 'Cambios agregada correctamente');
    }  
}
