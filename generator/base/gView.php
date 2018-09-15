<?php
namespace generator\base;
use DB;

use Illuminate\Support\Str;

use generator\base\BaseGenerator;
use generator\Utils\FileUtil;
use \Doctrine\DBAL\Types\Type;

class gView extends BaseGenerator
{
  public $config;

public function __construct($config){
  parent::__construct();

  $this->config= $config;
  //$this->rollbackDir( $this->config->dirFinalBaseView);
  
}

    public function run()
  {
    $this->generateViewIndexFields();
    $this->generateViewCreate();
    $this->generateViewCreateFields();
    $this->generateViewEdit();
    $this->generateViewEditFields();
    $this->generateViewShowFields();
  }
  function generateViewCreate()
  {
    /*create*/
    foreach ($this->config->listTable as $Table) {
     
      $this->variables = [
        '$ROUTE_NAMED_PREFIX$' => $this->config->addDir.".",
        '$MODEL_NAME_PLURAL_CAMEL$' => Str::lower(Str::camel($Table->getName())),
        '$VIEW_PREFIX$' => Str::camel($Table->getName()),
        '$VIEW_FOLDER$' => $this->config->addDir,
        '$ROUTE_PREFIX$' => Str::lower(Str::camel($Table->getName()))
      ];
      $path = $this->config->dirFinalBaseView . Str::camel($Table->getName()) . "/";
      $name = "create.blade.php";
    
      $templateData = $this->getTemplate($this->config->pathTemplateViewCreate);
      $this->createFileWithTemplate ($path, $name, $this->variables, $templateData);
    }
  }
  function generateViewCreateFields()
  {
    /* fields*/
    foreach ($this->config->listTable as $Table) {
      $fieldsTotal = "";

      foreach ($Table->getColumns() as $field) {
        $templateField = $this->getTemplate("generator/template/view/fields/text.stub");
        $variables = [
          '$FIELD_NAME_TITLE$' => Str::camel($field->getName()),
          '$FIELD_NAME$' =>$field->getName(),

        ];   
        $templateField=  $this->fillTemplate($variables, $templateField);
        $fieldsTotal .= $templateField;
      }
      $templateData = $this->getTemplate("generator/template/view/fields.stub");
      $variables = [
        '$FIELDS$' => $fieldsTotal,
        '$ROUTE_NAMED_PREFIX$' => $this->config->addDir.".",
        '$MODEL_NAME_PLURAL_CAMEL$' => Str::lower(Str::camel($Table->getName())),
      ];
     
      $templateData = $this->fillTemplate($variables, $templateData);
      $path = $this->config->dirFinalBaseView . Str::camel($Table->getName()) . "/";
      $name = "fields.blade.php";
      FileUtil::createFile($path, $name, $templateData);

    }
  }
  function generateViewEdit()
  {
    /*create*/
    foreach ($this->config->listTable as $Table) {
    
      $PrimaryName ="id";
      $indice=$Table->getPrimaryKey();
      if ($indice){
        $PrimaryName= $indice->getColumns()[0];
      }
      $this->variables = [
       
        '$MODEL_NAME_CAMEL$'=> Str::camel($Table->getName()),
        '$ROUTE$' => $this->config->addDir.".".Str::lower(Str::camel($Table->getName())),
        '$VIEW_PREFIX$' => Str::camel($Table->getName()),
        '$VIEW_FOLDER$' => $this->config->addDir,
        '$PRIMARY_KEY_NAME$'=> $PrimaryName
      ];
     
    
      $path = $this->config->dirFinalBaseView . Str::camel($Table->getName()) . "/";
      $name = "edit.blade.php";

      $templateData = $this->getTemplate($this->config->pathTemplateViewUpdate);
      $this->createFileWithTemplate($path, $name, $this->variables, $templateData);
    }
  }
  function generateViewEditFields()
  {
    /* fields*/
    foreach ($this->config->listTable as $Table) {
      $fieldsTotal = "";

      foreach ($Table->getColumns() as $field) {
        $templateField = $this->getTemplate("generator/template/view/fields/text.stub");
        $variables = [
          '$FIELD_NAME_TITLE$' => Str::camel($field->getName()),
          '$FIELD_NAME$' =>$field->getName(),

        ];
        $templateField = $this->fillTemplate($variables, $templateField);
        $fieldsTotal .= $templateField;
      }
      $templateData = $this->getTemplate("generator/template/view/fields.stub");
      $variables = [
        '$FIELDS$' => $fieldsTotal,
        '$ROUTE_NAMED_PREFIX$' => $this->config->addDir.".",
        '$MODEL_NAME_PLURAL_CAMEL$' => Str::lower(Str::camel($Table->getName())),
      ];
      $templateData = $this->fillTemplate($variables, $templateData);
      $path = $this->config->dirFinalBaseView . Str::camel($Table->getName()) . "/";
      $name = "editfields.blade.php";
      FileUtil::createFile($path, $name, $templateData);


    }
  }
  function generateViewIndexFields()
  {
    //Str::snake
    /* fields*/
    foreach ($this->config->listTable as $Table) {
      $fieldsTotalCell = "";
      $fieldsTotalHead = "";
      $this->variables = [
        '$MODEL_NAME_CAMEL$' => Str::camel($Table->getName()),
      ];
      foreach ($Table->getColumns() as $field) {
        $templateField = $this->getTemplate("generator/template/view/indexCell.stub");
        $templateHeader = $this->getTemplate("generator/template/view/indexHead.stub");
        $this->variables['$FIELD_NAME$']= $field->getName();
        $this->variables['$FIELD_NAME_TITLE$'] = Str::snake(Str::camel($field->getName())," ");
        $fieldsTotalCell .= $this->fillTemplate($this->variables, $templateField);
        $fieldsTotalHead .= $this->fillTemplate($this->variables, $templateHeader);        
      }
      $templateData = $this->getTemplate("generator/template/view/index.stub");
      $PrimaryName = "id";
      $indice = $Table->getPrimaryKey();
      if ($indice) {
        $PrimaryName = $indice->getColumns()[0];
      }
      $variables = [
        '$FIELD_HEAD$' => $fieldsTotalHead,
        '$FIELD_BODY$' => $fieldsTotalCell,
        '$ROUTE$' => $this->config->addDir.".".Str::lower(Str::camel($Table->getName())),
        '$MODEL_NAME_CAMEL$' => Str::camel($Table->getName()),
        '$PRIMARY_KEY_NAME$' => $PrimaryName
      ];
      $templateData = $this->fillTemplate($variables, $templateData);
      $path = $this->config->dirFinalBaseView . Str::camel($Table->getName()) . "/";
      $name = "index.blade.php";
     
      FileUtil::createFile($path, $name, $templateData);


    }
  }
  function generateViewShowFields()
  {
    //Str::snake
    /* fields*/
    foreach ($this->config->listTable as $Table) {
      $fieldsTotalCell = "";
      $fieldsTotalHead = "";
      $this->variables = [
        '$MODEL_NAME_CAMEL$' => Str::camel($Table->getName()),
      ];
      foreach ($Table->getColumns() as $field) {
        $templateField = $this->getTemplate("generator/template/view/showCell.stub");
     
        $this->variables['$FIELD_NAME$'] = $field->getName();
        $this->variables['$FIELD_NAME_TITLE$'] = Str::snake(Str::camel($field->getName()), " ");
        $fieldsTotalCell .= $this->fillTemplate($this->variables, $templateField);
     
      }
      $templateData = $this->getTemplate("generator/template/view/show.stub");
      
      $variables = [
        '$FIELD$' => $fieldsTotalCell,
      ];
      $templateData = $this->fillTemplate($variables, $templateData);
      $path = $this->config->dirFinalBaseView . Str::camel($Table->getName()) . "/";
      $name = "show.blade.php";

      FileUtil::createFile($path, $name, $templateData);


    }
  }
}