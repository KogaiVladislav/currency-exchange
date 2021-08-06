<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use DispatchesJobs, ValidatesRequests, AuthorizesRequests;

    /**
     * Format successful request response
     *
     * @param   [mixed]  $data  A string or array
     *
     * @return  [object]        JSON object
     */
    protected function success($data)
    {
        return response()->json(
            [
                'status' => "success",
                'data' => $data,
            ]
        );
    }

    /**
     * This handle formatted API error responses
     * @param $data
     * @param $code (optional) HTTP Error code
     *
     * @return  [object]        JSON object
     */
    protected function error($data, $code = null)
    {
        if (!$code || is_string($code)) {
            $code = 422;
        }

        return response()->json([
            'status' => "error",
            'message' => $data,

        ], $code);
    }

    /**
     * This handle formatted API fail responses
     * @param $data
     * @param $code (optional) HTTP Error code
     *
     * @return  [object]        JSON object
     */
    protected function fail($data, $code = null)
    {
        if (!$code || is_string($code)) {
            $code = 422;
        }

        return response()->json([
            'status' => "fail",
            'message' => $data,

        ], $code);
    }

}
