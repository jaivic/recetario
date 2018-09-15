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
    'file_name' => 'required|max:250',
    'file_type' => 'required|max:10',
    'file_size' => 'required|max:30',
    'file_path' => 'required|max:250',
    'created_at' => '',
    'updated_at' => ''];
    }
}
