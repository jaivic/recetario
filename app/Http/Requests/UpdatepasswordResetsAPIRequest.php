<?php
namespace App\Http\Requests;


use App\Sg\SgRequest;

class UpdatepasswordResetsAPIRequest extends SgRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
           return [
    'email' => 'required|max:255',
    'token' => 'required|max:255'];
    }
}
