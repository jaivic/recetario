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
    'deployment_id' => 'required|max:191',
    'application_name' => 'max:191',
    'deployment_group_name' => 'max:191',
    'deployment_config_name' => 'max:191',
    'creator' => 'max:191',
    'start_time' => '',
    'complete_time' => '',
    'deployment_overview' => 'required|max:0',
    'description' => '',
    'error_information_code' => 'max:191',
    'error_information_message' => 'max:191',
    'ignore_application_stop_failures' => '',
    'revision_github_location_commitId' => 'max:191',
    'revision_github_location_repository' => 'max:191',
    'revision_type' => 'max:191',
    's3_location_bucket' => 'max:191',
    's3_location_bundle_type' => 'max:191',
    's3_location_etag' => 'max:191',
    's3_location_key' => 'max:191',
    's3_location_version' => 'max:191',
    'status' => '',
    'created_at' => '',
    'updated_at' => ''];
    }
}
