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
    'display_name' => 'max:191',
    'description' => 'max:191',
    'created_at' => '',
    'updated_at' => ''];
    }
}
