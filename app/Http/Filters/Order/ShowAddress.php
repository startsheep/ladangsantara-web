<?php

namespace App\Http\Filters\Order;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class ShowAddress
{
    public function handle(Builder $query, Closure $next)
    {
        if (!request()->has('address')) {
            return $next($query);
        }

        $query->with('address');

        return $next($query);
    }
}
