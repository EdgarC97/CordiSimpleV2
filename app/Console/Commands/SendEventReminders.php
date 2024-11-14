<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Notifications\EventReminderNotification;



class SendEventReminders extends Command
{
    protected $signature = 'send:event-reminders';
    protected $description = 'Enviar recordatorios a los usuarios con reservas para eventos en las próximas 24 horas';

    public function handle()
    {
        $events = Event::whereBetween('date', [now(), now()->addDay()])->get();

        foreach ($events as $event) {
            foreach ($event->reservations as $reservation) {
                $user = $reservation->user;
                $user->notify(new EventReminderNotification($event));
            }
        }

        $this->info('Recordatorios enviados a los usuarios con reservas para eventos en las próximas 24 horas.');
    }
}
