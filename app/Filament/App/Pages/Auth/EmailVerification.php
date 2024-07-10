<?php

namespace App\Filament\App\Pages\Auth;

use Exception;
use Filament\Facades\Filament;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\EmailVerificationNotification;
use Filament\Pages\Auth\EmailVerification\EmailVerificationPrompt as BaseEmailVerificationPrompt;

class EmailVerification extends BaseEmailVerificationPrompt {

    protected function sendEmailVerificationNotification(MustVerifyEmail $user): void
    {
        if ($user->hasVerifiedEmail()) {
            return;
        }

        if (! method_exists($user, 'notify')) {
            $userClass = $user::class;

            throw new Exception("Model [{$userClass}] does not have a [notify()] method.");
        }

        $notification = app(EmailVerificationNotification::class);
        $notification->url = Filament::getVerifyEmailUrl($user);

        $user->notify($notification);
    }

}
