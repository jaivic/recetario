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
    'name' => 'required|max:191',
    'email' => 'required|max:191',
    'password' => 'required|max:191',
    'github_account' => 'max:191',
    'timezone' => 'required|max:191',
    'remember_token' => 'max:100',
    'created_at' => '',
    'updated_at' => '',
    'slack_user_id' => 'max:250'];
    }
}
