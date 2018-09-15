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
    'number' => 'required',
    'bucket' => 'max:191',
    'key' => 'max:191',
    'bundle_type' => 'max:191',
    'commit_id' => 'max:191',
    'status' => 'max:191',
    'created_at' => '',
    'updated_at' => ''];
    }
}
