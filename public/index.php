<?php

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../bootstrap.php";

use Base\Router;

Router::add("GET", "/borrows", "App\Controllers\BorrowController", "index");
Router::add("GET", "/borrows/([0-9]+)", "App\Controllers\BorrowController", "show");
Router::add("POST", "/borrows", "App\Controllers\BorrowController", "store");
Router::add("PATCH", "/borrows/([0-9]+)", "App\Controllers\BorrowController", "update");
Router::add("DELETE", "/borrows/([0-9]+)", "App\Controllers\BorrowController", "destroy");


Router::add("GET", "/books", "App\Controllers\BookController", "index");
Router::add("GET", "/books/([0-9]+)", "App\Controllers\BookController", "show");
Router::add("POST", "/books", "App\Controllers\BookController", "store");
Router::add("PATCH", "/books/([0-9]+)", "App\Controllers\BookController", "update");
Router::add("DELETE", "/books/([0-9]+)", "App\Controllers\BookController", "destroy");


Router::add("GET", "/authors", "App\Controllers\AuthorController", "index");
Router::add("GET", "/authors/([0-9]+)", "App\Controllers\AuthorController", "show");
Router::add("POST", "/authors", "App\Controllers\AuthorController", "store");
Router::add("PATCH", "/authors/([0-9]+)", "App\Controllers\AuthorController", "update");
Router::add("DELETE", "/authors/([0-9]+)", "App\Controllers\AuthorController", "destroy");


Router::add("GET", "/categories", "App\Controllers\CategoryController", "index");
Router::add("POST", "/categories", "App\Controllers\CategoryController", "store");
Router::add("PATCH", "/categories/([0-9]+)", "App\Controllers\CategoryController", "update");
Router::add("DELETE", "/categories/([0-9]+)", "App\Controllers\CategoryController", "destroy");


Router::add("GET", "/users", "App\Controllers\UserController", "index");
Router::add("GET", "/users/([0-9]+)", "App\Controllers\UserController", "show");
Router::add("POST", "/users", "App\Controllers\UserController", "store");
Router::add("PATCH", "/users/([0-9]+)", "App\Controllers\UserController", "update");
Router::add("DELETE", "/users/([0-9]+)", "App\Controllers\UserController", "destroy");


Router::run();