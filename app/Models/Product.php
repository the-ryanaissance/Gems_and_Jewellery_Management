<?php

namespace App\Models;

use App\Services\JewelleryPricingService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'image',
        'price',
        'stock',
        'size_label',
        'size_options',
    ];

    protected $casts = [
        'stock' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function jewellery()
    {
        return $this->hasOne(Jewellery::class, 'product_id', 'product_id');
    }

    public function collection()
    {
        return $this->hasOne(ProductCollection::class, 'product_id', 'product_id');
    }

    public function gem()
    {
        return $this->hasOne(Gem::class, 'product_id', 'product_id');
    }

    public function zodiacSigns(): BelongsToMany
    {
        return $this->belongsToMany(ZodiacSign::class, 'astrology', 'product_id', 'zodiac_id', 'product_id', 'zodiac_id');
    }

    public function birthstoneMonths(): BelongsToMany
    {
        return $this->belongsToMany(BirthstoneMonth::class, 'product_birthstones', 'product_id', 'month_id', 'product_id', 'month_id');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id', 'product_id');
    }

    public function preview360()
    {
        return $this->hasOne(Product360Preview::class, 'product_id', 'product_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'product_id');
    }

    public function getPriceAttribute($value)
    {
        $rawPrice = (float) $value;

        if (! $this->relationLoaded('jewellery')) {
            return $rawPrice;
        }

        $jewellery = $this->getRelation('jewellery');

        if (! $jewellery) {
            return $rawPrice;
        }

        return app(JewelleryPricingService::class)->priceForProduct($this, $rawPrice);
    }
}
