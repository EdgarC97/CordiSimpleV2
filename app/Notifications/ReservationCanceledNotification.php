<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationCanceledNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Reserva Cancelada')
            ->greeting('Hola ' . $notifiable->name . ',')
            ->line('Has cancelado tu reserva para el evento: ' . $this->reservation->event->name)
            ->line('Si tienes alguna pregunta, no dudes en contactarnos.')
            ->action('Ver mis reservas', route('reservations.index'))
            ->line('Gracias por utilizar nuestro servicio!');
    }
}
