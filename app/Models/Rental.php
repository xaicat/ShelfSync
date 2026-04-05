<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rental extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'book_id',
        'student_id',
        'return_date',
        'quantity',
        'status',
        'approval_status',
        'fine_amount',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    /**
     * Get the user that owns the rental.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the book associated with the rental.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get the fine appeal associated with the rental.
     */
    public function fineAppeal()
    {
        return $this->hasOne(FineAppeal::class);
    }
}