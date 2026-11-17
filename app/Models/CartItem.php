<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    /**
     * Delete this cart item from the database.
     *
     * The generated IDE helper in `vendor/_laravel_ide/_model_helpers.php`
     * currently advertises a static `delete($id)` signature for this model,
     * which confuses Intelephense when we call the normal Eloquent instance
     * method.
     *
     * @method bool delete()
     */

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price_at_add_time',
        'size_value',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price_at_add_time' => 'decimal:2',
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function delete()
    {
        return parent::delete();
    }
}
