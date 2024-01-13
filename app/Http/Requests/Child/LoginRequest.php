<?php

namespace App\Http\Requests\Child;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest as DefaultLoginRequest;

class LoginRequest extends DefaultLoginRequest
{
    public function attemptLogin(): bool
    {
        return Auth::guard('child')->attempt($this->only('email', 'password'), $this->boolean('remember'));
    }
}
