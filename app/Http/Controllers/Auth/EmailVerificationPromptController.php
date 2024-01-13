<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        $is_child = $request->routeIs('child.*');

        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(
                $is_child
                    ? RouteServiceProvider::CHILD
                    : RouteServiceProvider::HOME)
            : view('auth.verify-email', [
                'is_child' => $is_child
            ]);
    }
}
