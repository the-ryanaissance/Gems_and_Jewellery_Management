<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBirthstone extends Model
{
    use HasFactory;

    protected $table = 'product_birthstones';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'month_id',
        'description',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function month()
    {
        return $this->belongsTo(BirthstoneMonth::class, 'month_id', 'month_id');
    }
}
