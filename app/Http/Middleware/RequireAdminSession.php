<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RequireAdminSession
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            ! Auth::check()
            || ! Auth::user()->is_admin
            || ! $request->session()->get('is_admin')
        ) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
