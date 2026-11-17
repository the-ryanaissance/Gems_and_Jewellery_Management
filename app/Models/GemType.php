<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GemType extends Model
{
    use HasFactory;

    protected $table = 'gemtype';
    protected $primaryKey = 'gem_type_id';
    public $timestamps = false;

    protected $fillable = ['name'];

    public function gems()
    {
        return $this->hasMany(Gem::class, 'gem_type_id', 'gem_type_id');
    }
}