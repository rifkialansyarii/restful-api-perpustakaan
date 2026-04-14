<?php

require __DIR__ . "/../bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Faker\Factory as Faker;

$faker = Faker::create('id_ID');

echo "Seeding..\n";

Capsule::schema()->disableForeignKeyConstraints();

$tables = [
    'borrows', 'book_categories', 'book_authors', 'books', 
    'users', 'publishers', 'categories', 'authors'
];
foreach ($tables as $table) {
    Capsule::table($table)->truncate();
}

Capsule::schema()->enableForeignKeyConstraints();


$authorIds = [];
for ($i = 0; $i < 10; $i++) {
    $authorIds[] = Capsule::table('authors')->insertGetId([
        'name' => $faker->name,
        'created_at' => Capsule::raw('CURRENT_TIMESTAMP'),
        'updated_at' => Capsule::raw('CURRENT_TIMESTAMP'),
    ]);
}
echo "- Authors berhasil di-seed\n";

$categories = ['Fiksi', 'Sains', 'Sejarah', 'Teknologi', 'Filsafat', 'Biografi'];
$categoryIds = [];
foreach ($categories as $category) {
    $categoryIds[] = Capsule::table('categories')->insertGetId([
        'category_name' => $category,
        'created_at' => Capsule::raw('CURRENT_TIMESTAMP'),
        'updated_at' => Capsule::raw('CURRENT_TIMESTAMP'),
    ]);
}
echo "- Categories berhasil di-seed\n";

$publisherIds = [];
for ($i = 0; $i < 5; $i++) {
    $publisherIds[] = Capsule::table('publishers')->insertGetId([
        'publisher_name' => $faker->company,
        'address' => $faker->address,
        'created_at' => Capsule::raw('CURRENT_TIMESTAMP'),
        'updated_at' => Capsule::raw('CURRENT_TIMESTAMP'),
    ]);
}
echo "- Publishers berhasil di-seed\n";

$bookIds = [];
for ($i = 0; $i < 20; $i++) {
    $bookIds[] = Capsule::table('books')->insertGetId([
        'isbn' => $faker->unique()->isbn13,
        'id_publisher' => $faker->randomElement($publisherIds),
        'title' => rtrim($faker->sentence(rand(3, 6)), '.'),
        'publication_year' => $faker->year,
        'stock' => $faker->numberBetween(5, 50),
        'created_at' => Capsule::raw('CURRENT_TIMESTAMP'),
        'updated_at' => Capsule::raw('CURRENT_TIMESTAMP'),
    ]);
}
echo "- Books berhasil di-seed\n";

foreach ($bookIds as $bookId) {
    $authorsForThisBook = $faker->randomElements($authorIds, rand(1, 2));
    foreach ($authorsForThisBook as $authorId) {
        Capsule::table('book_authors')->insert([
            'id_book' => $bookId,
            'id_author' => $authorId,
            'created_at' => Capsule::raw('CURRENT_TIMESTAMP'),
            'updated_at' => Capsule::raw('CURRENT_TIMESTAMP'),
        ]);
    }

    $categoriesForThisBook = $faker->randomElements($categoryIds, rand(1, 3));
    foreach ($categoriesForThisBook as $categoryId) {
        Capsule::table('book_categories')->insert([
            'id_book' => $bookId,
            'id_category' => $categoryId,
            'created_at' => Capsule::raw('CURRENT_TIMESTAMP'),
            'updated_at' => Capsule::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
echo "- Relasi Book-Author & Book-Category berhasil di-seed\n";

$userIds = [];

for ($i = 0; $i < 15; $i++) {
    $userIds[] = Capsule::table('users')->insertGetId([
        'nisn' => $faker->unique()->numerify('##########'),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'whatsapp_number' => $faker->unique()->e164PhoneNumber, // Format standar +62...
        'role' => "student",
        'created_at' => Capsule::raw('CURRENT_TIMESTAMP'),
        'updated_at' => Capsule::raw('CURRENT_TIMESTAMP'),
    ]);
}
echo "- Users berhasil di-seed\n";

for ($i = 0; $i < 30; $i++) {
    $borrowDate = $faker->dateTimeBetween('-1 month', 'now');
    $dueDate = (clone $borrowDate)->modify('+7 days');
    
    $status = $faker->randomElement(['borrowed', 'returned', 'overdue']);
    $returnDate = null;

    if ($status === 'returned') {
        $returnDate = $faker->dateTimeBetween($borrowDate, $dueDate);
    } elseif ($status === 'overdue') {
        $returnDate = null; 
        $dueDate = $faker->dateTimeBetween('-2 months', '-1 day');
    }

    $prefix = 'PJ-';
        $date = new DateTime();
        $nowDate = $date->format("Ymd");


    Capsule::table('borrows')->insert([
        'borrow_code' => 'PJ-' . $nowDate . '-' . str_pad($i+1, 3, '0', STR_PAD_LEFT),
        'id_user' => $faker->randomElement($userIds),
        'id_book' => $faker->randomElement($bookIds),
        'borrow_date' => $borrowDate->format('Y-m-d'),
        'due_date' => $dueDate->format('Y-m-d'),
        'return_date' => $returnDate ? $returnDate->format('Y-m-d') : null,
        'status' => $status,
        'created_at' => Capsule::raw('CURRENT_TIMESTAMP'),
        'updated_at' => Capsule::raw('CURRENT_TIMESTAMP'),
    ]);
}
echo "- Borrows berhasil di-seed\n";

echo "\nSemua proses seeding selesai dengan sukses!\n";