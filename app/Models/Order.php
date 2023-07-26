<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    const NOT_PAID = 0;

    const PACKED = 1;

    const SENT = 2;

    const COMPLETED = 3;

    const CANCELED = 4;

    protected $fillable = [
        'user_id',
        'address_id',
        'amount_purchase',
        "external_id",
        "status",
        "payment_channel"
    ];

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class, 'order_id', 'id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }
}
