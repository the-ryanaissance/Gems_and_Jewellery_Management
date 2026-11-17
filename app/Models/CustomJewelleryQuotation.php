<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class CustomJewelleryQuotation extends Model
{
    use HasFactory;

    protected $table = 'custom_jewellery_quotations';

    protected $fillable = [
        'custom_jewellery_request_id',
        'user_id',
        'quotation_number',
        'quotation_amount',
        'quotation_note',
        'quotation_image',
        'status',
        'sent_at',
        'responded_at',
        'paid_at',
    ];

    protected $casts = [
        'quotation_amount' => 'decimal:2',
        'sent_at' => 'datetime',
        'responded_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public function request(): BelongsTo
    {
        return $this->belongsTo(CustomJewelleryRequest::class, 'custom_jewellery_request_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusClassAttribute(): string
    {
        return match (Str::lower((string) $this->status)) {
            'sent' => 'info',
            'accepted', 'paid' => 'ok',
            'rejected' => 'bad',
            default => 'warn',
        };
    }
}
