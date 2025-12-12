<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Category Model
 *
 * Represents a product category in the e-commerce system.
 * Categories organize products and can have associated images.
 */
class Category extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes
     *
     * @var array<string>
     */
    protected $fillable = ['name', 'description', 'image'];

    /**
     * Get products that belong to this category (matched by name field).
     *
     * Note: This relationship uses 'category' field on products table
     * matching against 'name' field on categories table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category', 'name');
    }

    /**
     * Resolve a usable image URL regardless of storage location.
     *
     * This accessor handles different image storage scenarios for categories:
     * - Laravel storage paths
     * - Legacy public/images paths
     *
     * @return string The fully qualified URL to the category image
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

