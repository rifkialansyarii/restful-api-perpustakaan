<?php

namespace App\Controllers;

use App\Models\Publisher;

class PublisherController
{
    private function checkPublisher(string $publisher){
        if(!$publisher){
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(404);
            echo json_encode([
                'code' => 404,
                'success' => false,
                'message' => 'Publisher record not found'
            ]);
            exit();
        }
    }

    public function index(){
        $publishers = Publisher::get();

        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'data' => $publishers?->map(function($publisher){
                return [
                    'publisher_name' => $publisher->publisher_name,
                    'address' => $publisher->address,
                ];
            })
        ]);
        exit();
    }

    public function show($id){
        $publisher = Publisher::find($id);

        if(!$publisher){
            header('Content-Type: application/json');
            http_response_code(404);
            echo json_encode([
                'code' => 404,
                'success' => false,
                'message' => "Publisher record is not found"
            ]);
            exit();
        }

        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'data' => [
                "publisher_name" => $publisher->publisher_name,
                "address" => $publisher->address,
            ]
        ]);
        exit();
    }

    public function store(){
        $json_string = file_get_contents('php://input');
        $request = json_decode($json_string, true);

        Publisher::create([
            'publisher_name' => $request['publisher_name'],
            'address' => $request['address'],
        ]);

        header('Content-Type: application/json');
        http_response_code(201);
        echo json_encode([
            'code' => 201,
            'success' => true,
            'message' => 'Publisher added successfully'
        ]);
        exit();
    }
    
    public function update(int $id){
        $json_string = file_get_contents('php://input');
        $request = json_decode($json_string, true);

        $publisher = Publisher::find($id);
        $this->checkPublisher($publisher);
    
        $allowedData = array_intersect_key($request, array_flip(
            [
                'publisher_name',
                'address',
            ]
        ));

        $publisher->update($allowedData);

        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'message' => 'Publisher Updated successfully'
        ]);
    }

    public function destroy(int $id){
        $publisher = Publisher::find($id);
        
        $this->checkPublisher($publisher);

        $publisher->delete();

        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'message' => 'Publisher record deleted successfully'
        ]);
    }
}