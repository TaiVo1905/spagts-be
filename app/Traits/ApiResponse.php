<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function successResponse($data = null, $links = null, $meta = null, string $message = 'Success', int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
            'links' => $links,
            'meta' => $meta
        ], $code);
    }

    protected function errorResponse(string $message = 'Error', int $code = 400): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ], $code);
    }
}
