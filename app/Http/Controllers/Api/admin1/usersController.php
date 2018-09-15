<?php

namespace App\Http\Controllers\Api\admin1;

use App\Http\Models\admin1\users;
use Illuminate\Http\Request;
use App\Http\Requests\CreateusersAPIRequest;
use App\Http\Requests\UpdateusersAPIRequest;
use App\Http\service\admin1\usersService;
use App\Sg\AppBaseController;

class usersController extends AppBaseController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new usersService(); 
    }
    public function store(CreateusersAPIRequest $request)
    { 
      $users = $this->service->create($request->all());
      return $this->sendResponse($users->toArray(), 'users guardado exitosamente');
    }
    public function update(UpdateusersAPIRequest $request,$id)
    {
       $users = $this->service->update($request->all(),$id);
       return $this->sendResponse($users->toArray(), 'users actualizado exitosamente');
    }
      public function delete($id)
    {        
      $this->service->delete($id);
      return $this->sendResponse(null, 'users eliminado correctamente');
    }
    public function show($id){
        $row = users::find($id);
        $result= $row->toArray();
        
        
        
        return $this->sendResponse($result, 'success');
    }
     public function all()
    {
        $row = users::all();
        $result = $row->toArray();
        foreach ($row as $key => $value) {
           
        }
        
        return $this->sendResponse($result, 'success');
    }
    
}
