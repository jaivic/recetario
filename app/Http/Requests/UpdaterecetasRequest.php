<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdaterecetasRequest extends FormRequest
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
