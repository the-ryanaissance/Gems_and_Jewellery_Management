<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ZodiacSign;

class Astrology extends Model
{
    protected $table = 'astrology';
    protected $primaryKey = 'astrology_id';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'zodiac_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function zodiacSign()
    {
        return $this->belongsTo(ZodiacSign::class, 'zodiac_id', 'zodiac_id');
    }
}
