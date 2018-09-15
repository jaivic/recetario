<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateroleUserRequest extends  FormRequest
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
    'user_id' => 'required',
    'role_id' => 'required'];
    }
}
