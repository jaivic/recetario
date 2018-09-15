<?php
namespace generator\base;

use DB;


use Illuminate\Support\Str;
use generator\Utils\FileUtil;
use \Doctrine\DBAL\Types\Type;
use generator\gsg\oBase\model;
use generator\base\BaseGenerator;
use generator\gsg\oBase\fieldModel;

class jsModel extends BaseGenerator
{
  public $config;
  public $model;
  public $relacionesExtras;
//https://www.doctrine-project.org/api/dbal/2.7/Doctrine/DBAL/Schema/Column.html#method_getAutoincrement
  public function run($config)
  {
    $this->config = $config;
    $all = [];
    foreach ($this->config->listTable as $Table) {
      $this->model = new model($Table->getName());
      $this->setForeignKeys($Table);

      foreach ($Table->getColumns() as $field) {

        $fieldforSave = new fieldModel($field->getName(), $this->generateCasts($field->getType()));
        $fieldforSave->addRule($this->generateRule($field));
        $fieldforSave->setWebView("text");
        $this->model->addField($fieldforSave);
        $this->setFieldImportantForRelate($field->getName());
        $this->setFieldCreatedUpdate($field);
        $this->setFieldShowList("this", $field->getName());
      }
      $this->model->addIndex($this->getIndex($Table));
        
      /*  if ($Table->getName()=="tickets"){
        dd($this->model);
        }*/
      $all[] = $this->model;

    }
  // dd($all);
    FileUtil::createFile($this->config->dirJsonFile, "model.json", json_encode($all));
  }

  public function setFieldImportantForRelate($field)
  {

    $nombre = "";
    $tabla = "";
    if (stripos($field, "_id") != false) {

      $post = stripos($field, "_id");
      $this->schemaManager = DB::getDoctrineSchemaManager();
      $nombreTabla = substr($field, 0, $post);
      $tabla = $this->schemaManager->listTableColumns($nombreTabla);
      if (count($tabla) == 0) {

        $tabla = $this->schemaManager->listTableColumns(Str::plural($nombreTabla));
      }
      if (count($tabla) > 0) {
        foreach ($tabla as $field) {
          $this->setFieldShowList(Str::plural($nombreTabla), $field->getName());
           // if(($field->getName() == "title")&& ($field->getName() == "name")){
             // $nombre= $field->getName();
           
          //  }
        }
     
 /*       if ($nombre ==""){
        
          foreach ($tabla as $field) {
         
            if (($nombre == "") && ($field->getType() == Type::getType('string'))) {
              $nombre = $field->getName();
            
            }
          }
        }
         */
     /*   if ($nombre != "") {
        
          
         
        //  $this->model->addfieldImportantRelate(Str::plural($nombreTabla). ":" . $nombre);
        }*/
      }
    }


  }

  public function setForeignKeys($Table)
  {
   // https ://www.doctrine-project.org/api/dbal/2.7/Doctrine/DBAL/Schema/ForeignKeyConstraint.html
    /** buscando relaciones de foreingkeys */
    foreach ($Table->getForeignKeys() as $key => $value) {
   
      $this->model->addForeignKeys(
        Str::plural($value->getForeignTableName()),
        $value->getLocalColumns(),
        $value->getForeignTableName(),
        $value->getForeignColumns()
      );
    }
    /*buscando tablas intermedias para relaciones */
    foreach ($this->config->listTable as $table2) {

      if (stripos($table2->getName(), "_" . str::singular($Table->getName())) != false) {
        $position = stripos($table2->getName(), "_" . str::singular($Table->getName()));
        $nameTableForeign = substr($table2->getName(), 0, $position);
        
//$key,$idLocal,$tabla,$idforeign,$relate="1to1", $interTable=""
        $this->model->addForeignKeys(
          Str::plural($nameTableForeign),
          [str::singular($Table->getName()) . "_id"],
          $nameTableForeign,
          [$nameTableForeign . "_id"],
          "1tm"
        );
      }


      if (stripos($table2->getName(), str::singular($Table->getName()) . "_") !== false) {
        $nameTableForeign = substr($table2->getName(), strlen(str::singular($Table->getName()) . "_"));
        $this->model->addForeignKeys(
          Str::plural($nameTableForeign),
          [str::singular($Table->getName()) . "_id"],
          $nameTableForeign,
          [$nameTableForeign . "_id"],
          "mtm",
          $table2->getName()
        );
        $this->schemaManager = DB::getDoctrineSchemaManager();
        $tablaForshowList = $this->schemaManager->listTableColumns(Str::plural($nameTableForeign));
        foreach ($tablaForshowList as $field) {
          $this->setFieldShowList(Str::plural($nameTableForeign), $field->getName());
        }
      

      //  $this->model->addfieldImportantRelate("mtm_".Str::plural($nameTableForeign) . ":" . $nameTableForeign . "_id");
      }
      //str::singular
  /*    $nombreTabla = substr($table2->getName(), 0, $post);
        if (count($nombreTabla) == 0) {
    }
       */
    }
  }
  public function setFieldCreatedUpdate($field)
  {
    $this->model->addFieldForCreatedUpdate($field->getName());
  }
  public function setFieldShowList($table, $field)
  {
    $this->model->addfieldShowList($table, $field);
  }

  public function generateRule($field)
  {
    $rule = "";
    $item = [];
    if ($field->getNotnull() == true) {
      $item[] = "required";
    }

    if ($field->getType() == Type::getType('string')) {
      $item[] = "max:" . $field->getLength();
    }
    $rule = implode('|', $item) . "";
    return $rule;


  }
  public function getIndex($Table)
  {
    $primaryName = null;
    $indice = $Table->getPrimaryKey();
    if ($indice) {
      $primaryName = $indice->getColumns();
    }

    return $primaryName;
  }
  public function generateCasts($type)
  {
    $casts = [];
        /*dd(Type::getTypesMap());
        "array" => "Doctrine\DBAL\Types\ArrayType"
        "simple_array" => "Doctrine\DBAL\Types\SimpleArrayType"
        "json_array" => "Doctrine\DBAL\Types\JsonArrayType"
        "json" => "Doctrine\DBAL\Types\JsonType"
        "object" => "Doctrine\DBAL\Types\ObjectType"
        "boolean" => "Doctrine\DBAL\Types\BooleanType"
        "integer" => "Doctrine\DBAL\Types\IntegerType"
        "smallint" => "Doctrine\DBAL\Types\SmallIntType"
        "bigint" => "Doctrine\DBAL\Types\BigIntType"
        "string" => "Doctrine\DBAL\Types\StringType"
        "text" => "Doctrine\DBAL\Types\TextType"
        "datetime" => "Doctrine\DBAL\Types\DateTimeType"
        "datetime_immutable" => "Doctrine\DBAL\Types\DateTimeImmutableType"
        "datetimetz" => "Doctrine\DBAL\Types\DateTimeTzType"
        "datetimetz_immutable" => "Doctrine\DBAL\Types\DateTimeTzImmutableType"
        "date" => "Doctrine\DBAL\Types\DateType"
        "date_immutable" => "Doctrine\DBAL\Types\DateImmutableType"
        "time" => "Doctrine\DBAL\Types\TimeType"
        "time_immutable" => "Doctrine\DBAL\Types\TimeImmutableType"
        "decimal" => "Doctrine\DBAL\Types\DecimalType"
        "float" => "Doctrine\DBAL\Types\FloatType"
        "binary" => "Doctrine\DBAL\Types\BinaryType"
        "blob" => "Doctrine\DBAL\Types\BlobType"
        "guid" => "Doctrine\DBAL\Types\GuidType"
        "dateinterval" => "Doctrine\DBAL\Types\DateIntervalType"
     */
        // $timestamps = TableFieldsGenerator::getTimestampFieldNames();

        /*    if (in_array($field->name, $timestamps)) {
        continue;
        }*/

    $rule = "";

    switch ($type) {

      case Type::getType('bigint'):
        $rule .= "'bigint'";
        break;
      case Type::getType('integer'):
        $rule .= "'integer'";
        break;
      case Type::getType('decimal'):
        $rule .= "'double'";
        break;
      case Type::getType('float'):
        $rule .= "'float'";
        break;
      case Type::getType('boolean'):
        $rule .= "'boolean'";
        break;
      case Type::getType('datetime'):
      case Type::getType('datetimetz'):
        $rule .= "'datetime'";
        break;
      case Type::getType('date'):
        $rule .= "'date'";
        break;
       // case Type::getType('enum'):
      case Type::getType('string'):
     //   case Type::getType ('char'):
      case Type::getType('text'):
        $rule .= "'string'";
        break;
      default:
        $rule = '';
        break;
    }

    if (empty($rule)) {
        //$casts[] = $rule;
      return null;
    }


    return $rule;
  }

}