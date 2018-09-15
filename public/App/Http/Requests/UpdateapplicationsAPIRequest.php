<?php
namespace App\Http\Requests;

use App\Http\APIRequest;

class Update$MODEL_NAME$APIRequest extends APIRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
           return [
    'id' => 'required',
    'name' => 'required|max:191',
    'aws_account_id' => 'required',
    'repository' => 'required|max:191',
    'deployment_type' => 'required|max:191',
    'url' => 'max:191',
    'sonar_key' => 'max:191',
    'json_rules' => '',
    'created_at' => '',
    'updated_at' => ''];
    }
}
