<?php

namespace App\Http\Controllers\Api\admin1;

use App\Http\Models\admin1\ingredienteReceta;
use Illuminate\Http\Request;
use App\Http\Requests\CreateingredienteRecetaAPIRequest;
use App\Http\Requests\UpdateingredienteRecetaAPIRequest;
use App\Http\service\admin1\ingredienteRecetaService;
use App\Sg\AppBaseController;

class ingredienteRecetaController extends AppBaseController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new ingredienteRecetaService(); 
    }
    public function store(CreateingredienteRecetaAPIRequest $request)
    { 
      $ingredienteReceta = $this->service->create($request->all());
      return $this->sendResponse($ingredienteReceta->toArray(), 'ingredienteReceta guardado exitosamente');
    }
    public function update(UpdateingredienteRecetaAPIRequest $request,$id)
    {
       $ingredienteReceta = $this->service->update($request->all(),$id);
       return $this->sendResponse($ingredienteReceta->toArray(), 'ingredienteReceta actualizado exitosamente');
    }
      public function delete($id)
    {        
      $this->service->delete($id);
      return $this->sendResponse(null, 'ingredienteReceta eliminado correctamente');
    }
    public function show($id){
        $row = ingredienteReceta::find($id);
        $result= $row->toArray();
        
        
$result["ingredientes"]=[];
if($row->ingredientes()){
  $result["ingredientes"]= $row->ingredientes()->get();
}

$result["recetas"]=[];
if($row->recetas()){
  $result["recetas"]= $row->recetas()->get();
}

        
        return $this->sendResponse($result, 'success');
    }
     public function all()
    {
        $row = ingredienteReceta::all();
        $result = $row->toArray();
        foreach ($row as $key => $value) {
           

 $result[$key]["ingredientes"] = [];
if($value->ingredientes()){
  $result[$key]["ingredientes"]= $value->ingredientes()->get();
}
 


 $result[$key]["recetas"] = [];
if($value->recetas()){
  $result[$key]["recetas"]= $value->recetas()->get();
}
 

        }
        
        return $this->sendResponse($result, 'success');
    }
    
}
