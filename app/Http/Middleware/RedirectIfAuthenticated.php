<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
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

                $user = Auth::user();
                $roles = $user->roles;

                foreach ($roles as $role) {
                    $name = $role->name;

                    switch ($name) {
                        case 'user':
                            auth('web')->logout();
                            break;
                        case 'superadministrator':
                            return redirect()->route('admin.dashboard');
                            break;
                        case 'administrator':
                            return redirect()->route('admin.dashboard');
                            break;
                        default:
                            auth('web')->logout();
                            break;
                    }
                }
            }
        }

        return $next($request);
    }
}
