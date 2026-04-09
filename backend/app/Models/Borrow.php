<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrow extends Eloquent
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'borrow_code', 'id_user', 'id_book', 'borrow_date', 'due_date', 'return_date', 'status'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'borrow_date', 'due_date', 'return_date'];

    /**
     * Get the user of the borrow
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Get the book of the borrow
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'id_book');
    }

    /**
     * Get the fine of the borrow
     */
    public function fine()
    {
        return $this->hasOne(Fine::class, 'id_borrow');
    }
}
