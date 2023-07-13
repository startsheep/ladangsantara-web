<?php

namespace App\Http\Filters\Store;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class ShowUser
{
    public function handle(Builder $query, Closure $next)
    {
        if (!request()->has('user')) {
            return $next($query);
        }

        $query->with("user");

        return $next($query);
    }
}
