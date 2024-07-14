<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private readonly string $token)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('animals_back.pw_title'))
            ->greeting(Lang::get('animals_back.hello') . " {$notifiable->name},")
            ->line(__('animals_back.pw_reset_line_1'))
            ->action(__('animals_back.reset_pw_action'), $this->resetUrl($notifiable))
            ->line(__('animals_back.pw_reset_line_2', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(__('animals_back.pw_reset_line_3'));
    }

    protected function resetUrl(mixed $notifiable): string
    {
        return Filament::getResetPasswordUrl($this->token, $notifiable);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
