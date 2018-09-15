<?php

namespace App\Http\Controllers\Api\admin1;

use App\Http\Models\admin1\ingredientes;
use Illuminate\Http\Request;
use App\Http\Requests\CreateingredientesAPIRequest;
use App\Http\Requests\UpdateingredientesAPIRequest;
use App\Http\service\admin1\ingredientesService;
use App\Sg\AppBaseController;

class ingredientesController extends AppBaseController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new ingredientesService(); 
    }
    public function store(CreateingredientesAPIRequest $request)
    { 
      $ingredientes = $this->service->create($request->all());
      return $this->sendResponse($ingredientes->toArray(), 'ingredientes guardado exitosamente');
    }
    public function update(UpdateingredientesAPIRequest $request,$id)
    {
       $ingredientes = $this->service->update($request->all(),$id);
       return $this->sendResponse($ingredientes->toArray(), 'ingredientes actualizado exitosamente');
    }
      public function delete($id)
    {        
      $this->service->delete($id);
      return $this->sendResponse(null, 'ingredientes eliminado correctamente');
    }
    public function show($id){
        $row = ingredientes::find($id);
        $result= $row->toArray();
        
        
$result["recetas"]=[];
if($row->recetas()){
  $result["recetas"]= $row->recetas()->get();
}

        
        return $this->sendResponse($result, 'success');
    }
     public function all()
    {
        $row = ingredientes::all();
        $result = $row->toArray();
        foreach ($row as $key => $value) {
           

 $result[$key]["recetas"] = [];
if($value->recetas()){
  $result[$key]["recetas"]= $value->recetas()->get();
}
 

        }
        
        return $this->sendResponse($result, 'success');
    }
    
}
