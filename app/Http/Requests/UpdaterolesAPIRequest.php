<?php
namespace App\Http\Requests;


use App\Sg\SgRequest;

class UpdaterolesAPIRequest extends SgRequest
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
