<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $roles = explode('|', $role);
        $user = auth()->user();

        if (! in_array($user->jabatan?->role_name, $roles)) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
