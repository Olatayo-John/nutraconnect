<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class RolePermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //get user permissions
        $userPermissions = Auth::user()->permissions->pluck('name_key')->unique();

        foreach ($userPermissions as $key => $value) {

            Gate::define($value, function () {
                return true;
            });
        }

        return $next($request);
    }
}
