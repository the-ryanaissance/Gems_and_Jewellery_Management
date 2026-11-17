<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class SiteNotification extends Model
{
    use HasFactory;

    protected $table = 'site_notifications';

    protected $fillable = [
        'recipient_user_id',
        'recipient_role',
        'category',
        'image_path',
        'title',
        'message',
        'status',
        'action_label',
        'action_url',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function recipientUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_user_id');
    }

    public function getStatusClassAttribute(): string
    {
        return Str::lower((string) $this->status) === 'read' ? 'read' : 'unread';
    }

    public function imageUrl(): ?string
    {
        if (!$this->image_path) {
            return null;
        }

        return asset($this->image_path);
    }
}
