<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreaterolesRequest extends  FormRequest
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
    'name' => 'required|max:255',
    'display_name' => 'max:255',
    'description' => 'max:255'];
    }
}
