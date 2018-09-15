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
    'deployment_instance_summary_id' => 'required',
    'diagnostics_error_code' => 'max:191',
    'diagnostics_log_tail' => 'max:191',
    'diagnostics_message' => 'max:191',
    'diagnostics_script_name' => 'max:191',
    'lifecycle_event_name' => 'max:191',
    'start_time' => '',
    'end_time' => '',
    'status' => '',
    'created_at' => '',
    'updated_at' => ''];
    }
}
