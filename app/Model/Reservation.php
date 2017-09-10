<?php

namespace App\Model;

use App\Model\Room;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
	// constants for marking reservation statu
	const APPROVED = "APPROVED";
	const PENDING = "PENDING";
	const REJECTED = "REJECTED";

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be cast to date
     *
     * @var array 
     */
    protected $dates = [
        'date', 'created_at', 'updated_at'
    ];

    /**
     * A reservation belongs to a room
     *
     * @access public
     */
    public function room()
    {
        return $this->belongsTo( Room::class, 'room_id', 'id' );
    }

    /**
     * A reservation belongs to a user
     *
     * @access public
     */
    public function user()
    {
        return $this->belongsTo( User::class, 'user_id', 'id' );
    }

    /**
     * Get the hours that have been booked for a room on a date
     *
     * @access public
     * @param integer $room_id the id of the room in question
     * @param string $date the date we are checking for
     * @return array 
     */
    public function getBookedHours( $room_id = null, $date = null )
    {
        // get all the approved reservations for the room on the given date
        $reservations = self::where('status', self::APPROVED)->where('room_id', $room_id)->whereDate('date', $date)->get(['id', 'hours']);

        // now split the reserved hours into an array that we can use
        $booked_hours = [];
        foreach ( $reservations as $r ) {
            // if the user reserved more than one hour, we store it in a comma separated string 
            // format e.g if the user reserved hour 4,5,6 we will store it exactly like that 
            // comma separated
            // so to separate the hours, we will explode the string into an array
            $hours = explode( ',', $r->hours );

            // now add each of this hours to the booked_hours array
            foreach ( $hours as $hour ) {
                if ( ! empty( $hour ) ) {
                    $booked_hours[] = trim( $hour );
                }
            }
        }

        // we have the reserved hours. let's return them to the calling script
        return $booked_hours;
    }
}