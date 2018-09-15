<?php

namespace App\Http\Requests;


use App\Sg\SgRequest;

class CreateprocedimientosAPIRequest extends SgRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
    'procedimiento' => '',
    'img' => 'max:250'];
    }
}
