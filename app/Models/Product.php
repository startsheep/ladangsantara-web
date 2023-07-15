<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    }
}
