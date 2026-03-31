<?php

namespace App\Controllers;

use App\Models\Author;

class AuthorController
{
    public function index(){
        $author = Author::all();

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'data' => $author
        ]);
        exit();
    }

    public function store(){
        $json_string = file_get_contents('php://input');
        $request = json_decode($json_string, true);

        Author::create([
            'name' => $request['author_name'],
        ]);

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(201);
        echo json_encode([
            'code' => 201,
            'success' => true,
            'message' => 'Author added successfully'
        ]);
        exit();
    }
    
    public function update(int $id){
        $json_string = file_get_contents('php://input');
        $request = json_decode($json_string, true);

        $author = Author::find($id);
        if(!$author){
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(404);
            echo json_encode([
                'code' => 404,
                'success' => false,
                'message' => 'Author record not found'
            ]);
            exit();
        }
    
        $author->update(["name" => $request["author_name"]]);

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'message' => 'Author Updated successfully'
        ]);
    }
}