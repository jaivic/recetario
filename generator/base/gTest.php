<?php
namespace generator\base;
use DB;

use Illuminate\Support\Str;

use generator\base\BaseGenerator;
use generator\Utils\FileUtil;
use \Doctrine\DBAL\Types\Type;

class gController extends BaseGenerator
{

public function __construct($config){
    parent::__construct();

    $this->config = $config;
   // $this->rollbackDir( $this->config->dirFinalApiController);

  $this->variables=[
      '$NAMESPACE_CONTROLLER_API$' => $this->config->nameSpaceFinalApiController,
      '$NAMESPACE_CONTROLLER$' => $this->config->nameSpaceFinalController,
      '$NAMESPACE_SERVICE$' => $this->config->nameSpaceFinalService,
      '$NAMESPACE_REQUEST$' => $this->config->nameSpaceFinalRequest,
      '$ADD_FOLDER$'=> $this->config->addDir,
     
  ];
}
  public function run()
  {
    $this->generateApi();
    $this->generateController();
  }
  public function generateApi()
  {

    foreach ($this->config->listTable as $Table) {
      $name = Str::camel($Table->getName());
      $this->variables['$NAMESPACE_MODEL$'] = $this->config->nameSpaceFinalModel . "\\" . $name;
      $this->variables['$MODAL_NAME$'] = $name;
      $this->variables['$SERVICE_NAME$'] = $name;
      $this->variables['$ROUTE$'] = Str::lower($name);
      $name .= "Controller.php";
      $templateData = $this->getTemplate($this->config->pathTemplateApiController);
      $this->createFileWithTemplate($this->config->dirFinalApiController, $name, $this->variables, $templateData);
    }


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