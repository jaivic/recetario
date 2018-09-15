<?php
namespace generator\base;
use DB;

use Illuminate\Support\Str;

use generator\base\BaseGenerator;
use generator\Utils\FileUtil;
use \Doctrine\DBAL\Types\Type;

class gRoute extends BaseGenerator
{

public function __construct($config){
    parent::__construct();

    $this->config = $config;
  
}
  public function run()
  {
    $this->path = base_path("routes/web.php");

    $this->routeContents = file_get_contents($this->path);

    foreach ($this->config->listTable as $Table) {

      $templateData = file_get_contents(base_path("generator/template/routes/api_routes_group.stub"));
      $variables = [
        '$ROUTE_PREFIX$' => Str::lower(Str::camel($Table->getName())),
        '$PATH_PREFIX$' => $this->config->addDir,
        '$MODEL_NAME$' => Str::camel($Table->getName()),
      ];
      foreach ($variables as $variable => $value) {
        $templateData = str_replace($variable, $value, $templateData);
      }
      $this->routeContents .= "\n\n" . $templateData;
    }
    file_put_contents($this->path, $this->routeContents);
  }
 
  
  
}