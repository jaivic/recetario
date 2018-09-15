<?php

namespace App\Http\Requests;


use App\Sg\SgRequest;

class CreatemigrationsAPIRequest extends SgRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
    'migration' => 'required|max:255',
    'batch' => 'required'];
    }
}
