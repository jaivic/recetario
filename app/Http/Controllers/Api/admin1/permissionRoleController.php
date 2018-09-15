<?php

namespace App\Http\Controllers\Api\admin1;

use App\Http\Models\admin1\permissionRole;
use Illuminate\Http\Request;
use App\Http\Requests\CreatepermissionRoleAPIRequest;
use App\Http\Requests\UpdatepermissionRoleAPIRequest;
use App\Http\service\admin1\permissionRoleService;
use App\Sg\AppBaseController;

class permissionRoleController extends AppBaseController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new permissionRoleService(); 
    }
    public function store(CreatepermissionRoleAPIRequest $request)
    { 
      $permissionRole = $this->service->create($request->all());
      return $this->sendResponse($permissionRole->toArray(), 'permissionRole guardado exitosamente');
    }
    public function update(UpdatepermissionRoleAPIRequest $request,$id)
    {
       $permissionRole = $this->service->update($request->all(),$id);
       return $this->sendResponse($permissionRole->toArray(), 'permissionRole actualizado exitosamente');
    }
      public function delete($id)
    {        
      $this->service->delete($id);
      return $this->sendResponse(null, 'permissionRole eliminado correctamente');
    }
    public function show($id){
        $row = permissionRole::find($id);
        $result= $row->toArray();
        
        
$result["permissions"]=[];
if($row->permissions()){
  $result["permissions"]= $row->permissions()->get();
}

$result["roles"]=[];
if($row->roles()){
  $result["roles"]= $row->roles()->get();
}

        
        return $this->sendResponse($result, 'success');
    }
     public function all()
    {
        $row = permissionRole::all();
        $result = $row->toArray();
        foreach ($row as $key => $value) {
           

 $result[$key]["permissions"] = [];
if($value->permissions()){
  $result[$key]["permissions"]= $value->permissions()->get();
}
 


 $result[$key]["roles"] = [];
if($value->roles()){
  $result[$key]["roles"]= $value->roles()->get();
}
 

        }
        
        return $this->sendResponse($result, 'success');
    }
    
}
