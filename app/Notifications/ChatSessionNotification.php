<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChatSessionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $timestamp;
    public $resolverId;
    public function __construct( $timestamp, $resolverId )
    {
        $this->timestamp = $timestamp;
        $this->resolverId = $resolverId;
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
                    ->subject('Chat Session Scheduled')
                    ->line('Hello ' . $notifiable->name . ',')
                    ->line('A chat session has been scheduled for ' . $this->timestamp )
                    ->action('Start chat', url('http://localhost:8000/chat?role=user&friendId=' .  (string)$this->resolverId ))
                    ->line('Thank you for using our application!');
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
