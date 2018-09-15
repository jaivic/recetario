<?php

namespace App\Http\Requests;

use App\Http\APIRequest;


class Create$MODEL_NAME$APIRequest extends APIRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
    'id' => 'required',
    'schedule_id' => '',
    'instance_name' => 'required|max:191',
    'backup_type' => 'required|max:1',
    'status' => 'required|max:1',
    'start_time' => 'required',
    'completed_time' => '',
    'origin' => 'required|max:0',
    'log_error' => '',
    'execution_time' => '',
    'observations' => '',
    'is_mirror' => 'required',
    'mirror_instance' => 'required|max:60',
    'ticket_id' => '',
    'created_at' => '',
    'updated_at' => '',
    'relanzar' => 'required'];
    }
}
