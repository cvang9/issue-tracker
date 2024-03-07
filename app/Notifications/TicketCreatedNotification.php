<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    protected $ticket;
    public function __construct( Ticket $ticket )
    {
        $this->ticket = $ticket;
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Ticket Created in Your Department')
            ->line('Hello ' . $notifiable->name . ',')
            ->line('A new ticket has been created in your department.')
            ->line('Ticket Details:')
            ->line('- Ticket ID: ' . $this->ticket->id)
            ->line('- Subject: ' . $this->ticket->body)
            ->action('View Ticket', url('http://localhost:8000/resolver/' . $notifiable->resolver->id))
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
