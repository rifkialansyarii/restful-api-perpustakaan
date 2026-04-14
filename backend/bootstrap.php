<?php

require __DIR__ . '/vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$capsule = new Capsule();

$capsule->addConnection([
    'driver' => $_ENV['DB_CONNECTION'],
    // 'host' => $_ENV['DB_HOST'],
    // 'port' => $_ENV['DB_PORT'],
    'database' => __DIR__ . "/database/data/" . $_ENV['DB_DATABASE'] . ".db3",
    // 'username' => $_ENV['DB_USERNAME'],
    // 'password' => $_ENV['DB_PASSWORD'],
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();
