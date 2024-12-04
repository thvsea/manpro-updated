<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends \Illuminate\Auth\Middleware\Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$guards): Response
    {
        if (Auth::user() == null) {
            throw new AuthenticationException(
                'Unauthenticated.',
                $guards,
                $request->expectsJson() ? null : $this->redirectTo($request),
            );
        }

        if (Str::contains($request->path, 'admin') and Auth::user()->is_admin != 1) {
            throw new AuthenticationException(
                'Unauthenticated.',
                $guards,
                $request->expectsJson() ? null : $this->redirectTo($request),
            );
        }

        return $next($request);
    }
}
