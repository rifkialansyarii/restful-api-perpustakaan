<?php

namespace App\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;


class BookController
{
    private function getAuthorIds($request):array|null{
        return array_map(function($authorName){
            $author = Author::where('name', $authorName)->first();
            if(!$author){
                header('Content-Type: application/json; charset=utf-8');
                http_response_code(404);
                echo json_encode([
                    'code' => 404,
                    'success' => false,
                    'message' => "Author with name '$authorName' not found"
                ]);
                exit();
            }

            return $author->id;
        }, $request['authors']);
    }

    private function getCategoryIds($request):array|null{
        $categoryIds = array_map(function($categoryName){
            $category = Category::where('category_name', $categoryName)->first();
            if(!$category){
                header('Content-Type: application/json; charset=utf-8');
                http_response_code(404);
                echo json_encode([
                    'code' => 404,
                    'success' => false,
                    'message' => "Category '$categoryName' not found"
                ]);
                exit();
            }

            return $category->id;
        }, $request['categories']);

        return $categoryIds;
    }

    private function getPublisher($request){
        $publisher = Publisher::where('publisher_name', $request['publisher_name'])->first();
        if(!$publisher){
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(404);
            echo json_encode([
                'code' => 404,
                'success' => false,
                'message' => 'Publisher not found'
            ]);
            exit();
        }

        return $publisher->id;
    }

    public function index(){
        $books = Book::with(['authors', 'categories', 'publisher'])->get();

        $formattedData = $books->map(function($book) {
            return [
                "isbn" => $book?->isbn,
                "title" => $book?->title,
                "authors" => $book?->authors?->map(function($author){
                    return [
                        'author_name' => $author?->name
                    ];
                }),
                "categories" => $book?->categories?->map(function($category){
                    return [
                        'category_name' => $category?->category_name
                    ];
                }),
                "publisher" => $book?->publisher?->publisher_name,
                "publication_year" => $book?->publication_year,
                "stock" => $book?->stock,
            ];
        });

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'data' => $formattedData
        ]);
        exit();
    }

    public function show(string $isbn){
        $book = Book::with(['authors', 'categories', 'publisher'])->where('isbn', $isbn)->first();

        if(!$book){
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(404);
            echo json_encode([
                'code' => 404,
                'success' => false,
                'message' => "Book record is not found"
            ]);
            exit();
        }

        $formattedData = [
            "isbn" => $book?->isbn,
            "title" => $book?->title,
            "authors" => $book?->authors?->map(function($author){
                return [
                    'author_name' => $author?->name
                ];
            }),
            "categories" => $book?->categories?->map(function($category){
                return [
                    'category_name' => $category?->category_name
                ];
            }),
            "publisher" => $book?->publisher?->publisher_name,
            "publication_year" => $book?->publication_year,
            "stock" => $book?->stock,
        ];

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'data' => $formattedData
        ]);
        exit();
    }


    public function store(){
        $json_string = file_get_contents('php://input');
        $request = json_decode($json_string, true);

        $publisher = $this->getPublisher($request);
        $authorIds = $this->getAuthorIds($request);
        $categoryIds = $this->getCategoryIds($request);

        $book = Book::create([
            'isbn' => $request['isbn'],
            'title' => $request['title'],
            'id_publisher' => $publisher,
            'publication_year' => $request['publication_year'],
            'stock' => $request['stock']
        ]);


        $book->authors()->attach($authorIds);
        $book->categories()->attach($categoryIds);

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(201);
        echo json_encode([
            'code' => 201,
            'success' => true,
            'message' => 'Book added successfully'
        ]);
        exit();

    }

    public function update(string $isbn){
        $json_string = file_get_contents('php://input');
        $request = json_decode($json_string, true);

        $book = Book::where('isbn', $isbn)->first();
        if(!$book){
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(404);
            echo json_encode([
                'code' => 404,
                'success' => false,
                'message' => 'Book record not found'
            ]);
            exit();
        }

        $allowedData = array_intersect_key($request, array_flip(
            [
                'title',
                'isbn',
                'publication_year',
                'stock',
            ]
        ));

        $book->update($allowedData);

        if(isset($request['authors'])){
            $authorIds = $this->getAuthorIds($request);
            $book->authors()->sync($authorIds);
        }

        if(isset($request['categories'])){
            $categoryIds = $this->getCategoryIds($request);
            $book->categories()->sync($categoryIds);
        }

        if(isset($request['publisher_name'])){
            $publisher = $this->getPublisher($request);
            $book->update(["id_publisher"=>$publisher]);
        }

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'message' => 'Book Updated successfully'
        ]);
    }

    public function destroy(string $isbn){
        $book = Book::where('isbn', $isbn)->first();

        if(!$book){
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(404);
            echo json_encode([
                'code' => 404,
                'success' => false,
                'message' => 'Book record not found'
            ]);
            exit();
        }

        $book->delete();

        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'message' => 'Book record deleted successfully'
        ]);
    }
}