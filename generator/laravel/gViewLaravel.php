<?php
namespace generator\laravel;

use DB;

use Illuminate\Support\Str;

use generator\Utils\FileUtil;
use \Doctrine\DBAL\Types\Type;


use generator\base\BaseGenerator;

class gViewLaravel extends BaseGenerator
{

    public function __construct($config)
    {
        parent::__construct();

        $this->config = $config;
    // $this->rollbackDir( $this->config->dirFinalService);


        $this->variables = [
            '$NAMESPACE$' => $this->config->nameSpaceFinalService
        ];
    }
    public function run()
    {
        foreach ($this->config->listTable as $table) {
            if ($table->enable == true) {
                $this->generateViewIndexFields($table);
                $this->generateViewShowFields($table);
                $this->generateViewEditFields($table);
                $this->generateViewCreate($table);
                $this->generateViewCreateFields($table);
                $this->generateViewEdit($table);
            }
        }
    }
    function generateViewCreate($table)
    {


        $this->variables = [
            '$ROUTE_NAMED_PREFIX$' => $this->config->addDir . ".",
            '$MODEL_NAME_PLURAL_CAMEL$' => Str::lower($table->name),
            '$VIEW_PREFIX$' => $table->name,
            '$VIEW_FOLDER$' => $this->config->addDir,
            '$ROUTE_PREFIX$' => Str::lower($table->name)
        ];
        $path = $this->config->dirFinalBaseView . $table->name . "/";
        $name = "create.blade.php";

        $templateData = $this->getTemplate($this->config->pathTemplateViewCreate);
        $this->createFileWithTemplate($path, $name, $this->variables, $templateData);
    }
    function generateViewCreateFields($table)
    {

        $fieldsTotal = "";

        foreach ($table->field as $field) {
            $templateField = $this->getTemplate("generator/template/view/fields/text.stub");
            $variables = [
                '$FIELD_NAME_TITLE$' => $field->name,
                '$FIELD_NAME$' => $field->name,

            ];
            $templateField = $this->fillTemplate($variables, $templateField);
            $fieldsTotal .= $templateField;
        }
        $templateData = $this->getTemplate("generator/template/view/fields.stub");
        $variables = [
            '$FIELDS$' => $fieldsTotal,
            '$ROUTE_NAMED_PREFIX$' => $this->config->addDir . ".",
            '$MODEL_NAME_PLURAL_CAMEL$' => Str::lower($table->name),
        ];

        $templateData = $this->fillTemplate($variables, $templateData);
        $path = $this->config->dirFinalBaseView . $table->name . "/";
        $name = "fields.blade.php";
        FileUtil::createFile($path, $name, $templateData);
    }
    function generateViewEdit($table)
    {
        $PrimaryName = "id";

        if ($table->index) {
            $PrimaryName = $table->index[0];
        }
        $this->variables = [

            '$MODEL_NAME_CAMEL$' => $table->name,
            '$ROUTE$' => $this->config->addDir . "." . Str::lower($table->name),
            '$VIEW_PREFIX$' => $table->name,
            '$VIEW_FOLDER$' => $this->config->addDir,
            '$PRIMARY_KEY_NAME$' => $PrimaryName
        ];


        $path = $this->config->dirFinalBaseView . $table->name . "/";
        $name = "edit.blade.php";

        $templateData = $this->getTemplate($this->config->pathTemplateViewUpdate);
        $this->createFileWithTemplate($path, $name, $this->variables, $templateData);
    }


    function generateViewEditFields($table)
    {


        $fieldsTotal = "";

        foreach ($table->field as $field) {
            $templateField = $this->getTemplate("generator/template/view/fields/text.stub");
            $variables = [
                '$FIELD_NAME_TITLE$' => $field->name,
                '$FIELD_NAME$' => $field->name,

            ];
            $templateField = $this->fillTemplate($variables, $templateField);
            $fieldsTotal .= $templateField;
        }
        $templateData = $this->getTemplate("generator/template/view/fields.stub");
        $variables = [
            '$FIELDS$' => $fieldsTotal,
            '$ROUTE_NAMED_PREFIX$' => $this->config->addDir . ".",
            '$MODEL_NAME_PLURAL_CAMEL$' => Str::lower($table->name),
        ];
        $templateData = $this->fillTemplate($variables, $templateData);
        $path = $this->config->dirFinalBaseView . $table->name . "/";
        $name = "editfields.blade.php";
        FileUtil::createFile($path, $name, $templateData);
    }

    public function generateViewIndexFields($table)
    {
        $fieldsTotalCell = "";
        $fieldsTotalHead = "";
        $variables = [];
        foreach ($table->field as $field) {
            $templateField = $this->getTemplate("generator/template/view/indexCell.stub");
            $templateHeader = $this->getTemplate("generator/template/view/indexHead.stub");
            $variables['$FIELD_NAME$'] = $field->name;
            $variables['$FIELD_NAME_TITLE$'] = Str::snake($field->name, " ");
            $fieldsTotalCell .= $this->fillTemplate($variables, $templateField);
            $fieldsTotalHead .= $this->fillTemplate($variables, $templateHeader);
        }

        $PrimaryName = "id";

        if ($table->index) {
            $PrimaryName = $table->index[0];
        }

        $variables = [
            '$FIELD_HEAD$' => $fieldsTotalHead,
            '$FIELD_BODY$' => $fieldsTotalCell,
            '$ROUTE$' => $this->config->addDir . "." . Str::lower($table->name),
            '$MODEL_NAME_CAMEL$' => $table->name,
            '$PRIMARY_KEY_NAME$' => $PrimaryName
        ];

        $path = $this->config->dirFinalBaseView . $table->name . "/";
        $name = "index.blade.php";


        $templateData = $this->getTemplate("generator/template/view/index.stub");

        $this->createFileWithTemplate($path, $name, $variables, $templateData);
    }


    function generateViewShowFields($table)
    {
        $fieldsTotalCell = "";
        $fieldsTotalHead = "";
        $this->variables = [
            '$MODEL_NAME_CAMEL$' => $table->name,
        ];
        foreach ($table->field as $field) {
            $templateField = $this->getTemplate("generator/template/view/showCell.stub");
            $this->variables['$FIELD_NAME$'] = $field->name;
            $this->variables['$FIELD_NAME_TITLE$'] = Str::snake($field->name, " ");
            $fieldsTotalCell .= $this->fillTemplate($this->variables, $templateField);
        }

        $variables = [
            '$FIELD$' => $fieldsTotalCell,
        ];
        $path = $this->config->dirFinalBaseView . $table->name . "/";
        $name = "show.blade.php";
        $templateData = $this->getTemplate("generator/template/view/show.stub");
        $this->createFileWithTemplate($path, $name, $variables, $templateData);
    }
}
