<?php

namespace App\Http\Filters\OrderStore;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class ShowByStore
{
    public function handle(Builder $query, Closure $next)
    {
        $query->with('user');

        $query->whereHas('purchases.product.store', function ($query) {
            $query->where('user_id', auth()->user()->id);
        });

        return $next($query);
    }
}
