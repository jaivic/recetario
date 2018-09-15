<?php

namespace App\Sg;

use Illuminate\Foundation\Http\FormRequest;
use App\Sg\SgResponse;
use Response;

class SgRequest extends FormRequest
{
   
    public function response(array $errors)
    {
       
        $messages = implode(' ', array_flatten($errors));

        return Response::json(SgResponse::error($messages), 400);
    }
}
