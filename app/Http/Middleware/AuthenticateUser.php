<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateUser extends \Illuminate\Auth\Middleware\Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$guards): Response
    {
        if (!Auth::check()) {
            throw new AuthenticationException(
                'Unauthenticated.',
                $guards,
                $request->expectsJson() ? null : $this->redirectTo($request),
            );
        }

        return $next($request);
    }
}