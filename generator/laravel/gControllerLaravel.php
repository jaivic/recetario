<?php
namespace generator\laravel;

use DB;

use Illuminate\Support\Str;

use generator\base\BaseGenerator;
use generator\Utils\FileUtil;
use \Doctrine\DBAL\Types\Type;

class gControllerLaravel extends BaseGenerator
{

    public function __construct($config)
    {
        parent::__construct();

        $this->config = $config;
       // $this->rollbackDir( $this->config->dirFinalApiController);

        $this->variables = [
            '$NAMESPACE_CONTROLLER_API$' => $this->config->nameSpaceFinalApiController,
            '$NAMESPACE_CONTROLLER$' => $this->config->nameSpaceFinalController,
            '$NAMESPACE_SERVICE$' => $this->config->nameSpaceFinalService,
            '$NAMESPACE_REQUEST$' => $this->config->nameSpaceFinalRequest,
            '$ADD_FOLDER$' => $this->config->addDir,
            '$USECREATEREQUEST$' => "",
            '$USEUPDATEREQUEST$' => "",

        ];
    }
    public function run()
    {
        $this->generateApi();
        $this->generateController();
    }
    public function validate($Table)
    {
        $name = $Table->name;
        if ($Table->request == true) {
            $this->variables['$CREATEREQUEST$'] = "Create" . $name . "APIRequest";
            $this->variables['$UPDATEREQUEST$'] = "Update" . $name . "APIRequest";
            $this->variables['$USECREATEREQUEST$'] =
                "use " . $this->variables['$NAMESPACE_REQUEST$'] . "\\" . $this->variables['$CREATEREQUEST$'] . ";";
            $this->variables['$USEUPDATEREQUEST$'] =
                "use " . $this->variables['$NAMESPACE_REQUEST$'] . "\\" . $this->variables['$UPDATEREQUEST$'] . ";";
        } else {
            $this->variables['$CREATEREQUEST$'] = "Request";
            $this->variables['$UPDATEREQUEST$'] = "Request";
            $this->variables['$USECREATEREQUEST$'] = "";
            $this->variables['$USEUPDATEREQUEST$'] = "";
        }
    }
    public function generateApi()
    {
        foreach ($this->config->listTable as $Table) {
            if ($Table->enable == true) {
                $name = $Table->name;
                $this->variables['$NAMESPACE_MODEL$'] = $this->config->nameSpaceFinalModel . "\\" . $name;
                $this->variables['$MODAL_NAME$'] = $name;
                $this->variables['$SERVICE_NAME$'] = $name;
                $this->validate($Table);
                $this->variables['$ROUTE$'] = Str::lower($name);
                $this->variables['//*$ADDMODELS$*/'] = "";
                $this->variables['//*$ADDMODELSARRAY$*/'] = "";

                $this->generateShowfunction($Table);
                $this->generateAllfunction($Table);
                $name .= "Controller.php";
                // dd($this->variables);
                $templateData = $this->getTemplate($this->config->pathTemplateApiController);
                $this->createFileWithTemplate($this->config->dirFinalApiController, $name, $this->variables, $templateData);
            }
        }
    }
    public function generateShowfunction($Table)
    {
        foreach ($Table->fieldShowList as $key => $model) {
            if ($key != "this") {
                $templateData = $this->getTemplate($this->config->pathTemplateControllerPartResult);
                $this->variables['$MODEL$'] = $key;
                $this->variables['$MODELFUNCTION$'] = Str::plural($key);
                $this->variables['//*$ADDMODELS$*/'] .= $this->fillTemplate($this->variables, $templateData);
            }
        }
    }
    public function generateAllfunction($Table)
    {
        foreach ($Table->fieldShowList as $key => $model) {
            if ($key != "this") {
                $templateData = $this->getTemplate($this->config->pathTemplateControllerPartResultArray);
                $this->variables['$MODEL$'] = $key;
                $this->variables['$MODELFUNCTION$'] = Str::plural($key);
                $this->variables['//*$ADDMODELSARRAY$*/'] .= $this->fillTemplate($this->variables, $templateData);
            }
        }
    }
    public function generateController()
    {
        foreach ($this->config->listTable as $Table) {
            $name = $Table->name;
            $this->variables['$NAMESPACE_MODEL$'] = $this->config->nameSpaceFinalModel . "\\" . $name;
            $this->variables['$MODAL_NAME$'] = $name;
            $this->variables['$SERVICE_NAME$'] = $name;
            $this->variables['$ROUTE$'] = Str::lower($name);
            $this->validate($Table);
            $name .= "Controller.php";
            $templateData = $this->getTemplate($this->config->pathTemplateController);
            $this->createFileWithTemplate($this->config->dirFinalController, $name, $this->variables, $templateData);
        }
    }
}
