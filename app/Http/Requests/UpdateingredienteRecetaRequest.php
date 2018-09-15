<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateingredienteRecetaRequest extends FormRequest
{

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
