<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'rating',
        'comment',
        'image'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Resolve a usable image URL regardless of storage location.
     *
     * This accessor handles different image storage scenarios for review images:
     * - Laravel storage paths
     * - Legacy public/images paths
     *
     * @return string The fully qualified URL to the review image
     */
    public function getImageUrlAttribute(): string
    {
        $img = $this->image ?? '';

        // If path starts with storage/ or uploads/, serve via asset()
        if (str_starts_with($img, 'storage/') || str_starts_with($img, 'uploads/')) {
            return asset($img);
        }

        // Fallback: assume legacy files live in public/images
        return asset('images/' . ltrim($img, '/'));
    }


}
