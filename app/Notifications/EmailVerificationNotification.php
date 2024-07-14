<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Filament\Facades\Filament;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmailVerificationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
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
        ->subject(__('animals_back.verifyemail_title'))
        ->greeting(__('animals_back.hello') . " {$notifiable->name},")
        ->line(__('animals_back.emailverification_line_1'))
        ->action(__('animals_back.verifyemail_action'), $this->verificationUrl($notifiable))
        ->line(__('animals_back.emailverification_line_2'));

    }
    
    protected function verificationUrl(mixed $notifiable): string
    {
        return Filament::getVerifyEmailUrl($notifiable);
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
