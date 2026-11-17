<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'birth_date',
        'gender',
        'zodiac_id',
        'address',
        'password',
        'role',
        'account_status',
        'permissions',
        'profile_image_path',
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
            'permissions' => 'array',
        ];
    }

    public function profileImageUrl(): ?string
    {
        if (!$this->profile_image_path) {
            return null;
        }

        return asset($this->profile_image_path);
    }

    public function profileInitial(): string
    {
        return strtoupper(substr($this->first_name ?? 'U', 0, 1));
    }

    public function zodiacSign(): BelongsTo
    {
        return $this->belongsTo(ZodiacSign::class, 'zodiac_id', 'zodiac_id');
    }

    public function siteNotifications(): HasMany
    {
        return $this->hasMany(SiteNotification::class, 'recipient_user_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function canAccessAdminDashboard(): bool
    {
        if (strtolower((string) ($this->account_status ?? '')) === 'blocked') {
            return false;
        }

        return in_array($this->role, ['admin', 'lower_admin', 'content_manager'], true);
    }

    public function defaultAdminPermissions(): array
    {
        return match ($this->role) {
            'content_manager' => [
                'manage_content',
                'manage_products',
            ],
            'lower_admin' => [
                'manage_orders',
                'manage_products',
                'manage_inventory',
                'manage_custom_jewellery',
                'manage_consultations',
                'manage_contact_messages',
            ],
            default => [],
        };
    }

    public function effectiveAdminPermissions(): array
    {
        $permissions = $this->permissions ?? [];

        if (is_array($permissions) && !empty($permissions)) {
            return array_values(array_unique($permissions));
        }

        if (!is_array($permissions) || empty($permissions)) {
            return $this->defaultAdminPermissions();
        }

        return [];
    }

    public function hasAdminPermission(string $permission): bool
    {
        if ($this->role === 'admin') {
            return true;
        }

        return in_array($permission, $this->effectiveAdminPermissions(), true);
    }
}
