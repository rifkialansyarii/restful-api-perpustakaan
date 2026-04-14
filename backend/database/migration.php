<?php

require __DIR__ . "/../bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;


Capsule::schema()->create('authors', function ($table) {
    $table->id();
    $table->string('name');
    $table->timestamps();
    $table->softDeletes();
});

Capsule::schema()->create('categories', function ($table) {
    $table->id();
    $table->string('category_name');
    $table->timestamps();
    $table->softDeletes();
});

Capsule::schema()->create('publishers', function ($table) {
    $table->id();
    $table->string('publisher_name');
    $table->string('address');
    $table->timestamps();
    $table->softDeletes();
});

Capsule::schema()->create('books', function ($table) {
    $table->id();
    $table->string('isbn')->unique();
    $table->foreignId('id_publisher')->references('id')->on('publishers')->onDelete('cascade');
    $table->string('title');
    $table->year('publication_year');
    $table->integer('stock');
    $table->timestamps();
    $table->softDeletes();
});

Capsule::schema()->create('book_authors', function ($table) {
    $table->id();
    $table->foreignId('id_book')->references('id')->on('books')->onDelete('cascade');
    $table->foreignId('id_author')->references('id')->on('authors')->onDelete('cascade');
    $table->timestamps();
    $table->softDeletes();
});

Capsule::schema()->create('book_categories', function ($table) {
    $table->id();
    $table->foreignId('id_book')->references('id')->on('books')->onDelete('cascade');
    $table->foreignId('id_category')->references('id')->on('categories')->onDelete('cascade');
    $table->timestamps();
    $table->softDeletes();
});

Capsule::schema()->create('users', function ($table) {
    $table->id();
    $table->string('nisn')->nullable()->unique()->default(null);
    $table->string('first_name');
    $table->string('last_name')->nullable();
    $table->string('whatsapp_number')->unique();
    $table->enum('role', ['admin', 'student']);
    $table->timestamps();
    $table->softDeletes();
});

Capsule::schema()->create('borrows', function ($table) {
    $table->id();
    $table->char('borrow_code', 15)->unique();
    $table->foreignId('id_user')->references('id')->on('users')->onDelete('cascade');
    $table->foreignId('id_book')->references('id')->on('books')->onDelete('cascade');
    $table->date('borrow_date');
    $table->date('due_date');
    $table->date('return_date')->nullable();
    $table->enum('status', ['borrowed', 'returned', 'overdue']);
    $table->timestamps();
    $table->softDeletes();
});