<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    private function checkUser($user)
    {
        if (!$user) {
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

    public function index()
    {
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

    public function show($id)
    {
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

    public function store()
    {
        $json_string = file_get_contents('php://input');
        $request = json_decode($json_string, true);

        $userData = [
            'nisn' => $request['nisn'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'whatsapp_number' => $request['whatsapp_number'],
            'role' => $request['role']
        ];

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

    public function update(int $id)
    {
        $json_string = file_get_contents('php://input');
        $request = json_decode($json_string, true);

        $user = User::find($id);
        $this->checkUser($user);

        $user->update($request);

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'message' => 'User Updated successfully'
        ]);
    }

    public function destroy(int $id)
    {
        $user = User::find($id);

        $this->checkUser($user);

        $user->update([
            "whatsapp_number" => $user->whatsapp_number . "_deleted_" . time(),
            "nisn" => $user->nisn . "_deleted_" . time()
        ]);
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