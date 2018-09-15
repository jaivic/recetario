<?php
namespace generator\laravel;

use DB;

use Illuminate\Support\Str;

use generator\Utils\FileUtil;
use \Doctrine\DBAL\Types\Type;


use generator\base\BaseGenerator;

class gViewMenuLaravel extends BaseGenerator
{
    public $routeContents = "";
    public function __construct($config)
    {
        parent::__construct();

        $this->config = $config;
        $this->path = base_path("resources/views/layouts/");
    }
    public function run()
    {
        foreach ($this->config->listTable as $table) {
            if ($table->enable == true) {
                $templateData = file_get_contents(base_path("generator/template/view/menu/menu.stub"));
                $this->variables = [
                    '$URLNAME$' => Str::snake($table->name, " "),
                    '$URL$' => Str::lower($table->name) . "/index",
                ];
                // dd($this->variables);
                $templateData = $this->fillTemplate($this->variables, $templateData);
                $this->routeContents .= $templateData;
            }
        }
       // $this->rollbackFile($this->path, "menu.blade.php");
        FileUtil::createFile($this->path, "menu.blade.php", "<ul>" . $this->routeContents . "</ul>");
    }
}
