<?php

namespace App\Http\Controllers\Api\admin1;

use App\Http\Models\admin1\migrations;
use Illuminate\Http\Request;
use App\Http\Requests\CreatemigrationsAPIRequest;
use App\Http\Requests\UpdatemigrationsAPIRequest;
use App\Http\service\admin1\migrationsService;
use App\Sg\AppBaseController;

class migrationsController extends AppBaseController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new migrationsService(); 
    }
    public function store(CreatemigrationsAPIRequest $request)
    { 
      $migrations = $this->service->create($request->all());
      return $this->sendResponse($migrations->toArray(), 'migrations guardado exitosamente');
    }
    public function update(UpdatemigrationsAPIRequest $request,$id)
    {
       $migrations = $this->service->update($request->all(),$id);
       return $this->sendResponse($migrations->toArray(), 'migrations actualizado exitosamente');
    }
      public function delete($id)
    {        
      $this->service->delete($id);
      return $this->sendResponse(null, 'migrations eliminado correctamente');
    }
    public function show($id){
        $row = migrations::find($id);
        $result= $row->toArray();
        
        
        
        return $this->sendResponse($result, 'success');
    }
     public function all()
    {
        $row = migrations::all();
        $result = $row->toArray();
        foreach ($row as $key => $value) {
           
        }
        
        return $this->sendResponse($result, 'success');
    }
    
}
