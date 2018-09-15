<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdaterolesRequest extends FormRequest
{

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
