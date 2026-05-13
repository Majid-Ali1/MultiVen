<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role_id', 'status'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public function settings()
    {
        return $this->hasMany(Setting::class, 'vendor_id');
    }

    public function dropshipProducts()
    {
        return $this->belongsToMany(Product::class, 'vendor_products', 'vendor_id', 'product_id')
                    ->withPivot('vendor_price', 'status')
                    ->withTimestamps();
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($roles)
    {
        if (is_string($roles)) {
            return $this->role->slug === $roles;
        }

        if (is_array($roles)) {
            return in_array($this->role->slug, $roles);
        }

        return false;
    }

    public function hasPermission($permission)
    {
        return $this->role->permissions()->where('slug', $permission)->exists();
    }

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
}
