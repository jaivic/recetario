<?php

namespace App\Http\Requests;


use App\Sg\SgRequest;

class CreatecategoriasAPIRequest extends SgRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
    'name' => 'required|max:191'];
    }
}
