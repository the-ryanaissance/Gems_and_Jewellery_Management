<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ConsultationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'consultant_id',
        'request_number',
        'request_kind',
        'request_type',
        'preferred_date',
        'preferred_time',
        'appointment_mode',
        'contact_number',
        'customer_note',
        'status',
        'consultant_note',
        'chat_thread_id',
        'approved_at',
        'completed_at',
        'rejected_at',
        'cancelled_at',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'approved_at' => 'datetime',
        'completed_at' => 'datetime',
        'rejected_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function consultant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'consultant_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ConsultationMessage::class)->orderBy('created_at');
    }

    public function scopeForCustomer($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function getStatusClassAttribute(): string
    {
        return match (Str::lower((string) $this->status)) {
            'approved' => 'info',
            'completed' => 'ok',
            'rejected', 'cancelled' => 'bad',
            default => 'warn',
        };
    }

    public function getDisplayRequestTypeAttribute(): string
    {
        return $this->request_type ?: 'Consultation';
    }

    public function getCustomerNameAttribute(): string
    {
        $firstName = trim((string) ($this->customer?->first_name ?? ''));
        $lastName = trim((string) ($this->customer?->last_name ?? ''));

        return trim($firstName . ' ' . $lastName) ?: 'Customer';
    }

    public function getConsultantNameAttribute(): string
    {
        $firstName = trim((string) ($this->consultant?->first_name ?? ''));
        $lastName = trim((string) ($this->consultant?->last_name ?? ''));

        return trim($firstName . ' ' . $lastName) ?: 'Consultant Team';
    }

    public function getDateTimeLabelAttribute(): string
    {
        $date = $this->preferred_date?->format('Y-m-d') ?? '-';
        $time = trim((string) ($this->preferred_time ?? ''));

        return trim($date . ' ' . $time);
    }
}
