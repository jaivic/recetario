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
    'backups_aplicacion_id' => 'required',
    'name' => 'required|max:191',
    'description' => 'max:191',
    'created_at' => '',
    'updated_at' => ''];
    }
}
