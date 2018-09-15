<?php
namespace generator\laravel;

use DB;

use Illuminate\Support\Str;

use generator\base\BaseGenerator;
use generator\Utils\FileUtil;
use \Doctrine\DBAL\Types\Type;

class gModelIOS extends BaseGenerator
{

    public function __construct($config)
    {
        parent::__construct();

        $this->config = $config;
       // $this->rollbackDir( $this->config->dirFinalApiController);

        $this->variables=[
          '$MODEL$' => "",
          '$VAR$'=> "",
          '$STRUCT$' => "",
        ];
    }
    public function run()
    {
        foreach ($this->config->listTable as $Table) {
            if ($Table->enable == true) {
                $name = ucfirst($Table->name);
                $name =   Str::singular($name);
                $this->variables['$MODEL$'] = $name;
                $this->generateShowfunction($Table);
                $name .= ".swift";
                //  dd($this->variables);
                $templateData = $this->getTemplate($this->config->pathTemplateModelIOS);
                $this->createFileWithTemplate($this->config->dirFinalBaseIOS, $name, $this->variables, $templateData);
            }
        }
    }
    public function generateShowfunction($Table)
    {
        $this->variables['$STRUCT$'] = "";
        $this->variables['$VAR$'] = "";
        foreach ($Table->fieldShowList as $key => $model) {
            if ($key!="this") {
                $name = Str::singular($key);
                  $this->variables['$STRUCT$'].= $this->lnTb("var " . $key.": [". ucfirst($name)."]" . "");
            } else {
                foreach ($model as $item) {
                    $item = $this->searchItem($Table, $item);
                    $this->variables['$VAR$'] .= $this->lnTb("var ". $item->name . ": ".$this->typeSwift($item->type) . $this->requerido($item->rule) . "");
                }
            }
        }
    }
    function requerido($item)
    {
        if (strstr($item, "required")==false) {
            return "?";
        }
        return "";
    }
    function searchItem($Table, $name)
    {
        foreach ($Table->field as $item) {
            if ($item->name == $name) {
                return $item;
            }
        }
        return null;
    }

    public function typeSwift($type)
    {
        $casts = [];
     
        $rule = "";

        switch ($type) {
            case "'bigint'":
            case "'integer'":
                $rule .= "Int";
                break;
            case "'double'":
            case "'float'":
                $rule .= "Double";
                break;
            case "'boolean'":
                $rule .= "Bool";
                break;
            case "'datetime'":
            case "'date'":
            case "'string'":
                $rule .= "String";
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
    public function generateController()
    {
        foreach ($this->config->listTable as $Table) {
            $name = Str::camel($Table->getName());
            $this->variables['$NAMESPACE_MODEL$'] = $this->config->nameSpaceFinalModel . "\\" . $name;
            $this->variables['$MODAL_NAME$'] = $name;
            $this->variables['$SERVICE_NAME$'] = $name;
            $this->variables['$ROUTE$'] = Str::lower($name);
            $name .= "Controller.php";
            $templateData = $this->getTemplate($this->config->pathTemplateController);
            $this->createFileWithTemplate($this->config->dirFinalController, $name, $this->variables, $templateData);
        }
    }
}
