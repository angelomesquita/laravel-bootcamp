<?php

namespace App\Notifications;

use App\Models\Chirp;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Str;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewChirp extends Notification
{
    use Queueable;

    public function __construct(public Chirp $chirp)
    {
    }

    /**
     * @param  mixed  $notifiable
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * @param  mixed  $notifiable
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("New Chirp from {$this->chirp->user->name}")
            ->greeting("New Chirp from {$this->chirp->user->name}")
            ->line(Str::limit($this->chirp->message, 50))
            ->action('Go to Chirper', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * @param  mixed  $notifiable
     */
    public function toArray($notifiable): array
    {
        return [];
    }
}
