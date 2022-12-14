<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    protected function success($data=[], $message='success', $code=200)
    {
        return $this->result('success', $data, $message, $code);
    }

    protected function error($data=[], $message='error', $code=400)
    {
        return $this->result('error', $data, $message, $code);
    }

    /**
     * @param $status
     * @param array $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function result($status, $data=[], $message='', $code=200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}
