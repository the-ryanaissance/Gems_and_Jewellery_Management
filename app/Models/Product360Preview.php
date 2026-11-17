<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product360Preview extends Model
{
    use HasFactory;

    protected $table = 'product_360_previews';

    protected $fillable = [
        'product_id',
        'folder_path',
        'frame_count',
        'frame_files',
        'uploaded_by',
    ];

    protected $casts = [
        'frame_count' => 'integer',
        'frame_files' => 'array',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function imageUrls(): array
    {
        $folderPath = trim((string) $this->folder_path, '/');

        return collect($this->frame_files ?? [])
            ->filter()
            ->map(function ($fileName) use ($folderPath) {
                return asset($folderPath . '/' . ltrim((string) $fileName, '/'));
            })
            ->values()
            ->all();
    }
}
