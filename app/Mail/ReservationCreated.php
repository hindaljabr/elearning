<?php

namespace App\Mail;

use App\Model\Room;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param User $user 
     * @param Room $room 
     * @return void
     */
    public function __construct( User $user, Room $room )
    {
        $this->user = $user;
        $this->room = $room;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reservation_created')
                ->from( env('SUPPORT_EMAIL'), "Support" )
                ->subject("Reservation Pending Approval")
                ->with(['user' => $this->user, 'room' => $this->room]);
    }
}
