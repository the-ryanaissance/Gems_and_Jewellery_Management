<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gem extends Model
{
    protected $table = 'gems';
    protected $primaryKey = 'product_id';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'category_id',
        'gem_type_id',
        'color',
        'shape',
        'carat_weight',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function gemType()
    {
        return $this->belongsTo(GemType::class, 'gem_type_id', 'gem_type_id');
    }

    public function zodiacSigns()
    {
        return $this->belongsToMany(ZodiacSign::class, 'astrology', 'product_id', 'zodiac_id', 'product_id', 'zodiac_id');
    }

    public function birthstoneMonths()
    {
        return $this->belongsToMany(BirthstoneMonth::class, 'product_birthstones', 'product_id', 'month_id', 'product_id', 'month_id');
    }
}
