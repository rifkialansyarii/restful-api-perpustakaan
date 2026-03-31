<?php

namespace App\Controllers;

use App\Models\Author;

class AuthorController
{
    public function index(){
        $books = Author::all();

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'data' => $books
        ]);
        exit();
    }
}