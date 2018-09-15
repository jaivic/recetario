<?php
namespace generator\laravel;

use DB;

use Illuminate\Support\Str;

use generator\base\BaseGenerator;
use generator\Utils\FileUtil;
use \Doctrine\DBAL\Types\Type;

class gRouteLaravel extends BaseGenerator
{

    public function __construct($config)
    {
        parent::__construct();

        $this->config = $config;
    }
    public function run()
    {
        $this->path = $this->config->route;

        $this->routeContents = file_get_contents($this->path);
      //  dd($this->routeContents);

        //dd( $this->routeContents);
      //  preg_match_all("/\/\*<SG-autoRoute>\*\/\r\n(.*)\r\n\/\*<SG-autoRoute>\*\//s",$this->routeContents,$aver);
        $this->routeContents = preg_replace("/\/\*<SG-autoRoute>\*\/\r\n(.*)\r\n\/\*<SG-autoRoute>\*\//s", "", $this->routeContents);
            /*<SG-autoRoute>*/
        ///etiquetas que se usaran para remplazar todo
        /*<SG-autoRoute>*/

        $this->routeContents .= "/*<SG-autoRoute>*/\r\n";
        foreach ($this->config->listTable as $table) {
            if ($table->enable == true) {
                $name = $table->name;
                $templateData = $this->getTemplate($this->config->routeTemplate);
                $variables = [
                    '$ROUTE_PREFIX$' => Str::lower($name),
                    '$PATH_PREFIX$' => $this->config->addDir,
                    '$MODEL_NAME$' => $name,
                ];
                foreach ($variables as $variable => $value) {
                    $templateData = str_replace($variable, $value, $templateData);
                }
                $this->routeContents .= "\n" . $templateData;
            }


        }
        $this->routeContents .= "\r\n/*<SG-autoRoute>*/";
        //dd($this->routeContents);
        file_put_contents($this->path, $this->routeContents);
    }
}
