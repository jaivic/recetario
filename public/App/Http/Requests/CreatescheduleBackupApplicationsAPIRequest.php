<?php

namespace App\Http\Requests;

use App\Http\APIRequest;


class Create$MODEL_NAME$APIRequest extends APIRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
    'id' => 'required',
    'instance_name' => 'max:191',
    'lunes' => '',
    'martes' => '',
    'miercoles' => '',
    'jueves' => '',
    'viernes' => '',
    'sabado' => '',
    'domingo' => '',
    'hora_programada' => 'required',
    'description' => 'required|max:191',
    'status' => 'required',
    'is_linea_base' => 'required',
    'instance_type' => 'max:191',
    'is_ansible' => '',
    'aplicacion_id' => '',
    'environment_id' => '',
    'instancia_id' => '',
    'domain' => 'max:191',
    'forward_time' => 'required',
    'created_at' => '',
    'updated_at' => ''];
    }
}
