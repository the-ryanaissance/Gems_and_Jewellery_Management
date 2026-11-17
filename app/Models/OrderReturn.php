<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class OrderReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'request_number',
        'reason',
        'decision',
        'refund_status',
        'refund_amount',
        'admin_note',
        'reviewed_by_user_id',
        'reviewed_at',
        'refunded_at',
    ];

    protected $casts = [
        'refund_amount' => 'decimal:2',
        'reviewed_at' => 'datetime',
        'refunded_at' => 'datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by_user_id');
    }

    public function getDecisionClassAttribute(): string
    {
        return match (Str::lower((string) $this->decision)) {
            'approved' => 'ok',
            'rejected' => 'bad',
            default => 'warn',
        };
    }

    public function getRefundStatusClassAttribute(): string
    {
        return match (Str::lower((string) $this->refund_status)) {
            'refunded' => 'ok',
            default => 'info',
        };
    }
}
