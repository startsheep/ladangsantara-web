<?php
namespace App\Http\Filters\OrderStore;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class ShowByStatus
{
	public function handle(Builder $query, Closure $next)
	{
		if (!request()->has('show_by_status')) {
			return $next($query);
		}
		$query->where('show_by_status', 'LIKE', '%' . request('showByStatus') . '%');

		return $next($query);
	}
}