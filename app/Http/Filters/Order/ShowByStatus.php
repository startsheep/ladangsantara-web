<?php

namespace App\Http\Filters\Order;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class ShowByStatus
{
    public function handle(Builder $query, Closure $next)
    {
        if (!request()->has('status')) {
            return $next($query);
        }

        $query->where(function ($query) {
            $query->whereHas('purchases', function ($query) {
                $query->where('status', request('status'));
            });
        });

        return $next($query);
    }
}
