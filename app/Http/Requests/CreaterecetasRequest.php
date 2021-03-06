<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreaterecetasRequest extends  FormRequest
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
    'procedimiento_id' => '',
    'categoria_id' => ''];
    }
}
