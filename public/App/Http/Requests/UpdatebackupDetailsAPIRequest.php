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
    'backup_id' => 'required',
    'database_name' => 'required|max:191',
    'status' => 'required|max:1',
    'mode' => 'required|max:1',
    'files' => 'required',
    's3_path' => 'max:191',
    'start_time' => 'required',
    'completed_time' => '',
    'duration' => '',
    'log_error' => '',
    'zip_start_time' => '',
    'zip_completed_time' => '',
    's3_start_time' => '',
    's3_completed_time' => '',
    'size_in_gb' => '',
    'observations' => '',
    'created_at' => '',
    'updated_at' => '',
    'relaunch' => '',
    'relanzar' => 'required'];
    }
}
