<?php

namespace App\Http\Controllers;

use App\Mail\ReservationCreated;
use App\Model\Reservation;
use App\Model\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Exception;

class ReservationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param Request $request
     * @return void
     */
    public function __construct( Request $request )
    {
        $this->middleware('auth');

        $this->request = $request;
    }

    /**
     * Display the listing of the rooms in the system
     *
     * @access public
     * @return Response
     */
    public function getRooms()
    {
    	// get all the rooms we have in the database
    	$allrooms = Room::where('status', Room::AVAILABLE)->paginate( 9 );

    	return view('rooms', ['allrooms' => $allrooms]);
    }

    /**
     * Display the reservation form for a room
     *
     *
     * @access public
     * @param integer $room_id the room id
     * @return Response
     */
    public function getReservationForm( $room_id = null )
    {
        if ( empty( $room_id ) ) return redirect()->route('rooms.list')->with('error', 'Incomplete Request!');

        // make sure there is a room with that id
        $room = Room::find( $room_id );

        // check the room status
        if ( $room ) {
            $booked_hours = [];
            // if we have the selected data passed to us, we will get the available hours for the room
            // in question. This will happen when the user choose a date with the datepicker widget
            if ( $this->request->has('d') AND ! empty( $this->request->d ) ) {
                // let's get the hours booked for the room in question on the date in
                // question
                $booked_hours = ( new Reservation )->getBookedHours( $room_id, $this->request->d );
            }

            // display the reservation form
            return view(
                'reservation_form',
                [
                    'room' => $room, 'booked_hours' => $booked_hours,
                    'hours_range' => range( 8, 23 )
                ]
            );
        } else return redirect()->route('rooms.list')->with('error', 'Invalid room supplied!');
    }

    /**
     * Save the submitted reservation form and also alert the user with an email
     *
     * @access public
     * @param integer $room_id the id of the room
     * @return Response
     */
    public function postReservationForm( $room_id = null )
    {
        if ( empty( $room_id ) ) return redirect()->route('rooms.list')->with('error', 'Incomplete Request!');

        // make sure there is a room with that id
        $room = Room::find( $room_id );

        // if the room does not exist, send the user back
        if ( ! $room ) {
            return back()->with('error', 'Invalid room provided!')->withInput();
        }

        // validate the submitted form
        $this->validate( $this->request, [
            'date' => 'required|date',
            'hours.*' => 'required|numeric',
            'description' => 'required',
            'notes' => 'required'
        ]);

        // form is valid
        // get the user submitted values
        $input = $this->request->except(['_token','d']);

        // turn the selected hours into the required string format
        // we will use to store it i.e. turning the selected hours into
        // a comma separated string
        $hours = implode(',', $input['hours']);

        // if the hours array is empty, bail
        if ( empty( $hours ) ) {
            return back()->with('error', 'Please select reservation hour(s)')->withInput();
        }

        // overwrite the hours array in the input with the string format we now have
        $input['hours'] = $hours;
        // add the pending status
        $input['status'] = Reservation::PENDING;
        // add the room id
        $input['room_id'] = $room_id;
        // add the user id
        // get the current user
        $user = Auth::user();
        $input['user_id'] = $user->id;

        // save the new reservation
        $saved = Reservation::create( $input );

        // check if the reservation was created or not
        if ( $saved ) {
            // the reservation has been created
            // send an email to the user
            $user->name = $user->firstname." ".$user->lastname;

            try {
                // wrap the email sending in a try..catch block since a lot can go
                // wrong when sending an email
                Mail::to( $user )->send(
                    new ReservationCreated( $user, $room )
                );

                // the email has been sent...
                // we can sent the user back
                return redirect()->route('rooms.list')->with(
                    'success', 'Your reservation has been saved. Kindly await approval'
                );
            } catch ( Exception $e ) {
                info( $e );
                // the email was not sent for some reasons
                // we can just send the user back like we are all good since the reservation
                // has been created already
                return redirect()->route('rooms.list')->with(
                    'success', 'Your reservation has been saved. Kindly await approval'
                );
            }
        } else {
            // the reservation was not created
            return back()->with('error', 'Failed to create your reservation. Please try again later')->withInput();
        }
    }

}
