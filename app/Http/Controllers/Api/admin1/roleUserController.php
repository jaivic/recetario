<?php

namespace App\Http\Controllers\Api\admin1;

use App\Http\Models\admin1\roleUser;
use Illuminate\Http\Request;
use App\Http\Requests\CreateroleUserAPIRequest;
use App\Http\Requests\UpdateroleUserAPIRequest;
use App\Http\service\admin1\roleUserService;
use App\Sg\AppBaseController;

class roleUserController extends AppBaseController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new roleUserService(); 
    }
    public function store(CreateroleUserAPIRequest $request)
    { 
      $roleUser = $this->service->create($request->all());
      return $this->sendResponse($roleUser->toArray(), 'roleUser guardado exitosamente');
    }
    public function update(UpdateroleUserAPIRequest $request,$id)
    {
       $roleUser = $this->service->update($request->all(),$id);
       return $this->sendResponse($roleUser->toArray(), 'roleUser actualizado exitosamente');
    }
      public function delete($id)
    {        
      $this->service->delete($id);
      return $this->sendResponse(null, 'roleUser eliminado correctamente');
    }
    public function show($id){
        $row = roleUser::find($id);
        $result= $row->toArray();
        
        
$result["users"]=[];
if($row->users()){
  $result["users"]= $row->users()->get();
}

$result["roles"]=[];
if($row->roles()){
  $result["roles"]= $row->roles()->get();
}

        
        return $this->sendResponse($result, 'success');
    }
     public function all()
    {
        $row = roleUser::all();
        $result = $row->toArray();
        foreach ($row as $key => $value) {
           

 $result[$key]["users"] = [];
if($value->users()){
  $result[$key]["users"]= $value->users()->get();
}
 


 $result[$key]["roles"] = [];
if($value->roles()){
  $result[$key]["roles"]= $value->roles()->get();
}
 

        }
        
        return $this->sendResponse($result, 'success');
    }
    
}
