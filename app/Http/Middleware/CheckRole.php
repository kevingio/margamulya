<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->role != $role)
                return redirect('/admin/article');
        }

        return $next($request);
    }
}
