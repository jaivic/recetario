<?php
namespace generator;


use DB;

use Illuminate\Support\Str;

use generator\Utils\FileUtil;
use generator\BaseGenerator;
use \Doctrine\DBAL\Types\Type;

class GenerateJson extends BaseGenerator
{
    public $schemaManager;
    public $listTable;
    public $pathJson;
    public $fileName;
    public $templateJsonBD;
    public $templateJsonENTIDAD;
    public function __construct()
    {
        $this->schemaManager = DB::getDoctrineSchemaManager();
        $platform = $this->schemaManager->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('enum', 'string');
        $platform->registerDoctrineTypeMapping('json', 'text');
        $this->listTable = $this->schemaManager->listTables();
        $this->pathJson = base_path("App\json\\");
        
        $this->fileName= "templeate.json";
        $this->templateJsonBD = base_path("generator/template/json.stub");
        $this->templateJsonENTIDAD = base_path("generator/template/entidad.stub");
        $this->generateBD();
    }

    public function generateBD()
    { 
        $templateData = file_get_contents($this->templateJson);
        foreach ($this->listTable as $Table) {
            $bd = [];
            $bd[$Table->getName()] = true;
            $dbs[] = $this->lnTb(json_encode($bd));
        }

        $variables = [
            '$BDS$' => implode(',', $dbs),
        ];
        $this->createFileWithTemplate($this->pathJson, $this->fileName ,$variables, $templateData);
    }
    public function generateModel()
    {
        $templateData = file_get_contents($this->templateJsonENTIDAD);
        foreach ($this->listTable as $Table) {
            $bd = [];
            $bd[$Table->getName()] = true;
            $dbs[] = $this->lnTb() . json_encode($bd);
        }

        $variables = [
            '$BDS$' => implode(',', $dbs),
        ];
        $this->createFileWithTemplate($this->pathJson, $this->fileName, $variables, $templateData);
    }

}