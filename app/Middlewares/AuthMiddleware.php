<?php

namespace App\Middlewares;

class AuthMiddleware{
    public function before(){
        $headers = apache_request_headers();
        $token = $headers['Authorization'] ?? $_SERVER['HTTP_AUTHORIZATION'] ?? '';

        if(empty($token)){
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(401);
            echo json_encode([
                    'code' => 401,
                    'success' => false,
                    'message' => 'Token is required'
                ]
            );

            return false;
        }

        return true;
    }
}