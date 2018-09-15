<?php

namespace App\Http\Requests;


use App\Sg\SgRequest;

class CreateroleUserAPIRequest extends SgRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
    'user_id' => 'required',
    'role_id' => 'required'];
    }
}
