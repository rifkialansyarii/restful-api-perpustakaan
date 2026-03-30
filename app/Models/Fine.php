<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fine extends Eloquent
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_borrow', 'total_days_late', 'total_fine', 'fine_status', 'payment_date'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'payment_date'];

    /**
     * Get the borrow of the fine
     */
    public function borrow()
    {
        return $this->belongsTo(Borrow::class, 'id_borrow');
    }
}
