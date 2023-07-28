<?php

namespace App\Http\Filters\Review;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class ShowProduct
{
    public function handle(Builder $query, Closure $next)
    {
        if (!request()->has('product')) {
            return $next($query);
        }

        $query->with('product');

        return $next($query);
    }
}
