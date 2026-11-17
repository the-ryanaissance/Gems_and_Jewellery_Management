<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ZodiacSign extends Model
{
    use HasFactory;

    protected $table = 'zodiac_signs';

    protected $primaryKey = 'zodiac_id';

    public $timestamps = false;

    protected $fillable = [
        'sign_name',
        'start_month',
        'start_day',
        'end_month',
        'end_day',
        'element',
        'description',
        'compatible_sign',
        'image',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'zodiac_id', 'zodiac_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'astrology', 'zodiac_id', 'product_id', 'zodiac_id', 'product_id');
    }
}
