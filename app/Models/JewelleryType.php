<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JewelleryType extends Model
{
    use HasFactory;

    protected $table = 'jewellerytype';
    protected $primaryKey = 'type_id';
    public $timestamps = false;

    protected $fillable = ['name'];

    public function jewellery()
    {
        return $this->hasMany(Jewellery::class, 'type_id', 'type_id');
    }
}