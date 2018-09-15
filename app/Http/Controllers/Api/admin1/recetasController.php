<?php

namespace App\Http\Controllers\Api\admin1;

use App\Http\Models\admin1\recetas;
use Illuminate\Http\Request;
use App\Http\Requests\CreaterecetasAPIRequest;
use App\Http\Requests\UpdaterecetasAPIRequest;
use App\Http\service\admin1\recetasService;
use App\Sg\AppBaseController;

class recetasController extends AppBaseController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new recetasService(); 
    }
    public function store(CreaterecetasAPIRequest $request)
    { 
      $recetas = $this->service->create($request->all());
      return $this->sendResponse($recetas->toArray(), 'recetas guardado exitosamente');
    }
    public function update(UpdaterecetasAPIRequest $request,$id)
    {
       $recetas = $this->service->update($request->all(),$id);
       return $this->sendResponse($recetas->toArray(), 'recetas actualizado exitosamente');
    }
      public function delete($id)
    {        
      $this->service->delete($id);
      return $this->sendResponse(null, 'recetas eliminado correctamente');
    }
    public function show($id){
        $row = recetas::find($id);
        $result= $row->toArray();
        
        
$result["procedimientos"]=[];
if($row->procedimientos()){
  $result["procedimientos"]= $row->procedimientos()->get();
}

$result["categorias"]=[];
if($row->categorias()){
  $result["categorias"]= $row->categorias()->get();
}

        
        return $this->sendResponse($result, 'success');
    }
     public function all()
    {
        $row = recetas::all();
        $result = $row->toArray();
        foreach ($row as $key => $value) {
           

 $result[$key]["procedimientos"] = [];
if($value->procedimientos()){
  $result[$key]["procedimientos"]= $value->procedimientos()->get();
}
 


 $result[$key]["categorias"] = [];
if($value->categorias()){
  $result[$key]["categorias"]= $value->categorias()->get();
}
 

        }
        
        return $this->sendResponse($result, 'success');
    }
    
}
