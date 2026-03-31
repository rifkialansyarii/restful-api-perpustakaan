<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function authenticate()
    {
        $json_string = file_get_contents('php://input');
        $request = json_decode($json_string, true);

        $user = User::where('username', $request['username'])->first();
        
        if(!$user){
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(401);
            echo json_encode([
                'code' => 401,
                'success' => false,
                'message' => 'Wrong username or password'
            ]);
            exit();
        }else if($user && password_verify($request['password'], $user->password)){
            $token = bin2hex(random_bytes(32));

            $user->update(["api_token" => $token]);

            header('Content-Type: application/json; charset=utf-8');
            http_response_code(200);
            echo json_encode([
                'code' => 200,
                'success' => true,
                'message' => 'Login successfully',
                'api_token' => $token
            ]);
            exit();
        }
        

    }
}