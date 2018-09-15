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
    'aplicacion_id' => 'required',
    'aplicacion_nombre' => 'max:150',
    'aplicacion_url' => 'max:150',
    'page_bytes' => 'required',
    'page_bytes_text' => 'required',
    'page_load_time' => 'required',
    'page_load_time_text' => 'required',
    'pagespeed_score' => 'required',
    'pagespeed_score_text' => 'required',
    'yslow_score' => 'required',
    'yslow_score_text' => 'required',
    'sqale_index' => 'required',
    'sqale_index_text' => 'max:255',
    'sqale_index_trend' => 'max:2',
    'sqale_debt_ratio' => 'required',
    'sqale_debt_ratio_text' => 'required',
    'sqale_debt_ratio_trend' => 'max:2',
    'performance' => 'required',
    'performance_qualification' => 'max:1',
    'aplicacion_sonar_key' => 'max:150',
    'fecha' => '',
    'created_at' => '',
    'updated_at' => ''];
    }
}
