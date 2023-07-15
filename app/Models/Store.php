<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "name",
        "description",
        "address",
        "lat",
        "long",
        "logo",
        "status",
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, "id", "user_id");
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'store_id', 'id');
    }
}
