<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    protected function redirectToForGuard(?string $guard): string
    {
        return match ($guard) {
            'admin' => RouteServiceProvider::ADMIN_DASHBOARD,
            'manager' => RouteServiceProvider::MANAGER_DASHBOARD,
            'employee' => RouteServiceProvider::EMPLOYEE_DASHBOARD,
            default => RouteServiceProvider::HOME,
        };
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect($this->redirectToForGuard($guard));
            }
        }

        return $next($request);
    }
}
