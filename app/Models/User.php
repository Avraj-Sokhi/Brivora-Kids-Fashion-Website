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
        'password',
        'phone',
        'role',
        'first_login',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'first_login' => 'boolean',
        ];
    }

    /**
     * Get the addresses for the user.
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Get the orders for the user.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the reviews for the user.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the cart items for the user.
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }



    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user is a customer.
     */
    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }
}
