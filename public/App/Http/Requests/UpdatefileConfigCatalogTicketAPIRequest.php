<?php
namespace App\Http\Requests;

use App\Http\APIRequest;

class Update$MODEL_NAME$APIRequest extends APIRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
           return [
    'id' => 'required',
    'file_config_catalog_id' => 'required',
    'ticket_id' => 'required'];
    }
}
