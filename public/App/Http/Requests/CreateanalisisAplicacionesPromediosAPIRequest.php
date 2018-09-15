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
    'total_aplicaciones' => 'required',
    'sqale_index' => 'required',
    'page_load_time' => 'required',
    'page_bytes' => 'required',
    'sqale_debt_ratio' => 'required',
    'performance' => 'required',
    'performance_qualification' => 'max:1',
    'pagespeed_score' => 'required',
    'yslow_score' => 'required',
    'fecha' => '',
    'created_at' => '',
    'updated_at' => ''];
    }
}
