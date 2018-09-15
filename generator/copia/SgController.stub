<?php

namespace App\Sg;

use App\sg\SgResponse;
use Response;

use App\Http\Controllers\Controller;

class SgController extends Controller
{
    public function sendResponse($result, $message)
    {
        return Response::json(SgResponse::success($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(SgResponse::error($error), $code);
    }
}
