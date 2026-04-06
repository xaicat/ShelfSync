<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'author',
        'image',
        'category_id',
        'quantity',
        'price',
        'weight',
        'description'
    ];

    /**
     * A book belongs to a category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * A book can have many rental records.
     */
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}