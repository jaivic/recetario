<?php
namespace generator\gsg\oBase;
use Illuminate\Support\Str;
class model extends \stdClass {
  /***https://www.doctrine-project.org/api/dbal/2.7/Doctrine/DBAL/Schema/Column.html#method_getAutoincrement */
  public function __construct($table){
    
      $this->enable = true;
      $this->request = true;
      $this->realName = $table;
      $this->name = Str::camel($table);
      $this->humanName = Str::snake(Str::camel($table));
      $this->field = [];
      $this->index = [];
      $this->foreignKeys=[];
      $this->fieldImportantRelate =[];
    $this->foreignKeysname = [];
  }
  public function addField($field){
    $this->field[]=$field;	
  }
  public function addForeignKeys($key,$idLocal,$tabla,$idforeign,$relate="1to1", $interTable=""){

    

    $x = new \stdClass();
    $x->name= $key;
    $x->localIndex = $idLocal;
    $x->fkTable = $tabla;
    $x->fkIndex= $idforeign;
    $x->relation= $relate;
    $x->interTable=$interTable;

    if (!in_array($key, $this->foreignKeysname)) {
      $this->foreignKeysname[] = $key;
    } else {
      $this->foreignKeysname[] = $key. $idforeign;
      $x->name = $key . $idforeign;
     
    }
   
    $this->foreignKeys[] = $x ;
  }
  public function addFieldForCreatedUpdate($name){
    $this->fieldCreatedUpdate[] =$name;
  }
  public function addfieldShowList($table,$name){
    $this->fieldShowList[$table][] =$name;
  }
  public function addfieldImportantRelate($name)
  {
    $this->fieldImportantRelate[] = $name;
  }
  public function addIndex($name){
    $this->index = $name;
  }
}