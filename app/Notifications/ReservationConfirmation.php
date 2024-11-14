<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // Asegúrate de incluir esto
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationConfirmation extends Notification implements ShouldQueue // Implementa la interfaz
{
    use Queueable;

    protected $reservation;
    protected $type;

    /**
     * Create a new notification instance.
     */
    public function __construct($reservation, $type = 'reservation')
    {
        $this->reservation = $reservation;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mailMessage = (new MailMessage)
            ->subject('Confirmación de Reserva')
            ->greeting('¡Hola!');
    
        if ($this->type === 'reservation') {
            $mailMessage->line('Tu reserva se ha realizado con éxito.')
                        ->line('Gracias por reservar con nosotros.');
        } elseif ($this->type === 'update') {
            $mailMessage->line('La información de tu reserva ha sido actualizada.')
                        ->line('Revisa los detalles actualizados en el enlace a continuación.');
        }
    
        // Aquí es donde va la línea que mencionaste
        $mailMessage->action('Ver Mis Reservas', route('reservations.index'))
                    ->line('¡Esperamos que disfrutes del evento!');
    
        return $mailMessage;
    }
    
}
