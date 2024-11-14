<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\ReservationConfirmation;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'reservations';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'status',
        'user_id',
        'event_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function sendConfirmationNotification()
    {
        // Enviar la notificación al usuario asociado con la reserva
        $this->user->notify(new ReservationConfirmation($this));
    }
 
}
