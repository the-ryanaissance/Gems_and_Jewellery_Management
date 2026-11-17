<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'consultant_id',
        'appointment_number',
        'appointment_mode',
        'appointment_topic',
        'preferred_date',
        'preferred_time',
        'contact_number',
        'customer_note',
        'status',
        'consultant_note',
        'approved_at',
        'completed_at',
        'rejected_at',
        'cancelled_at',
        'reschedule_requested_at',
        'reschedule_responded_at',
        'reschedule_proposed_date',
        'reschedule_proposed_time',
        'reschedule_note',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'approved_at' => 'datetime',
        'completed_at' => 'datetime',
        'rejected_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'reschedule_requested_at' => 'datetime',
        'reschedule_responded_at' => 'datetime',
        'reschedule_proposed_date' => 'date',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function consultant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'consultant_id');
    }

    public function getStatusClassAttribute(): string
    {
        return match (Str::lower((string) $this->status)) {
            'confirmed' => 'info',
            'completed' => 'ok',
            'cancelled' => 'bad',
            default => 'warn',
        };
    }

    public function getStatusAttribute($value): string
    {
        return match (Str::lower(trim((string) $value))) {
            'confirmed' => 'Confirmed',
            'cancelled' => 'Cancelled',
            'completed' => 'Completed',
            'pending' => 'Pending',
            default => Str::title(trim((string) $value) ?: 'Pending'),
        };
    }

    public function setStatusAttribute($value): void
    {
        $this->attributes['status'] = match (Str::lower(trim((string) $value))) {
            'confirm', 'confirmed' => 'Confirmed',
            'cancel', 'cancelled' => 'Cancelled',
            'completed', 'complete' => 'Completed',
            default => 'Pending',
        };
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

    public function getRescheduleStatusAttribute(): string
    {
        return $this->reschedule_requested_at && $this->reschedule_responded_at === null
            ? 'Pending'
            : 'None';
    }

    public function getHasPendingRescheduleAttribute(): bool
    {
        return $this->reschedule_requested_at !== null && $this->reschedule_responded_at === null;
    }
}
