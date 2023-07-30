<?php

namespace App\Http\Filters\Recipe;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class Search
{
    public function handle(Builder $query, Closure $next)
    {
        if (!request()->has('search')) {
            return $next($query);
        }

        $query->where('ingredient', 'LIKE', '%' . request('search') . '%');

        return $next($query);
    }
}
