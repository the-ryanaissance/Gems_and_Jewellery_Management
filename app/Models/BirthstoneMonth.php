<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirthstoneMonth extends Model
{
    use HasFactory;

    protected $table = 'birthstone_months';

    protected $primaryKey = 'month_id';

    public $timestamps = false;

    protected $fillable = [
        'month_name',
        'description',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_birthstones', 'month_id', 'product_id', 'month_id', 'product_id');
    }
}
