<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventReminderNotification extends Notification
{
    use Queueable;

    public $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Recordatorio de evento')
            ->line("Este es un recordatorio para el evento {$this->event->name}.")
            ->line("Fecha y hora: {$this->event->date->format('d-m-Y H:i')}")
            ->line('¡No te lo pierdas!');
    }
}
