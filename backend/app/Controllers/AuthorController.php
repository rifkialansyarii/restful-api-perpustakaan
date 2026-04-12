<?php

namespace App\Controllers;

use App\Models\Author;

class AuthorController
{
    private function checkAuthor($author){
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
    }

    public function index(){
        $authors = Author::get();

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'data' => $authors->map(function($author){
                return [
                    "id" => $author->id,
                    "author_name" => $author->name
                ];
            })
        ]);
        exit();
    }

    public function show($id){

        if($_SERVER['REQUEST_METHOD'] == "OPTIONS"){
            http_response_code(200);
            exit();
        }

        $author = Author::find($id);

        if(!$author){
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(404);
            echo json_encode([
                'code' => 404,
                'success' => false,
                'message' => 'Author record is not found' 
            ]);
            exit();
        }

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'data' => [
                "author_name" => $author->name
            ]
        ]);
        exit();
    }

    public function store(){

        if($_SERVER['REQUEST_METHOD'] == "OPTIONS"){
            http_response_code(200);
            exit();
        }

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
        if($_SERVER['REQUEST_METHOD'] == "OPTIONS"){
            http_response_code(200);
            exit();
        }

        $json_string = file_get_contents('php://input');
        $request = json_decode($json_string, true);

        $author = Author::find($id);
        $this->checkAuthor($author);
    
        $author->update(["name" => $request["author_name"]]);

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'code' => 201,
            'success' => true,
            'message' => 'Author updated successfully'
        ]);
    }

    public function destroy(int $id){
        $author = Author::find($id);
        
        $this->checkAuthor($author);

        $author->delete();

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'message' => 'Author record deleted successfully'
        ]);
    }
}