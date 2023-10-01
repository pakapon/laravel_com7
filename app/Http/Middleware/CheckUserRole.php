<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return response('Unauthorized.', 401);
        }

        $role = $user->role; // ตั้งสมมติว่าคุณมี column `role` ในตาราง users

        if ($role == 'viewer' && $request->isMethod('post')) {
            return response('Unauthorized.', 403);
        }

        if ($role == 'editor' && $request->is('api/products/delete/*')) {
            return response('Unauthorized.', 403);
        }

        return $next($request);
    }
}
