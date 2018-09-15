<?php
namespace App\Http\Requests;


use App\Sg\SgRequest;

class UpdatemigrationsAPIRequest extends SgRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
           return [
    'migration' => 'required|max:255',
    'batch' => 'required'];
    }
}
