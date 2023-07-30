<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'slug',
        'name',
        'price',
        'stock',
        'image',
        'category',
        'description',
    ];

    public function getImageAttribute($image)
    {
        if (Storage::exists($image)) {
            return asset('storage/' . $image);
        }

        return asset('assets/images/logo-not-found.png');
    }

    public function store(): HasOne
    {
        return $this->hasOne(Store::class, 'id', 'store_id');
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class, 'product_id', 'id');
    }
}
