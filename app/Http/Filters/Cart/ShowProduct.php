<?php

namespace App\Http\Filters\Cart;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class ShowProduct
{
    public function handle(Builder $query, Closure $next)
    {
        if (!request()->has('product')) {
            return $next($query);
        }

        $query->with('product.store');

        return $next($query);
    }
}
