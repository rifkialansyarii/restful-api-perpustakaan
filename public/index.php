<?php

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../bootstrap.php";

use Base\Router;

Router::add("POST", "/borrows", "App\Controllers\BorrowController", "store");
Router::add("PATCH", "/borrows/([0-9]+)", "App\Controllers\BorrowController", "update");
Router::add("DELETE", "/borrows/([0-9]+)", "App\Controllers\BorrowController", "destroy");

Router::run();