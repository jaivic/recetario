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
    'ticket_id' => 'required',
    'production_server_id' => 'required',
    'production_database' => 'required|max:191',
    'environment_id' => 'required',
    'server_id' => 'required',
    'database' => 'required|max:191',
    'created_at' => '',
    'updated_at' => '',
    'status' => 'max:1',
    'log' => ''];
    }
}
