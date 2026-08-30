<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                $role = strtolower((string) ($user->role ?? ''));
                $permission = strtolower((string) ($user->permission ?? ''));
                $permissions = strtolower((string) ($user->permissions ?? ''));

                if ($user && ($role === 'admin' || in_array($permission, ['all', 'full_access'], true) || in_array($permissions, ['all', 'full_access'], true))) {
                    return redirect()->to('/panel/admin');
                }

                return redirect()->to('/dashboard');
            }
        }

        return $next($request);
    }
}
