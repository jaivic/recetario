<?php

namespace App\Http\Controllers\admin1;

use App\Http\Models\admin1\recetas;
use Illuminate\Http\Request;
use App\Http\Requests\CreaterecetasAPIRequest;
use App\Http\Requests\UpdaterecetasAPIRequest;
use App\Http\service\admin1\recetasService;
use App\Sg\SgController;

class recetasController extends SgController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new recetasService(); 
    }
    public function index()
    {
      $recetas = recetas::all();
      return view('admin1.recetas.index',compact("recetas"));
    }
    public function create(){
      return view('admin1.recetas.create');
    }
    public function edit($id){
      $recetas = recetas::find($id);
      return view('admin1.recetas.edit',compact("recetas"));
    }
     public function show($id){
        $row = recetas::find($id);
        return view('admin1.recetas.show',compact("row"));
    }
    public function store(CreaterecetasAPIRequest $request)
    { 
        $recetas = $this->service->create($request->all());
        return redirect("recetas/edit/$recetas->id")
        ->with('status', 'Cambios agregada correctamente');
    }
    public function update(UpdaterecetasAPIRequest $request,$id)
    {
        $recetas = $this->service->update($request->all(),$id);
        return redirect("recetas/edit/$recetas->id")
        ->with('status', 'Cambios agregada correctamente');
    }
      public function delete($id)
    {        
        $this->service->delete($id);
        return redirect("recetas/index")->with('status', 'Cambios agregada correctamente');
    }  
}
