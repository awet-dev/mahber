<?php

namespace App\Traits;

use Illuminate\Auth\MustVerifyEmail;
use App\Notifications\ChildVerifyEmail;

trait ChildMustVerifyEmail
{
    use MustVerifyEmail;

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new ChildVerifyEmail);
    }
}
