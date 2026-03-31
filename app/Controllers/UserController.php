<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    private function checkUser($user){
        if(!$user){
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(404);
            echo json_encode([
                'code' => 404,
                'success' => false,
                'message' => 'User record not found'
            ]);
            exit();
        }
    }

    private function checkRoleInput($request){
        $userData = [
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'username' => $request['username'],
                'password' => password_hash($request['password'], PASSWORD_BCRYPT),
                'whatsapp_number' => $request['whatsapp_number'],
                'role' => $request['role']
        ];

        if(isset($request['nisn']) && !isset($request['nip'])){
            $userData['nisn'] = $request['nisn'];
            return $userData;
        }else if(isset($request['nip']) && !isset($request['nisn'])){
            $userData['nip'] = $request['nip'];
            return $userData;
        }
    }

    public function index(){
        $users = User::all();

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'data' => $users
        ]);
        exit();
    }
    
    public function show($id){
        $user = User::find($id);

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'data' => $user
        ]);
        exit();
    }

    public function store(){
        $json_string = file_get_contents('php://input');
        $request = json_decode($json_string, true);

        $userData = $this->checkRoleInput($request);

        User::create($userData);

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(201);
        echo json_encode([
            'code' => 201,
            'success' => true,
            'message' => 'User added successfully'
        ]);
        exit();
    }
    
    public function update(int $id){
        $json_string = file_get_contents('php://input');
        $request = json_decode($json_string, true);

        $user = User::find($id);
        $this->checkUser($user);
    
        if($user->role == 'student' && isset($request['nip'])){
            unset($request['nip']);

            header('Content-Type: application/json; charset=utf-8');
            http_response_code(403);
            echo json_encode([
                'code' => 403,
                'success' => false,
                'message' => 'Cannot update because role is collision'
            ]);
            exit();
        }else if($user->role == 'staff' && isset($request['nisn'])){
            unset($request['nisn']);
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(403);
            echo json_encode([
                'code' => 403,
                'success' => false,
                'message' => 'Cannot update because role is collision'
            ]);
            exit();
        }

        $user->update($request);

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'message' => 'User Updated successfully'
        ]);
    }

    public function destroy(int $id){
        $user = User::find($id);
        
        $this->checkUser($user);

        $user->delete();

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'message' => 'User record deleted successfully'
        ]);
    }
}