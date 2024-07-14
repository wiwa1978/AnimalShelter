<?php

namespace App\Filament\App\Pages\Auth;

use Exception;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Notifications\Auth\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\EmailVerificationNotification;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
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

    public function resendNotificationAction(): Action
    {
        return Action::make('resendNotification')
            ->link()
            ->label(__('filament-panels::pages/auth/email-verification/email-verification-prompt.actions.resend_notification.label') . '.')
            ->action(function (): void {
                try {
                    $this->rateLimit(2);
                } catch (TooManyRequestsException $exception) {
                    $this->getRateLimitedNotification($exception)?->send();

                    return;
                }

                $this->sendEmailVerificationNotification($this->getVerifiable());

                Notification::make()
                    ->title(__('filament-panels::pages/auth/email-verification/email-verification-prompt.notifications.notification_resent.title'))
                    ->success()
                    ->send();
            });
    }

}
