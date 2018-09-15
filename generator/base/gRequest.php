<?php
namespace generator\base;

use DB;

use Illuminate\Support\Str;

use generator\Utils\FileUtil;
use \Doctrine\DBAL\Types\Type;


use generator\base\BaseGenerator;

class gRequest extends BaseGenerator
{


    public $pathTemplate;

    public function __construct($config)
    {
        parent::__construct();

        $this->config = $config;
     // $this->rollbackDir( $this->config->dirFinalRequest);
        $this->variables=[
        '$NAMESPACE_API_REQUEST$' => $this->config->nameSpaceFinalRequest,
        ];
    }

    public function run()
    {
        foreach ($this->config->listTable as $Table) {
            $this->generateCreateRequest($Table);
            $this->generateUpdateRequest($Table);
            $this->generateCreateAPIRequest($Table);
            $this->generateUpdateAPIRequest($Table);
        }
    }

    private function generateCreateRequest($Table)
    {
        $rules=[];
  

        foreach ($Table->getColumns() as $field) {
            $rules[] = $this->lnTb($this->generateRule($field));
        }
        $this->variables['$MODEL_NAME$'] = Str::camel($Table->getName());
        $this->variables['$APIRULES$'] = implode(',', $rules);

        $nameApi = "Create" . Str::camel($Table->getName()) . "Request.php";
        $templateData = $this->getTemplate($this->config->pathTemplateCreate);

        $this->createFileWithTemplate($this->config->dirFinalRequest, $nameApi, $this->variables, $templateData);
    }

    private function generateUpdateRequest($Table)
    {
        $rules=[];
        $this->variables['$MODEL_NAME$']= Str::camel($Table->getName());
        foreach ($Table->getColumns() as $field) {
            $rules[] = $this->lnTb($this->generateRule($field));
        }
        $this->variables['$APIRULES$'] = implode(',', $rules);
        $nameApi = "Update" . Str::camel($Table->getName()) . "Request.php";
        $templateData = $this->getTemplate($this->config->pathTemplateUpdate);

        $this->createFileWithTemplate($this->config->dirFinalRequest, $nameApi, $this->variables, $templateData);
    }

    private function generateCreateAPIRequest($Table)
    {
        $rules = [];


        foreach ($Table->getColumns() as $field) {
            $rules[] = $this->lnTb($this->generateRule($field));
        }
        $this->variables['$MODEL_NAME$'] = Str::camel($Table->getName());
        $this->variables['$APIRULES$'] = implode(',', $rules);

        $nameApi = "Create" . Str::camel($Table->getName()) . "APIRequest.php";
        $templateData = $this->getTemplate($this->config->pathTemplateAPICreate);

        $this->createFileWithTemplate($this->config->dirFinalRequest, $nameApi, $this->variables, $templateData);
    }

    private function generateUpdateAPIRequest($Table)
    {
        $rules = [];
        $this->variables['$MODEL_NAME$'] = Str::camel($Table->getName());
        foreach ($Table->getColumns() as $field) {
            $rules[] = $this->lnTb($this->generateRule($field));
        }
        $this->variables['$APIRULES$'] = implode(',', $rules);
        $nameApi = "Update" . Str::camel($Table->getName()) . "APIRequest.php";
        $templateData = $this->getTemplate($this->config->pathTemplateAPIUpdate);

        $this->createFileWithTemplate($this->config->dirFinalRequest, $nameApi, $this->variables, $templateData);
    }
    public function generateRule($field)
    {
  
        $item=[];
        $rule = "'" . $field->getName() . "' => '";
        if ($field->getNotnull()==true) {
            $item[] = "required";
        }

        if ($field->getType() == Type::getType('string')) {
            $item[] = "max:".$field->getLength();
        }
        $rule.= implode('|', $item)."'";
        return $rule;
    }
}
