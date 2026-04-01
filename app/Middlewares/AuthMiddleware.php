<?php

namespace App\Middlewares;

use App\Models\User;

class AuthMiddleware{
    public function before(){
        $headers = apache_request_headers();
        $token = str_replace('Bearer ', '', $headers['Authorization'] ?? '');

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

        $user = User::where('api_token', $token)->first();

        if (!$user) {
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(401);
            echo json_encode([
                    'code' => 401,
                    'success' => false,
                    'message' => 'Token is not valid'
                ]
            );
            return false;
        }

        if($user->role !== "admin" && $user->role !== "staff"){
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(401);
            echo json_encode([
                    'code' => 403,
                    'success' => false,
                    'message' => 'Permission denied'
                ]
            );
            return false;
        }

        return true;
    }
}