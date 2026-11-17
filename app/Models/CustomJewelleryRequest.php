<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class CustomJewelleryRequest extends Model
{
    use HasFactory;

    protected $table = 'custom_jewellery_requests';

    protected $fillable = [
        'user_id',
        'request_number',
        'jewellery_type_id',
        'gem_product_id',
        'metal',
        'measurement_label',
        'size_value',
        'engraving',
        'notes',
        'type_details',
        'reference_images',
        'status',
        'quotation_amount',
        'quotation_note',
    ];

    protected $casts = [
        'type_details' => 'array',
        'reference_images' => 'array',
        'quotation_amount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jewelleryType(): BelongsTo
    {
        return $this->belongsTo(JewelleryType::class, 'jewellery_type_id', 'type_id');
    }

    public function gem(): BelongsTo
    {
        return $this->belongsTo(Gem::class, 'gem_product_id', 'product_id');
    }

    public function quotation(): HasOne
    {
        return $this->hasOne(CustomJewelleryQuotation::class, 'custom_jewellery_request_id');
    }

    public function getStatusClassAttribute(): string
    {
        return match (Str::lower((string) $this->status)) {
            'approved' => 'delivered',
            'quoted' => 'request',
            'rejected' => 'unread',
            default => 'pending',
        };
    }

    public function getReferenceCountAttribute(): int
    {
        return is_array($this->reference_images) ? count($this->reference_images) : 0;
    }

    public function getTypeDetailsSummaryAttribute(): string
    {
        $details = array_filter($this->type_details ?? [], static fn ($value) => filled($value));

        if (empty($details)) {
            return 'No extra design details provided.';
        }

        $parts = [];

        foreach ($details as $key => $value) {
            $label = Str::headline(str_replace('_', ' ', (string) $key));
            $parts[] = $label . ': ' . $value;
        }

        return implode(' · ', $parts);
    }

    public function getGemDisplayNameAttribute(): string
    {
        $gem = $this->gem;
        $product = $gem?->product;

        if ($product?->name) {
            return $product->name;
        }

        return 'Available Gem';
    }

    public function getTypeDisplayNameAttribute(): string
    {
        return $this->jewelleryType?->name ?? 'Custom Jewellery';
    }
}
