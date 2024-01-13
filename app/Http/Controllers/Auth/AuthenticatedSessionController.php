<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        return view('auth.login', [
            'is_child' => $request->routeIs('child.*')
        ]);
    }

    /**
     * Handle an incoming authentication request.
     * @throws ValidationException
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $is_child = $request->routeIs('child.*');

        $request->authenticate($is_child);
        $request->session()->regenerate();

        return redirect()
            ->intended($is_child
                ? RouteServiceProvider::CHILD
                : RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $is_child = $request->routeIs('child.*');
        Auth::guard($is_child ? 'child' : 'web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route($is_child ? 'child.login' : 'login');
    }
}
