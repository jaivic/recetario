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
    'ip' => 'required|max:256',
    'url' => 'required|max:256',
    'qualitytest_id' => 'required',
    'created_at' => '',
    'updated_at' => ''];
    }
}
