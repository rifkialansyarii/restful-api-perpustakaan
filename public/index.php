<?php

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../bootstrap.php";

use Base\Router;
use App\Middlewares\AuthMiddleware;

/**
 * Default route is /api/
 * You should access all of this route using /api/<endpoint>
 */

Router::add("GET", "/borrows", "App\Controllers\BorrowController", "index", [AuthMiddleware::class]);
Router::add("GET", "/borrows/([0-9]+)", "App\Controllers\BorrowController", "show", [AuthMiddleware::class]);
Router::add("POST", "/borrows", "App\Controllers\BorrowController", "store", [AuthMiddleware::class]);
Router::add("PATCH", "/borrows/([0-9]+)", "App\Controllers\BorrowController", "update", [AuthMiddleware::class]);
Router::add("DELETE", "/borrows/([0-9]+)", "App\Controllers\BorrowController", "destroy", [AuthMiddleware::class]);


Router::add("GET", "/books", "App\Controllers\BookController", "index");
Router::add("GET", "/books/([0-9]+)", "App\Controllers\BookController", "show");
Router::add("POST", "/books", "App\Controllers\BookController", "store", [AuthMiddleware::class]);
Router::add("PATCH", "/books/([0-9]+)", "App\Controllers\BookController", "update", [AuthMiddleware::class]);
Router::add("DELETE", "/books/([0-9]+)", "App\Controllers\BookController", "destroy", [AuthMiddleware::class]);


Router::add("GET", "/authors", "App\Controllers\AuthorController", "index");
Router::add("GET", "/authors/([0-9]+)", "App\Controllers\AuthorController", "show");
Router::add("POST", "/authors", "App\Controllers\AuthorController", "store", [AuthMiddleware::class]);
Router::add("PATCH", "/authors/([0-9]+)", "App\Controllers\AuthorController", "update", [AuthMiddleware::class]);
Router::add("DELETE", "/authors/([0-9]+)", "App\Controllers\AuthorController", "destroy", [AuthMiddleware::class]);


Router::add("GET", "/categories", "App\Controllers\CategoryController", "index");
Router::add("GET", "/categories/([0-9]+)", "App\Controllers\CategoryController", "show");
Router::add("POST", "/categories", "App\Controllers\CategoryController", "store", [AuthMiddleware::class]);
Router::add("PATCH", "/categories/([0-9]+)", "App\Controllers\CategoryController", "update", [AuthMiddleware::class]);
Router::add("DELETE", "/categories/([0-9]+)", "App\Controllers\CategoryController", "destroy", [AuthMiddleware::class]);


Router::add("GET", "/publishers", "App\Controllers\PublisherController", "index", [AuthMiddleware::class]);
Router::add("GET", "/publishers/([0-9]+)", "App\Controllers\PublisherController", "show");
Router::add("POST", "/publishers", "App\Controllers\PublisherController", "store", [AuthMiddleware::class]);
Router::add("PATCH", "/publishers/([0-9]+)", "App\Controllers\PublisherController", "update", [AuthMiddleware::class]);
Router::add("DELETE", "/publishers/([0-9]+)", "App\Controllers\PublisherController", "destroy", [AuthMiddleware::class]);


Router::add("GET", "/users", "App\Controllers\UserController", "index", [AuthMiddleware::class]);
Router::add("GET", "/users/([0-9]+)", "App\Controllers\UserController", "show", [AuthMiddleware::class]);
Router::add("POST", "/users", "App\Controllers\UserController", "store", [AuthMiddleware::class]);
Router::add("PATCH", "/users/([0-9]+)", "App\Controllers\UserController", "update", [AuthMiddleware::class]);
Router::add("DELETE", "/users/([0-9]+)", "App\Controllers\UserController", "destroy", [AuthMiddleware::class]);

Router::add("POST", "/login", "App\Controllers\AuthController", "authenticate");

Router::run();