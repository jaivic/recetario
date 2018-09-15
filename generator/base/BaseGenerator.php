<?php

namespace generator\base;

use generator\Utils\FileUtil;

use Illuminate\Support\Str;

class BaseGenerator
{
    public $variables;
    public $listTable;
    public $dirFinalModel;
    public $nameSpaceFinalModel;
    public $dirFinalRequest;
    public $nameSpaceFinalRequest;
    public $dirFinalService;
    public $nameSpaceFinalEervice;
    public $dirFinalController;
    public $nameSpaceFinalController;
    public $pathTemplateModel;
    public $pathTemplateService;

    public function __construct()
    {
        $this->pathTemplateModel = "generator/template/model/model.stub";
        $this->pathTemplateService = "generator/template/service/service.stub";
        $this->pathTemplateCreate = "generator/template/request/create_api_request.stub";
        $this->pathTemplateUpdate = "generator/template/request/update_api_request.stub";
        $this->pathTemplateController = "generator/template/controllers/apiController.stub";
    }
    public function getTemplate($dirTemplate)
    {
        $path = base_path($dirTemplate);
        return file_get_contents($path);
    }
    public function lnTb($text)
    {
        return PHP_EOL . str_repeat(' ', 4) . $text;
    }
    public function fillTemplate($variables, $templateData)
    {
        foreach ($variables as $variable => $value) {
            $templateData = str_replace($variable, $value, $templateData);
        }
        return $templateData;
    }
    public function createFileWithTemplate($path, $filenName, $variables, $templateData)
    {

        FileUtil::createFile($path, $filenName, $this->fillTemplate($variables, $templateData));
    }
    public function rollbackDir($path)
    {
        return FileUtil::deleteDir($path);
    }
    public function rollbackFile($path, $fileName)
    {
        return FileUtil::deleteFile($path, $fileName);
    }

}
