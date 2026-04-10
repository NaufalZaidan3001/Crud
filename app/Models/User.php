<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'phone'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    use SoftDeletes;

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
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Determine if the user has verified their email address.
     * Admin and restaurant users don't need email verification.
     */
    public function hasVerifiedEmail()
    {
        // Admin and restaurant users are automatically considered verified
        if (in_array($this->role, ['admin', 'restaurant'])) {
            return true;
        }

        // Customer users need email verification
        return ! is_null($this->email_verified_at);
    }

    /**
     * Mark the given user's email as verified.
     * Only mark as verified for customer users.
     */
    public function markEmailAsVerified()
    {
        // Only mark as verified for customer users
        if ($this->role === 'customer' || is_null($this->role)) {
            return $this->forceFill([
                'email_verified_at' => $this->freshTimestamp(),
            ])->save();
        }

        // Admin and restaurant users are always considered verified
        return true;
    }

    public function restaurant()
    {
        return $this->hasOne(Restaurant::class);
    }
}
