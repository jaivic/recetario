<?php

namespace App\Http\Requests;


use App\Sg\SgRequest;

class CreaterecetasAPIRequest extends SgRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
    'name' => 'required|max:191',
    'procedimiento_id' => '',
    'categoria_id' => ''];
    }
}
