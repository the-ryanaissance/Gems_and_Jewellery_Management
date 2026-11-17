<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'question',
        'answer',
        'group_name',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
