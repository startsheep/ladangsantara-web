<?php

namespace App\Http\Filters\Product;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class Search
{
    public function handle(Builder $query, Closure $next)
    {
        if (!request()->has('search')) {
            return $next($query);
        }

        $query->where(function ($query) {
            $query->where('name', 'LIKE', '%' . request('search') . '%');
            $query->orWhere('description', 'LIKE', '%' . request('search') . '%');
            $query->orWhereHas('store', function ($query) {
                $query->where('name', 'LIKE', '%' . request('search') . '%');
            });
        });

        return $next($query);
    }
}
