<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateingredientesRequest extends  FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
