<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateingredienteRecetaRequest extends  FormRequest
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
    'ingrediente_id' => 'required',
    'receta_id' => 'required',
    'cantidad' => 'required',
    'unidad' => 'required|max:45'];
    }
}
