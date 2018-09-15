<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateusersRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }
    
   public function rules()
    {
        return [
    'name' => 'required|max:255',
    'email' => 'required|max:255',
    'password' => 'required|max:255',
    'remember_token' => 'max:100'];
    }
}
