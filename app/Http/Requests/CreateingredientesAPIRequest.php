<?php

namespace App\Http\Requests;


use App\Sg\SgRequest;

class CreateingredientesAPIRequest extends SgRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
    'name' => 'required|max:191',
    'tipo' => 'required|max:191',
    'descripcion' => 'max:191',
    'stock' => '',
    'precio' => '',
    'impuesto_id' => 'required'];
    }
}
