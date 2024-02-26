<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketUpdatedNotification extends Notification
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('You Ticket Has Been Updated')
            ->line('Hello ' . $notifiable->name . ',')
            ->line('Your ticket has been taken under action and updated by our resolvers.')
            ->line('Ticket Details:')
            ->line('- Ticket ID: ' . $this->ticket->id)
            ->line('- Subject: ' . $this->ticket->body)
            ->line('- Status: ' . $this->ticket->status)
            ->line('- Subject: ' . $this->ticket->feedback)
            ->action('View Ticket', url('/users/' . $notifiable->id))
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
