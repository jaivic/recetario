<?php

namespace App\Http\Controllers\admin1;

use App\Http\Models\admin1\passwordResets;
use Illuminate\Http\Request;
use App\Http\Requests\CreatepasswordResetsAPIRequest;
use App\Http\Requests\UpdatepasswordResetsAPIRequest;
use App\Http\service\admin1\passwordResetsService;
use App\Sg\SgController;

class passwordResetsController extends SgController
{
    public $service;
  
    public function __construct()
    {
      $this->service=new passwordResetsService(); 
    }
    public function index()
    {
      $passwordResets = passwordResets::all();
      return view('admin1.passwordResets.index',compact("passwordResets"));
    }
    public function create(){
      return view('admin1.passwordResets.create');
    }
    public function edit($id){
      $passwordResets = passwordResets::find($id);
      return view('admin1.passwordResets.edit',compact("passwordResets"));
    }
     public function show($id){
        $row = passwordResets::find($id);
        return view('admin1.passwordResets.show',compact("row"));
    }
    public function store(CreatepasswordResetsAPIRequest $request)
    { 
        $passwordResets = $this->service->create($request->all());
        return redirect("passwordresets/edit/$passwordResets->id")
        ->with('status', 'Cambios agregada correctamente');
    }
    public function update(UpdatepasswordResetsAPIRequest $request,$id)
    {
        $passwordResets = $this->service->update($request->all(),$id);
        return redirect("passwordresets/edit/$passwordResets->id")
        ->with('status', 'Cambios agregada correctamente');
    }
      public function delete($id)
    {        
        $this->service->delete($id);
        return redirect("passwordresets/index")->with('status', 'Cambios agregada correctamente');
    }  
}
