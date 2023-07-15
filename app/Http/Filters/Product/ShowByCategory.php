<?php

namespace App\Http\Filters\Product;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class ShowByCategory
{
    public function handle(Builder $query, Closure $next)
    {
        if (!request()->has('category')) {
            return $next($query);
        }

        $query->where('category', 'LIKE', '%' . request('category') . '%');

        return $next($query);
    }
}
