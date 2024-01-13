<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $is_child = $request->routeIs('child.*');
        $verified_path = ($is_child
                ? RouteServiceProvider::CHILD
                : RouteServiceProvider::HOME)
            . '?verified=1';

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended($verified_path);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended($verified_path);
    }
}
