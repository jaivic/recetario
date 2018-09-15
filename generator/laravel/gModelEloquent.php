<?php
namespace generator\laravel;

use DB;

use Illuminate\Support\Str;

use generator\base\BaseGenerator;
use generator\Utils\FileUtil;
use \Doctrine\DBAL\Types\Type;

class gModelEloquent extends BaseGenerator
{
    public $config;

    public function __construct($config)
    {
        parent::__construct();

        $this->config = $config;
      //  $this->rollbackDir( $this->config->dirFinalModel);

        $this->variables = [
            '$NAMESPACE_MODEL$' => $this->config->nameSpaceFinalModel,
            '$NAMESPACE_MODEL_EXTEND$' => "use Illuminate\Database\Eloquent\Model",
            '$RELATIONS$' => "",
            '$PRIMARY$' => "",
            '$TIMESTAMPS$' => "",
            '$SOFT_DELETE_IMPORT$' => "",
            '$SOFT_DELETE$' => "",
            '$SOFT_DELETE_DATES$' => ""
        ];
    }

    public function run()
    {
        foreach ($this->config->listTable as $Table) {
         // dd($Table);
            if ($Table->enable == true) {
                $this->variables['$MODEL_NAME$'] = $Table->name;
                $this->variables['$TABLE_NAME$'] = $Table->realName;
                $fillables = [];
                foreach ($Table->field as $field) {
                    $fieldName = $field->name;
                    $deleted_at = false;
                    $created_at = false;
                    $updated_at = false;
                    if ($fieldName == "created_at") {
                        $created_at = true;
                    }
                    if ($fieldName == "updated_at") {
                        $updated_at = true;
                    }
                    if ($fieldName == "deleted_at") {
                        $deleted_at = true;
                    }


                    if (!in_array($fieldName, $this->config->noColumn)) {
                        $fillables[] = $this->lnTb("'" . $fieldName . "'");
                    }


                    $date = $this->generateDates($fieldName, $field->type);
                    $dates = [];
                    if (!is_null($date)) {
                        $dates[] = $this->lnTb($date);
                    }
                }
                if ($Table->index) {
                    if ($Table->index[0] != "id") {
                        $this->variables['$PRIMARY$'] = 'protected $primaryKey="' . $Table->index[0] . '";';
                    } else {
                        $this->variables['$PRIMARY$'] = "";
                    }
                }
                $this->variables['$FIELDS$'] = implode(',', $fillables);
                $this->variables['$DATES$'] = implode(',', $dates);


                $this->variables['$RELATIONS$'] = $this->getRelationFunctionText($Table);
                $this->variables['$SYNC$'] = $this->getRelationForSync($Table);

                if (($created_at != true) && ($updated_at != true)) {
                    $this->variables['$TIMESTAMPS$'] = "public \$timestamps = false;\n";
                }
                if ($deleted_at == true) {
                    $this->variables['$SOFT_DELETE_IMPORT$'] = "use Illuminate\Database\Eloquent\SoftDeletes;";
                    $this->variables['$SOFT_DELETE$'] = "use SoftDeletes;";
                } else {
                    $this->variables['$SOFT_DELETE_IMPORT$'] = "";
                    $this->variables['$SOFT_DELETE$'] = "";
                }

                $templateData = $this->getTemplate($this->config->pathTemplateModel);

                $this->createFileWithTemplate($this->config->dirFinalModel, $Table->name . ".php", $this->variables, $templateData);
            }
        }
    }

    public function generateDates($field, $type)
    {
        $date = ["created_at", "updated_at", "deleted_at"];
        $rule = null;
        if (!in_array($field, $date)) {
            if ($type == "datetime") {
                $rule = "'" . $field . "'";
            }
        }
        return $rule;
    }
    public function getRelationFunctionText($Table)
    {
        $templatetotal = "";
        $arrayName = [];
        foreach ($Table->foreignKeys as $relate) {
            $modelName = Str::plural($relate->fkTable);
            $INTERMEDIA = $relate->interTable;
            $FKEY = $relate->fkIndex[0];
            $LKEY = $relate->localIndex[0];


            if (!in_array($modelName, $arrayName)) {
                $arrayName[] = $modelName;
            } else {
                $arrayName[] = $relate->name;
                $modelName = $relate->name;
            };

            switch ($relate->relation) {
                case '1to1':
                    $functionName = camel_case($relate->name);
                    $relation = 'hasOne';
                    $relationClass = 'HasOne';
                    break;
                case '1tm':
                    $functionName = str_plural($relate->name);
                    $relation = 'hasMany';
                    $relationClass = 'HasMany';
                    break;
                case 'mt1':
                    $functionName = camel_case($relate->name);
                    $relation = 'belongsTo';
                    $relationClass = 'BelongsTo';
                    break;
                case 'mtm':
                    $functionName = str_plural($relate->name);
                    $relation = 'belongsToMany';
                    $relationClass = 'BelongsToMany';
                    break;
                case 'hmt':
                    $functionName = str_plural($relate->name);
                    $relation = 'hasManyThrough';
                    $relationClass = 'HasManyThrough';
                    break;
                default:
                    $functionName = '';
                    $relation = '';
                    $relationClass = '';
                    break;
            }
            if (!empty($functionName) and !empty($relation)) {

                if (($relation == "hasOne") || ($relation == "hasMany") || ($relation == "belongsTo")) {
                    $template = $this->getTemplate($this->config->pathTemplateModelRelate);
                }
                if ($relation == "belongsToMany") {
                    $template = $this->getTemplate($this->config->pathTemplateModelRelateMTOM);
                }

                $template = str_replace('$RELATIONSHIP_CLASS$', $relationClass, $template);
                $template = str_replace('$FUNCTION_NAME$', $functionName, $template);
                $template = str_replace('$RELATION$', $relation, $template);
                $template = str_replace('$RELATION_MODEL_NAME$', $modelName, $template);
                $template = str_replace('$NAMESPACE_MODEL$', $this->variables['$NAMESPACE_MODEL$'], $template);
                $template = str_replace('$TABLEINTERMEDIA$', $INTERMEDIA, $template);
                $template = str_replace('$FKEY$', $FKEY, $template);
                $template = str_replace('$LKEY$', $LKEY, $template);
            }
            $templatetotal .= $template;
        }
        return $templatetotal;
    }
    public function getRelationForSync($Table)
    {
        $templatetotal = "";
        $arrayName = [];
        $template = "";
        foreach ($Table->foreignKeys as $relate) {
            $modelName = Str::plural($relate->fkTable);
            $INTERMEDIA = $relate->interTable;
            $FKEY = $relate->fkIndex[0];
            $LKEY = $relate->localIndex[0];


            if (!in_array($modelName, $arrayName)) {
                $arrayName[] = $modelName;
            } else {
                $arrayName[] = $relate->name;
                $modelName = $relate->name;
            };
            $functionName = str_plural($relate->name);
            if ($relate->relation == 'mtm') {

                $template = $this->getTemplate($this->config->pathTemplateModelSyncMTOM);
            }
            if ($relate->relation == '1to1') {

                $template = $this->getTemplate($this->config->pathTemplateModelSync1to1);
            }
            if ($relate->relation == '1tm') {

                $template = $this->getTemplate($this->config->pathTemplateModelSync1tom);
            }
            $template = str_replace('$UCASEMODELDETAILNAME$', ucfirst($functionName), $template);
            $template = str_replace('$METHODNAME$', $functionName, $template);

            $templatetotal .= $template;
        }
        return $templatetotal;
    }
}
/* public function getStatusAttribute()
    {
       
     return   ($this->attributes['status']==1)?true:false;

    } */