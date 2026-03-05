<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // 1. Allow these fields to be filled by the user
    protected $fillable = [
        'title',
        'description',
        'price',
        'user_id',
    ];

    // 2. Define the relationship: An Item belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}