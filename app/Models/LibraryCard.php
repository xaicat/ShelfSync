<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryCard extends Model
{
    protected $fillable = [
        'user_id',
        'student_id',
        'department',
        'status',
        'issued_at',
        'expires_at'
    ];

    protected $casts = [
        'issued_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
