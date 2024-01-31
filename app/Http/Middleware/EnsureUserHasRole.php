<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        /** @var User $user */
        $user = auth()->user();

        if (is_null($user) || !$user->roles->contains('name', strtoupper($role))) {
            abort(Response::HTTP_FORBIDDEN, 'Not authorized');
        }

        return $next($request);
    }
}
