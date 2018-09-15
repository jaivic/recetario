<?php
namespace generator\base;
use DB;

use Illuminate\Support\Str;

use generator\base\BaseGenerator;
use generator\Utils\FileUtil;
use \Doctrine\DBAL\Types\Type;
//cutrabranpul
class gViewMenu extends BaseGenerator
{
  public $config;
  public $routeContents = "";
  public function __construct($config){
    parent::__construct();

    $this->config= $config;

    $this->path = base_path("resources/views/layouts/");
    
  }

    public function run()
    {
      foreach($this->config->listTable as $Table){
        $templateData = file_get_contents(base_path("generator/template/view/menu/menu.stub"));
      $this->variables = [
        '$URLNAME$' => Str::snake(Str::camel($Table->getName()), " "),
        '$URL$' => Str::lower(Str::camel($Table->getName())) . "/index",
      ];
      // dd($this->variables);
      $templateData = $this->fillTemplate($this->variables, $templateData);
        $this->routeContents .= $templateData;
      }
      $this->rollbackFile($this->path,"menu.blade.php");
      FileUtil::createFile($this->path,"menu.blade.php", "<ul>".$this->routeContents. "</ul>" );



    }  
}