<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'category',
        'image',
        'desc',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

}
