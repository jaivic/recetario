<?php
namespace App\Http\Requests;


use App\Sg\SgRequest;

class UpdateingredienteRecetaAPIRequest extends SgRequest
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
