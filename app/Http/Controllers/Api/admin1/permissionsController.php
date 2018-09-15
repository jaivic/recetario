<?php

namespace App\Http\Controllers\Api\admin1;

use App\Http\Models\admin1\permissions;
use Illuminate\Http\Request;
use App\Http\Requests\CreatepermissionsAPIRequest;
use App\Http\Requests\UpdatepermissionsAPIRequest;
use App\Http\service\admin1\permissionsService;
use App\Sg\AppBaseController;

class permissionsController extends AppBaseController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new permissionsService(); 
    }
    public function store(CreatepermissionsAPIRequest $request)
    { 
      $permissions = $this->service->create($request->all());
      return $this->sendResponse($permissions->toArray(), 'permissions guardado exitosamente');
    }
    public function update(UpdatepermissionsAPIRequest $request,$id)
    {
       $permissions = $this->service->update($request->all(),$id);
       return $this->sendResponse($permissions->toArray(), 'permissions actualizado exitosamente');
    }
      public function delete($id)
    {        
      $this->service->delete($id);
      return $this->sendResponse(null, 'permissions eliminado correctamente');
    }
    public function show($id){
        $row = permissions::find($id);
        $result= $row->toArray();
        
        
$result["roles"]=[];
if($row->roles()){
  $result["roles"]= $row->roles()->get();
}

        
        return $this->sendResponse($result, 'success');
    }
     public function all()
    {
        $row = permissions::all();
        $result = $row->toArray();
        foreach ($row as $key => $value) {
           

 $result[$key]["roles"] = [];
if($value->roles()){
  $result[$key]["roles"]= $value->roles()->get();
}
 

        }
        
        return $this->sendResponse($result, 'success');
    }
    
}
