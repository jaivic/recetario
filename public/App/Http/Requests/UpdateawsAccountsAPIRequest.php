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
    'access_key' => 'required|max:191',
    'secret_key' => 'required|max:191',
    'region' => 'required|max:191',
    'created_at' => '',
    'updated_at' => ''];
    }
}
