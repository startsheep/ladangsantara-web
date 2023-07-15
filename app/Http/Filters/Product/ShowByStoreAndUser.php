<?php

namespace App\Http\Filters\Product;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class ShowByStoreAndUser
{
    public function handle(Builder $query, Closure $next)
    {
        if (request()->has('store') && request('store') == "true") {
            if (request()->has('user') && request('user') == "true") {
                $query->with("store.user");
            } else {
                $query->with("store");
            }
        }

        return $next($query);
    }
}
