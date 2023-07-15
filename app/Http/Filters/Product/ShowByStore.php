<?php

namespace App\Http\Filters\Product;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class ShowByStore
{
    public function handle(Builder $query, Closure $next)
    {
        if (!request()->has('store_id')) {
            return $next($query);
        }

        $query->where('store_id', 'LIKE', '%' . request('store_id') . '%');

        return $next($query);
    }
}
