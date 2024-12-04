<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateAdmin extends \Illuminate\Auth\Middleware\Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next, ...$guards): Response
    {
        if (!Auth::check() || Auth::user()->is_admin != 1) {
            throw new AuthenticationException(
                'Unauthorized.',
                [],
                $request->expectsJson() ? null : route('login')
            );
        }

        return $next($request);
    }
}