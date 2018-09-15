<?php

namespace App\Http\Controllers\Api\admin1;

use App\Http\Models\admin1\roles;
use Illuminate\Http\Request;
use App\Http\Requests\CreaterolesAPIRequest;
use App\Http\Requests\UpdaterolesAPIRequest;
use App\Http\service\admin1\rolesService;
use App\Sg\AppBaseController;

class rolesController extends AppBaseController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new rolesService(); 
    }
    public function store(CreaterolesAPIRequest $request)
    { 
      $roles = $this->service->create($request->all());
      return $this->sendResponse($roles->toArray(), 'roles guardado exitosamente');
    }
    public function update(UpdaterolesAPIRequest $request,$id)
    {
       $roles = $this->service->update($request->all(),$id);
       return $this->sendResponse($roles->toArray(), 'roles actualizado exitosamente');
    }
      public function delete($id)
    {        
      $this->service->delete($id);
      return $this->sendResponse(null, 'roles eliminado correctamente');
    }
    public function show($id){
        $row = roles::find($id);
        $result= $row->toArray();
        
        
$result["users"]=[];
if($row->users()){
  $result["users"]= $row->users()->get();
}

        
        return $this->sendResponse($result, 'success');
    }
     public function all()
    {
        $row = roles::all();
        $result = $row->toArray();
        foreach ($row as $key => $value) {
           

 $result[$key]["users"] = [];
if($value->users()){
  $result[$key]["users"]= $value->users()->get();
}
 

        }
        
        return $this->sendResponse($result, 'success');
    }
    
}
