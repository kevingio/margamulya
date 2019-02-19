<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Session;

class Visitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data = [
            'ip_address'    => $request->ip(),
            'user_agent'    => $request->header('User-Agent'),
            'payload'       => $request->session()->get('_token'),
            'last_activity' => strtotime('now'),
        ];
        if(auth()->check()) {
            $data['user_id'] = auth()->user()->id;
        }
        Session::updateOrCreate([
            'payload'       => $request->session()->get('_token'),
        ], $data);

        return $next($request);
    }
}
