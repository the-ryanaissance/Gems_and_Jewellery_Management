<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'actor_user_id',
        'actor_name',
        'actor_role',
        'action',
        'module',
        'subject_type',
        'subject_id',
        'summary',
        'ip_address',
        'user_agent',
    ];

    protected function casts(): array
    {
        return [
            'subject_id' => 'integer',
        ];
    }

    public function actor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'actor_user_id');
    }
}
