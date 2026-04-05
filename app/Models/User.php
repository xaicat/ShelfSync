<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'address', // <--- Added this
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's library card
     */
    public function libraryCard()
    {
        return $this->hasOne(LibraryCard::class);
    }

    /**
     * Get the user's rentals
     */
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    /**
     * Get real-time card status with auto-expiry engine
     */
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
