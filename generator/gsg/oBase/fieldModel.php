<?php

namespace generator\gsg\oBase;
use Illuminate\Support\Str;


class fieldModel extends \stdClass {
  
 // public  $field;
  
  public function __construct($name,$type){
     // $this = new \stdClass();
      $this->name = $name;
      $this->type = $type;
      $this->humanName = Str::snake(Str::camel($name));
  }
  public function addRule($rule){
      $this->rule =$rule;
  }
  public function addWebViewFill($name="text",$data=""){
    $a = new \stdClass();
    $a->name=$name;
    $a->data=$data;
    $this->viewFill =$a;
  }

  public function adddWebViewShow($name="text"){
    $this->viewShow =$name;
  }

  public function setWebView($type){
    if ($type=="text"){
      $this->addWebViewFill("text","");
      $this->adddWebViewShow("text");
    }
  }
}