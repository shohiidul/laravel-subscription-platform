<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public function success($data = [], $message = 'Success'): JsonResponse
    {
        return response()->json([
                'flag' => true,
                'message' => $message,
                'errors' => '',
                'data' => $data
            ], 
            200
        );
    }

    public function validationError($errors, $message = 'Validation failed'): JsonResponse
    {
        return response()->json([
                'flag' => false,
                'message' => $message,
                'errors' => $errors,
                'data' => [],
            ], 
            422
        );
    }

    public function error($message = 'Error'): JsonResponse
    {
        return response()->json([
                'flag' => false,
                'message' => $message,
                'errors' => $message,
                'data' => [],
            ],
            500
        );
    }
}
