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
    'application_id' => 'required',
    'environment_id' => 'required',
    'storage' => 'required|max:5',
    'filename' => 'required|max:250',
    'created_at' => '',
    'updated_at' => '',
    'deleted_at' => ''];
    }
}
