<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jewellery extends Model
{
    use HasFactory;

    protected $table = 'jewellery';
    protected $primaryKey = 'product_id';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'category_id',
        'type_id',
        'occasion',
        'gender',
        'metal',
        'metal_purity',
        'gemstone',
        'metal_weight',
        'making_charge',
        'wastage_percent',
        'market_factor',
        'pricing_mode',
    ];

    protected $casts = [
        'metal_weight' => 'float',
        'making_charge' => 'float',
        'wastage_percent' => 'float',
        'market_factor' => 'float',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function type()
    {
        return $this->belongsTo(JewelleryType::class, 'type_id', 'type_id');
    }
}
