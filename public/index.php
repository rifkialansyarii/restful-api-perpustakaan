<?php

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../bootstrap.php";

use Base\Router;

Router::add("GET", "/borrows", "App\Controllers\BorrowController", "index");
Router::add("POST", "/borrows", "App\Controllers\BorrowController", "store");
Router::add("PATCH", "/borrows/([0-9]+)", "App\Controllers\BorrowController", "update");
Router::add("DELETE", "/borrows/([0-9]+)", "App\Controllers\BorrowController", "destroy");


Router::add("GET", "/books", "App\Controllers\BookController", "index");
Router::add("POST", "/books", "App\Controllers\BookController", "store");
Router::add("PATCH", "/books/([0-9]+)", "App\Controllers\BookController", "update");
Router::add("DELETE", "/books/([0-9]+)", "App\Controllers\BookController", "destroy");


Router::add("GET", "/authors", "App\Controllers\AuthorController", "index");
Router::add("POST", "/authors", "App\Controllers\AuthorController", "store");
Router::add("PATCH", "/authors/([0-9]+)", "App\Controllers\AuthorController", "update");
Router::add("DELETE", "/authors/([0-9]+)", "App\Controllers\AuthorController", "destroy");


Router::run();