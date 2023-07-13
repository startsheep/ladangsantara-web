<?php

namespace App\Http\Filters\Store;

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
            $query->where('name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('description', 'LIKE', '%' . request('search') . '%')
                ->orWhereHas('user', function ($query) {
                    $query->where('name', 'LIKE', '%' . request('search') . '%');
                });
        });

        return $next($query);
    }
}
