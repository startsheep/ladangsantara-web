<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ["image_path", "experation_at", "status", "user_id", "external_id"];

    public function getImagePathAttribute($imagePath)
    {
        if (Storage::exists($imagePath)) {
            return asset("storage/" . $imagePath);
        }

        return asset("assets/images/logo-not-found.png");
    }
}
