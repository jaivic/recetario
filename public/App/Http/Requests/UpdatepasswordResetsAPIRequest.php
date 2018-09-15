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
    'email' => 'required|max:191',
    'token' => 'required|max:191',
    'created_at' => ''];
    }
}
