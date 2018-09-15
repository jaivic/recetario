<?php

namespace App\Http\Controllers\Api\admin1;

use App\Http\Models\admin1\categorias;
use Illuminate\Http\Request;
use App\Http\Requests\CreatecategoriasAPIRequest;
use App\Http\Requests\UpdatecategoriasAPIRequest;
use App\Http\service\admin1\categoriasService;
use App\Sg\AppBaseController;

class categoriasController extends AppBaseController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new categoriasService(); 
    }
    public function store(CreatecategoriasAPIRequest $request)
    { 
      $categorias = $this->service->create($request->all());
      return $this->sendResponse($categorias->toArray(), 'categorias guardado exitosamente');
    }
    public function update(UpdatecategoriasAPIRequest $request,$id)
    {
       $categorias = $this->service->update($request->all(),$id);
       return $this->sendResponse($categorias->toArray(), 'categorias actualizado exitosamente');
    }
      public function delete($id)
    {        
      $this->service->delete($id);
      return $this->sendResponse(null, 'categorias eliminado correctamente');
    }
    public function show($id){
        $row = categorias::find($id);
        $result= $row->toArray();
        
        
        
        return $this->sendResponse($result, 'success');
    }
     public function all()
    {
        $row = categorias::all();
        $result = $row->toArray();
        foreach ($row as $key => $value) {
           
        }
        
        return $this->sendResponse($result, 'success');
    }
    
}
