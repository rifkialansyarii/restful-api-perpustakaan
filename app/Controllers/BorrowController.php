<?php

namespace App\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use function Illuminate\Support\now;

class BorrowController
{
    public function index(){
        
    }

    private function generateBorrowCode()
    {
        $prefix = 'PJ-';
        $nowDate = now()->format('Ymd');

        $lastRecord = Borrow::where('borrow_code', 'like', $prefix . $nowDate . '%')
                                ->orderBy('borrow_code', 'desc')
                                ->first();

        if ($lastRecord) {
            $lastNumber = (int) substr($lastRecord->borrow_code, -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . $nowDate . '-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public function store(){
        $json_string = file_get_contents('php://input');
        $request = json_decode($json_string, true);

        $user = User::where('nisn', $request['nisn'])->first();
        if(!$user){
            http_response_code(404);
            echo json_encode([
                'code' => 404,
                'success' => false,
                'message' => 'User not found'
            ]);
            exit();
        }

        $book = Book::where('isbn', $request['isbn'])->first();
        if(!$book){
            http_response_code(404);
            echo json_encode([
                'code' => 404,
                'success' => false,
                'message' => 'Book not found'
            ]);
            exit();
        }

        $isAlreadyBorrowed = Borrow::where('id_user', $user->id)
                                ->where('id_book', $book->id)
                                ->where('status', 'borrowed')
                                ->exists();

        if ($isAlreadyBorrowed) {
            http_response_code(400);
            echo json_encode([
                'code' => 400,
                'success' => false,
                'message' => 'Book is already borrowed'
            ]);
            exit();
        }

        Borrow::create([
            'borrow_code' => $this->generateBorrowCode(),
            'id_user' => $user->id,
            'id_book' => $book->id,
            'borrow_date' => now()->format('Y-m-d'),
            'due_date' => now()->addDays(7)->format('Y-m-d'),
            'status' => $request['status']
        ]);

        Book::where('id', $book->id)->decrement('stock');


        http_response_code(201);
        echo json_encode([
            'code' => 201,
            'success' => true,
            'message' => 'Book borrowed successfully'
        ]);

    }

    public function update(int $id){
        $json_string = file_get_contents('php://input');
        $request = json_decode($json_string, true);

        $borrow = Borrow::find($id);
        if(!$borrow){
            http_response_code(404);
            echo json_encode([
                'code' => 404,
                'success' => false,
                'message' => 'Borrow record not found'
            ]);
            exit();
        }

        $borrow->update([
            'return_date' => now()->format('Y-m-d'),
            'status' => $request['status']
        ]);

        http_response_code(200);
        echo json_encode([
            'code' => 200,
            'success' => true,
            'message' => 'Book returned successfully'
        ]);
    }
}