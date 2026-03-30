<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Eloquent
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'isbn', 'id_publisher', 'title', 'publication_year', 'stock'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the publisher of the book
     */
    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'id_publisher');
    }

    /**
     * Get the authors of the book
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_authors', 'id_book', 'id_author')
                ->withTimestamps();
    }

    /**
     * Get the categories of the book
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_categories', 'id_book', 'id_category')
                ->withTimestamps();
    }

    /**
     * Get the borrows of the book
     */
    public function borrows()
    {
        return $this->hasMany(Borrow::class, 'id_book');
    }
}
