<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'address',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function libraryCard()
    {
        return $this->hasOne(LibraryCard::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function getCardStatusAttribute()
    {
        $card = $this->libraryCard;
        if (!$card) return 'none';

        if ($card->status === 'approved' && $card->expires_at && now()->greaterThan($card->expires_at)) {
            $card->update(['status' => 'expired']);
            return 'expired';
        }

        return $card->status;
    }
}
