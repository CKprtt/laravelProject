<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
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

    /* ==========================
       Relationships
    ========================== */

    // User ↔ Role (Many to Many)
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_has_roles', 'users_id', 'roles_id');
    }

    // User ↔ ArtistProfile (One to One)
    public function artistProfile()
    {
        return $this->hasOne(ArtistProfile::class, 'users_id');
    }

    // User ↔ TicketBooking (One to Many)
    public function ticketBookings()
    {
        return $this->hasMany(TicketBooking::class, 'users_id');
    }

    // User ↔ Souvenir (Many to Many ผ่าน souvenir_orders)
    public function souvenirs()
    {
        return $this->belongsToMany(Souvenir::class, 'souvenir_orders', 'users_id', 'souvenirs_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}