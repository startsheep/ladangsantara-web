<?php

namespace App\Http\Filters\Product;

use App\Http\Traits\MessageFixer;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ShowByPrice
{
    use MessageFixer;

    public function handle(Builder $query, Closure $next)
    {
        if (!request()->has('prices')) {
            return $next($query);
        }

        $prices = json_decode(request('prices'));
        if ($prices[1] < $prices[0]) {
            return $next($query);
        }

        $query->whereBetween('price', $prices);

        return $next($query);
    }
}
