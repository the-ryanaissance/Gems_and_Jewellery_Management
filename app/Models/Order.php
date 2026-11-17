<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'shipping_method',
        'payment_method',
        'status',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'town',
        'province',
        'postal_code',
        'notes',
        'receipt_image',
        'subtotal',
        'shipping_cost',
        'pickup_only',
        'deposit_amount',
        'balance_due',
        'total',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'pickup_only' => 'boolean',
        'deposit_amount' => 'decimal:2',
        'balance_due' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function returnRequest(): HasOne
    {
        return $this->hasOne(OrderReturn::class);
    }
}
