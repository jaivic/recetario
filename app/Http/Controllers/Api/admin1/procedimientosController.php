<?php

namespace App\Http\Controllers\Api\admin1;

use App\Http\Models\admin1\procedimientos;
use Illuminate\Http\Request;
use App\Http\Requests\CreateprocedimientosAPIRequest;
use App\Http\Requests\UpdateprocedimientosAPIRequest;
use App\Http\service\admin1\procedimientosService;
use App\Sg\AppBaseController;

class procedimientosController extends AppBaseController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new procedimientosService(); 
    }
    public function store(CreateprocedimientosAPIRequest $request)
    { 
      $procedimientos = $this->service->create($request->all());
      return $this->sendResponse($procedimientos->toArray(), 'procedimientos guardado exitosamente');
    }
    public function update(UpdateprocedimientosAPIRequest $request,$id)
    {
       $procedimientos = $this->service->update($request->all(),$id);
       return $this->sendResponse($procedimientos->toArray(), 'procedimientos actualizado exitosamente');
    }
      public function delete($id)
    {        
      $this->service->delete($id);
      return $this->sendResponse(null, 'procedimientos eliminado correctamente');
    }
    public function show($id){
        $row = procedimientos::find($id);
        $result= $row->toArray();
        
        
        
        return $this->sendResponse($result, 'success');
    }
     public function all()
    {
        $row = procedimientos::all();
        $result = $row->toArray();
        foreach ($row as $key => $value) {
           
        }
        
        return $this->sendResponse($result, 'success');
    }
    
}
