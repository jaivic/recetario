<?php

namespace App\Http\Requests;


use App\Sg\SgRequest;

class CreatepermissionRoleAPIRequest extends SgRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
    'permission_id' => 'required',
    'role_id' => 'required'];
    }
}
