<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRegisteredNotification extends Notification
{
    /**
     * Determine how the notification should be delivered.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('¡Bienvenido a nuestra plataforma!')
            ->greeting('Hola ' . $notifiable->name . '!')
            ->line('Gracias por registrarte en nuestra plataforma.')
            ->action('Visita nuestra página', url('/'))
            ->line('Esperamos que disfrutes de tu experiencia.');
    }
}
