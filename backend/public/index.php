<?php

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../bootstrap.php";

use Base\Router;


/**
 * Default route is /api/
 * You should access all of this route using /api/<endpoint>
 */

header("Access-Control-Allow-Origin: http://127.0.0.1:8081"); 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Accept");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

Router::add("GET", "/borrows", "App\Controllers\BorrowController", "index");
Router::add("GET", "/borrows/([A-Za-z0-9\-]+)", "App\Controllers\BorrowController", "show");
Router::add("POST", "/borrows", "App\Controllers\BorrowController", "store");
Router::add("PATCH", "/borrows/([A-Za-z0-9\-]+)", "App\Controllers\BorrowController", "update");
Router::add("DELETE", "/borrows/([A-Za-z0-9\-]+)", "App\Controllers\BorrowController", "destroy");


Router::add("GET", "/books", "App\Controllers\BookController", "index");
Router::add("GET", "/books/([0-9\-]+)", "App\Controllers\BookController", "show");
Router::add("POST", "/books", "App\Controllers\BookController", "store");
Router::add("PATCH", "/books/([A-Za-z0-9\-]+)", "App\Controllers\BookController", "update");
Router::add("DELETE", "/books/([A-Za-z0-9\-]+)", "App\Controllers\BookController", "destroy");


Router::add("GET", "/authors", "App\Controllers\AuthorController", "index");
Router::add("GET", "/authors/([0-9]+)", "App\Controllers\AuthorController", "show");
Router::add("POST", "/authors", "App\Controllers\AuthorController", "store");
Router::add("PATCH", "/authors/([0-9]+)", "App\Controllers\AuthorController", "update");
Router::add("DELETE", "/authors/([0-9]+)", "App\Controllers\AuthorController", "destroy");


Router::add("GET", "/categories", "App\Controllers\CategoryController", "index");
Router::add("GET", "/categories/([0-9]+)", "App\Controllers\CategoryController", "show");
Router::add("POST", "/categories", "App\Controllers\CategoryController", "store");
Router::add("PATCH", "/categories/([0-9]+)", "App\Controllers\CategoryController", "update");
Router::add("DELETE", "/categories/([0-9]+)", "App\Controllers\CategoryController", "destroy");


Router::add("GET", "/publishers", "App\Controllers\PublisherController", "index");
Router::add("GET", "/publishers/([0-9]+)", "App\Controllers\PublisherController", "show");
Router::add("POST", "/publishers", "App\Controllers\PublisherController", "store");
Router::add("PATCH", "/publishers/([0-9]+)", "App\Controllers\PublisherController", "update");
Router::add("DELETE", "/publishers/([0-9]+)", "App\Controllers\PublisherController", "destroy");


Router::add("GET", "/users", "App\Controllers\UserController", "index");
Router::add("GET", "/users/([0-9]+)", "App\Controllers\UserController", "show");
Router::add("POST", "/users", "App\Controllers\UserController", "store");
Router::add("PATCH", "/users/([0-9]+)", "App\Controllers\UserController", "update");
Router::add("DELETE", "/users/([0-9]+)", "App\Controllers\UserController", "destroy");

Router::add("POST", "/login", "App\Controllers\AuthController", "authenticate");

Router::run();