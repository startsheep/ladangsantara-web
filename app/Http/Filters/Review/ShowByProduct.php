<?php

namespace App\Http\Filters\Review;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class ShowByProduct
{
    public function handle(Builder $query, Closure $next)
    {
        if (!request()->has('product_id')) {
            return $next($query);
        }

        $query->where('product_id', request('product_id'));

        return $next($query);
    }
}
