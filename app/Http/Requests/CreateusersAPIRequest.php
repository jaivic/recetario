<?php

namespace App\Http\Requests;


use App\Sg\SgRequest;

class CreateusersAPIRequest extends SgRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
    'name' => 'required|max:255',
    'email' => 'required|max:255',
    'password' => 'required|max:255',
    'remember_token' => 'max:100'];
    }
}
