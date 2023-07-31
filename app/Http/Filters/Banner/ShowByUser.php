<?php

namespace App\Http\Filters\Banner;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class ShowByUser
{
    public function handle(Builder $query, Closure $next)
    {
        if (!request()->has('user_id')) {
            return $next($query);
        }

        $query->where('user_id', 'LIKE', '%' . request('user_id') . '%');

        return $next($query);
    }
}
