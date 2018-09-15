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
    'instance_name' => 'required|max:191',
    'instance_type' => 'max:191',
    'instance_id' => '',
    'lunes' => '',
    'martes' => '',
    'miercoles' => '',
    'jueves' => '',
    'viernes' => '',
    'sabado' => '',
    'domingo' => '',
    'hora_programada' => 'required',
    'status' => 'required',
    'description' => 'required',
    'mode' => 'required|max:1',
    'is_mirror' => 'required',
    'is_linea_base' => 'required',
    'is_ansible' => '',
    'domain' => 'max:191',
    'mirror_instance' => 'max:191',
    'mirror_instance_id' => '',
    'forward_time' => 'required',
    'created_at' => '',
    'updated_at' => ''];
    }
}
