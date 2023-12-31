<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "slug",
        "name",
        "description",
        "address",
        "lat",
        "long",
        "logo",
        "status",
    ];

    public function getLogoAttribute($image)
    {
        if ($image && Storage::exists($image)) {
            return asset('storage/' . $image);
        }

        return asset('assets/images/logo-not-found.png');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, "id", "user_id");
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'store_id', 'id');
    }
}
