<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCollection extends Model
{
    use HasFactory;

    protected $table = 'collections';
    protected $primaryKey = 'collection_id';
    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'occasion',
        'gender',
        'gemstone',
        'metal',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
