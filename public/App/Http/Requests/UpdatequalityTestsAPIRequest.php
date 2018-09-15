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
    'name' => 'required|max:256',
    'file' => 'required|max:256',
    'application_id' => 'required',
    'environment_id' => 'required',
    'user_id' => 'required',
    'description' => 'required|max:191',
    'created_at' => '',
    'updated_at' => ''];
    }
}
