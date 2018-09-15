<?php
namespace generator;


use DB;

use Illuminate\Support\Str;

use generator\Utils\FileUtil;
use \Doctrine\DBAL\Types\Type;

use generator\BaseGenerator;
class DbAnalyzer extends BaseGenerator
{
  public $schemaManager;
  public $listTable;
  public $pathModel;
  public $pathJson;
  public function __construct()
  {
      $this->schemaManager = DB::getDoctrineSchemaManager();
      $platform = $this->schemaManager->getDatabasePlatform();  
      $platform->registerDoctrineTypeMapping('enum', 'string');
      $platform->registerDoctrineTypeMapping('json', 'text');
      $this->listTable= $this->schemaManager->listTables();
      $this->pathJson = base_path("App\json\\");
      $this->pathModel = base_path("App\Models\\");
      $this->pathController = base_path("App\Controller\admin\\");
      $this->viewPath = base_path("resources/views/admin/");
      $this->generateView();
      $this->generateRouter();
      $this->generateModels();
      $this->generateRequests();
      $this->generateServices();
      $this->generateController();
      //  $this->generateApiController();
      //  $databases = $this->schemaManager->listDatabases();
      //dd($databases);


      //   $this->primaryKey = static::getPrimaryKeyOfTable("mibanco");
      //    $this->timestamps = static::getTimestampFieldNames();

  }
 
 
function generateRouter(){
    $this->path = base_path ("routes/web.php");

    $this->routeContents = file_get_contents($this->path);

    foreach ($this->listTable as $Table) {
     
      $templateData = file_get_contents(base_path("generator/template/routes/api_routes_group.stub"));
      $variables = [
        '$ROUTE_PREFIX$' => Str::lower( Str::camel($Table->getName())),
        '$PATH_PREFIX$' => "admin\\",
        '$MODEL_NAME$' =>Str::camel($Table->getName()),
      ];
      foreach ($variables as $variable => $value) {
        $templateData = str_replace($variable, $value, $templateData);
      }
      $this->routeContents .= "\n\n" . $templateData;
    }
    file_put_contents($this->path, $this->routeContents);
}
function generateViewCreate(){
 /*create*/
    foreach ($this->listTable as $Table) {
      $templateData = file_get_contents(base_path("generator/template/view/create.stub"));
      $variables = [
        '$ROUTE_NAMED_PREFIX$' => "",
        '$MODEL_NAME_PLURAL_CAMEL$' => Str::lower(Str::camel($Table->getName())),
        '$VIEW_PREFIX$' => Str::camel($Table->getName()),
        '$VIEW_FOLDER$'=>"admin"
      ];
      foreach ($variables as $variable => $value) {
        $templateData = str_replace($variable, $value, $templateData);
      }

      $path = $this->viewPath . Str::camel($Table->getName()) . "/";
      $name = "create.blade.php";
      FileUtil::createFile($path, $name, $templateData);

    }
}
  function generateViewCreateFields()
  {
 /* fields*/
    foreach ($this->listTable as $Table) {
      $fieldsTotal = "";

      foreach ($Table->getColumns() as $field) {
        $templateField = file_get_contents(base_path("generator/template/view/fields/text.stub"));
        $variables = [
          '$FIELD_NAME_TITLE$' => Str::camel($field->getName()),
          '$FIELD_NAME$' => Str::camel($field->getName()),
        
        ];
        foreach ($variables as $variable => $value) {
          $templateField = str_replace($variable, $value, $templateField);
        }

        $fieldsTotal .= $templateField;
      }

      $templateData = file_get_contents(base_path("generator/template/view/fields.stub"));
      $variables = [
        '$FIELDS$' => $fieldsTotal,
        '$ROUTE_NAMED_PREFIX$' => "",
        '$MODEL_NAME_PLURAL_CAMEL$' => Str::lower(Str::camel($Table->getName())),
      ];
      foreach ($variables as $variable => $value) {
        $templateData = str_replace($variable, $value, $templateData);
      }

      $path = $this->viewPath . Str::camel($Table->getName()) . "/";
      $name = "fields.blade.php";
      FileUtil::createFile($path, $name, $templateData);

    }
  }
  function generateViewEdit()
  {
    /*create*/
    foreach ($this->listTable as $Table) {
      $templateData = file_get_contents(base_path("generator/template/view/edit.stub"));
      $variables = [
        '$ROUTE_NAMED_PREFIX$' => "",
        '$MODEL_NAME_PLURAL_CAMEL$' => Str::lower(Str::camel($Table->getName())),
        '$VIEW_PREFIX$' => Str::camel($Table->getName()),
        '$VIEW_FOLDER$' => "admin"
      ];
      foreach ($variables as $variable => $value) {
        $templateData = str_replace($variable, $value, $templateData);
      }

      $path = $this->viewPath . Str::camel($Table->getName()) . "/";
      $name = "edit.blade.php";
      FileUtil::createFile($path, $name, $templateData);
    }
  }
  function generateViewEditFields()
  {
    /* fields*/
    foreach ($this->listTable as $Table) {
      $fieldsTotal = "";

      foreach ($Table->getColumns() as $field) {
        $templateField = file_get_contents(base_path("generator/template/view/fields/text.stub"));
        $variables = [
          '$FIELD_NAME_TITLE$' => Str::camel($field->getName()),
          '$FIELD_NAME$' => Str::camel($field->getName()),
        ];
        foreach ($variables as $variable => $value) {
          $templateField = str_replace($variable, $value, $templateField);
        }

        $fieldsTotal .= $templateField;
      }

      $templateData = file_get_contents(base_path("generator/template/view/fields.stub"));
      $variables = [
        '$FIELDS$' => $fieldsTotal,
        '$ROUTE_NAMED_PREFIX$' => "",
        '$MODEL_NAME_PLURAL_CAMEL$' => Str::lower(Str::camel($Table->getName())),
      ];
      foreach ($variables as $variable => $value) {
        $templateData = str_replace($variable, $value, $templateData);
      }

      $path = $this->viewPath . Str::camel($Table->getName()) . "/";
      $name = "editfields.blade.php";
      FileUtil::createFile($path, $name, $templateData);

    }
  }
  function generateView(){
    $this->generateViewCreate();
    $this->generateViewCreateFields();
    $this->generateViewEdit();
    $this->generateViewEditFields();

  }
  


  public function generateController()
  {

    foreach ($this->listTable as $Table) {
      $templateData = file_get_contents(base_path("generator/template/controllers/apiController.stub"));
      $name = Str::camel($Table->getName());
      $variables = [
        '$NAMESPACE_CONTROLLER$'=>"App\Http\Controllers\admin",
        '$NAMESPACE_SERVICE$' => "App\Http\service",
        '$NAMESPACE_MODEL$' => "App\Models\\" . $name,
        '$MODAL_NAME$' => $name,
        '$NAMESPACE_REQUEST$' => "App\Http\Requests",
        '$SERVICE_NAME$' => $name,
          ];
      foreach ($variables as $variable => $value) {
        $templateData = str_replace($variable, $value, $templateData);
      }
   
      $name .= "ApiController.php";
      FileUtil::createFile(base_path("App\Http\Controllers\admin\\"), $name, $templateData);


    }


  }
  public function generateServices()
  {
    
    foreach ($this->listTable as $Table) {
      $templateData = file_get_contents(base_path("generator/template/service/service.stub"));
     $name= Str::camel($Table->getName());
      $variables=[
        '$NAMESPACE$'=>"app\Http\service",
        '$NAMESPACE_MODEL$' => "App\Models\\". $name,
        '$CLASS_NAME$'=> $name,
        '$MODAL_NAME$' => $name,
      ];
      foreach ($variables as $variable => $value) {
        $templateData = str_replace($variable, $value, $templateData);
      }
      $name .=  "Service.php";
      FileUtil::createFile(base_path("App\Http\service\\"), $name, $templateData);
      
  
    }


  }
  public function generateRequests(){
    foreach ($this->listTable as $Table) {
      $this->generateCreateRequest($Table);
      $this->generateUpdateRequest($Table);
    }
  }
  public function generateModels()
  {
      // dd($this->pathModel);
      //dd($this->listTable);
      /* foreach ($this->listTable as $Table) {
      //dd($Table->getPrimaryKey());
      if($Table->getName()=="tickets")
      dd ($Table->getForeignKeys());
      }*/
    
    foreach($this->listTable as $Table){
      $path = base_path("generator/template/model/model.stub");
      $templateData = file_get_contents($path);
      //dd($Table->getPrimaryKey());
      //dd($Table->getForeignKeys());
       // ->listTableDetails($tableName)->getPrimaryKey();
   
      //  dd( file_get_contents($path));


      $variables=[
        '$MODEL_NAME$'=> Str::camel($Table->getName()),
        '$NAMESPACE_MODEL$'=> "App\Models",
        '$NAMESPACE_MODEL_EXTEND$'=> "use Illuminate\Database\Eloquent\Model",
        '$TABLE_NAME$'=> $Table->getName(),
        '$DOCS$'=>"",
        '$RELATIONS$' =>"",
        '$PRIMARY$' => "",
        '$RULES$' => "", 
      ];
    
      $casts=[];
      $fillables=[];
      $rules=[];
      $dates = [];
      $deleted_at=false;
      $created_at=false;
      $updated_at = false;
        foreach ($Table->getColumns() as $field) {
    
        
          $fieldName= $field->getName();
          if ($fieldName =="created_at"){
            $created_at=true;
          }
          if ($fieldName == "updated_at") {
            $updated_at=true;
          }
          if ($fieldName == "deleted_at") {
            $deleted_at=true;
          }
          $fillables[] = $this->lnTb("'" . $fieldName . "'");
          /* $cast= $this->generateCasts($fieldName, $field->getType());
            if (!is_null($cast)){
              $casts[] =   $cast;
            }*/
          $casts[] = $this->lnTb($this->generateCasts($fieldName, $field->getType()));
          $date =  $this->generateDates($fieldName, $field->getType());
          if (!is_null($date)) {
            $dates[] = $this->lnTb($date);
          }
          $rules[] = $this->lnTb($this->generateRule($field));
         
      }

      $variables['$FIELDS$']=  implode(',', $fillables);
      $variables['$CAST$'] = implode(',', $casts);
      $variables['$DATES$'] = implode(',', $dates);
      $variables['$APIRULES$'] = implode(',', $rules);
      $variables['$CONTROLLERRULES$'] = implode(',', $rules);

      if (($created_at == true)&&($updated_at==true)){
        $variables['$TIMESTAMPS$'] = "";
      }else{
        $variables['$TIMESTAMPS$'] = "public \$timestamps = false;\n";
      }
      if ($deleted_at == true) {
        $variables['$SOFT_DELETE_IMPORT$'] = "use Illuminate\Database\Eloquent\SoftDeletes;";
        $variables['$SOFT_DELETE$'] =  "use SoftDeletes;";
        $variables['$SOFT_DELETE_DATES$'] =  'protected $dates = '. "['deleted_at'];";
      } else {
        $variables['$SOFT_DELETE_IMPORT$'] = "";
        $variables['$SOFT_DELETE$'] = "";
        $variables['$SOFT_DELETE_DATES$'] = "";
      }
      foreach ($variables as $variable => $value) {
        $templateData = str_replace($variable, $value, $templateData);
      }
      FileUtil::createFile($this->pathModel, Str::camel($Table->getName()).".php", $templateData);
    }

  }

public function generateDates($field,$type){
    $date=["created_at",
    "updated_at",
    "deleted_at"];
    $rule = null;
    if (!in_array($field, $date)) {
     switch ($type) {
      case Type::getType('datetime'):
      case Type::getType('datetimetz'):
        $rule = "'".$field. "'";
        break;
      default:
        $rule = null;
        break;
      }
    }
      return $rule;
}

  public  function generateRule($field)
  {
  
    $item=[];
    $rule = "'" . $field->getName() . "' => '";
    if($field->getNotnull()==true){
      $item[] = "required";
    }

    if ($field->getType() == Type::getType('string')){
      $item[] = "max:".$field->getLength();
    }
    $rule.= implode('|', $item)."'";
    return $rule;
    

  }
  public function generateCasts($name,$type)
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

      $rule = "'" . $name . "' => ";

      switch ($type) {
      
        case Type::getType('bigint') :
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
        case Type::getType ('datetimetz'):
          $rule .= "'datetime'";
          break;
        case Type::getType('date'):
          $rule .= "'date'";
          break;
       // case Type::getType('enum'):
        case Type::getType ('string'):
     //   case Type::getType ('char'):
        case Type::getType ('text'):
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
  private function generateCreateRequest($Table)
  {
    $path = base_path("generator/template/request/create_api_request.stub");
    $templateData = file_get_contents($path);
      //  dd( file_get_contents($path));


    $variables = [
      '$MODEL_NAME$' => Str::camel($Table->getName()),
      '$NAMESPACE_MODEL$' => "App\Models",
      '$NAMESPACE_API_REQUEST$' => "App\Http\Requests",
    ];

    foreach ($variables as $variable => $value) {
      $templateData = str_replace($variable, $value, $templateData);
    }
    $nameApi=  "Create" .Str::camel($Table->getName()). "APIRequest.php";
    FileUtil::createFile(base_path("App\Http\Requests\\"), $nameApi , $templateData);
/*
    $path = base_path("generator/template/request/create_request.stub");
    $templateData = file_get_contents($path);
    foreach ($variables as $variable => $value) {
      $templateData = str_replace($variable, $value, $templateData);
    }
    $name = "Create" . Str::camel($Table->getName()) . "Request.php";
    FileUtil::createFile(base_path("App\Http\Requests\\"), $name, $templateData); */
  }

  private function generateUpdateRequest($Table)
  {
    $path = base_path("generator/template/request/update_api_request.stub");
    $templateData = file_get_contents($path);
      //  dd( file_get_contents($path));


    $variables = [
      '$MODEL_NAME$' => Str::camel($Table->getName()),
      '$NAMESPACE_MODEL$' => "App\Models",
      '$NAMESPACE_API_REQUEST$' => "App\Http\Requests",
    ];

    foreach ($variables as $variable => $value) {
      $templateData = str_replace($variable, $value, $templateData);
    }
    $nameApi = "Update" . Str::camel($Table->getName()) . "APIRequest.php";
    FileUtil::createFile(base_path("App\Http\Requests\\"), $nameApi, $templateData);
  }
  private function fillTemplate1($templateData)
  {
    $templateData = fill_template($this->commandData->dynamicVars, $templateData);

    $templateData = $this->fillSoftDeletes($templateData);

    $fillables = [];

    foreach ($this->commandData->fields as $field) {
      if ($field->isFillable) {
        $fillables[] = "'" . $field->name . "'";
      }
    }

    $templateData = $this->fillDocs($templateData);

    $templateData = $this->fillTimestamps($templateData);

    if ($this->commandData->getOption('primary')) {
      $primary = infy_tab() . "protected \$primaryKey = '" . $this->commandData->getOption('primary') . "';\n";
    } else {
      $primary = '';
    }

    $templateData = str_replace('$PRIMARY$', $primary, $templateData);

    $templateData = str_replace('$FIELDS$', implode(',' . infy_nl_tab(1, 2), $fillables), $templateData);

    $templateData = str_replace('$RULES$', implode(',' . infy_nl_tab(1, 2), $this->generateRules()), $templateData);

    $templateData = str_replace('$CAST$', implode(',' . infy_nl_tab(1, 2), $this->generateCasts()), $templateData);

    $templateData = str_replace(
      '$RELATIONS$',
      fill_template($this->commandData->dynamicVars, implode(PHP_EOL . infy_nl_tab(1, 1), $this->generateRelations())),
      $templateData
    );

    $templateData = str_replace('$GENERATE_DATE$', date('F j, Y, g:i a T'), $templateData);

    return $templateData;
  }



  public function generateColumn()  
  {
    $this->columns = $this->schemaManager->listTableColumns("agency");
  }
}