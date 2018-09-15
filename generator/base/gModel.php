<?php
namespace generator\base;

use DB;

use Illuminate\Support\Str;

use generator\base\BaseGenerator;
use generator\Utils\FileUtil;
use \Doctrine\DBAL\Types\Type;

class gModel extends BaseGenerator
{
    public $config;

    public function __construct($config)
    {
        parent::__construct();

        $this->config= $config;
      //  $this->rollbackDir( $this->config->dirFinalModel);
  
        $this->variables=[
        '$NAMESPACE_MODEL$'=> $this->config->nameSpaceFinalModel,
        '$NAMESPACE_MODEL_EXTEND$'=> "use Illuminate\Database\Eloquent\Model",
        '$DOCS$'=>"",
        '$RELATIONS$' =>"",
        '$PRIMARY$' => "",
        '$RULES$' => "",
        '$TIMESTAMPS$' => "",
        '$SOFT_DELETE_IMPORT$' => "",
        '$SOFT_DELETE$' => "",
        '$SOFT_DELETE_DATES$' => ""
        ];
    }

    public function run()
    {
        foreach ($this->config->listTable as $Table) {
            $this->variables['$MODEL_NAME$']= Str::camel($Table->getName());
            $this->variables['$TABLE_NAME$']= $Table->getName();
            $casts=[];
            $fillables=[];
        //$rules=[];
            $dates = [];
        /*  $deleted_at=false;
      $created_at=false;
          $updated_at = false;*/

            foreach ($Table->getColumns() as $field) {
                $fieldName= $field->getName();
                $deleted_at=false;
                $created_at=false;
                $updated_at = false;
                if ($fieldName =="created_at") {
                    $created_at=true;
                }
                if ($fieldName == "updated_at") {
                    $updated_at=true;
                }
                if ($fieldName == "deleted_at") {
                    $deleted_at=true;
                }
                $fillables[] = $this->lnTb("'" . $fieldName . "'");
                $cast= $this->generateCasts($fieldName, $field->getType());
                if (!is_null($cast)) {
                    $casts[] =   $cast;
                }
            //  $casts[] = $this->lnTb($this->generateCasts($fieldName, $field->getType()));
                $date =  $this->generateDates($fieldName, $field->getType());
                if (!is_null($date)) {
                    $dates[] = $this->lnTb($date);
                }
            //$rules[] = $this->lnTb($this->generateRule($field));
            }

            $this->variables['$FIELDS$']=  implode(',', $fillables);
            $this->variables['$CAST$'] = implode(',', $casts);
            $this->variables['$DATES$'] = implode(',', $dates);
            if (($created_at != true)&&($updated_at!=true)) {
                $this->variables['$TIMESTAMPS$'] = "public \$timestamps = false;\n";
            }
            if ($deleted_at == true) {
                $this->variables['$SOFT_DELETE_IMPORT$'] = "use Illuminate\Database\Eloquent\SoftDeletes;";
                $this->variables['$SOFT_DELETE$'] =  "use SoftDeletes;";
            } else {
                $this->variables['$SOFT_DELETE_IMPORT$'] = "";
                $this->variables['$SOFT_DELETE$'] =  "";
            }
    
            $templateData = $this->getTemplate($this->config->pathTemplateModel);
            $this->createFileWithTemplate($this->config->dirFinalModel, Str::camel($Table->getName()).".php", $this->variables, $templateData);
        }
    }
 
    public function generateDates($field, $type)
    {
        $date=["created_at","updated_at"];
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

    public function generateCasts($name, $type)
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
