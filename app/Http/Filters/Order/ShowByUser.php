<?php

namespace App\Http\Filters\Order;

use App\Models\User;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class ShowByUser
{
    public function handle(Builder $query, Closure $next)
    {
        $user = User::findOrFail(auth()->user()->id);
        if ($user->role_id == User::MEMBER) {
            $query->where('user_id', $user->id);
        }

        return $next($query);
    }
}
