<?php

namespace App\Controllers;

use App\Models\Category;

class CategoryController
{
    private function checkCategory($category){
        if(!$category){
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(404);
            echo json_encode([
                'code' => 404,
                'success' => false,
                'message' => 'Category record not found'
            ]);
            exit();
        }
    }

    public function index(){
        $categories = Category::all();

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'data' => $categories
        ]);
        exit();
    }

    public function store(){
        $json_string = file_get_contents('php://input');
        $request = json_decode($json_string, true);

        Category::create([
            'category_name' => $request['category_name'],
        ]);

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(201);
        echo json_encode([
            'code' => 201,
            'success' => true,
            'message' => 'Category added successfully'
        ]);
        exit();
    }
    
    public function update(int $id){
        $json_string = file_get_contents('php://input');
        $request = json_decode($json_string, true);

        $category = Category::find($id);
        $this->checkCategory($category);
    
        $category->update(["category_name" => $request["category_name"]]);

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'message' => 'Category Updated successfully'
        ]);
    }

    public function destroy(int $id){
        $category = Category::find($id);
        
        $this->checkCategory($category);

        $category->delete();

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'message' => 'Category record deleted successfully'
        ]);
    }
}