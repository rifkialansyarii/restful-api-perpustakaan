<?php

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../bootstrap.php";

use Base\Router;

Router::add("POST", "/borrows", "App\Controllers\BorrowController", "store");

Router::run();