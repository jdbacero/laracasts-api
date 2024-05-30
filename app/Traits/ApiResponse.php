<?php

namespace App\Traits;

trait ApiResponse {
    protected function ok($message, $data = []) {
        return $this->success(message: $message, data: $data, statusCode: 200);
    }
    
    protected function success($message, $statusCode = 200, $data) {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $statusCode,
        ], $statusCode);
    }
    
    protected function error($message, $statusCode) {
        return response()->json([
            'message' => $message,
            'status' => $statusCode,
        ], $statusCode);
    }
}