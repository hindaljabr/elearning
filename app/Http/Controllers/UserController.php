<?php

namespace App\Http\Controllers;

use App\Mail\ReservationApproved;
use App\Model\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Exception;

class UserController extends Controller
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
        $this->middleware('user');

        $this->request = $request;
    }

    /**
     * Display the page for the user to see all the reservations we have on file
     *
     * @access public
     * @return Response
     */
    public function getManageReservation()
    {
    	// get all the reservations we have on file together with the user who made the reservation and the
    	// room the reservation was made for
    	$query = Reservation::with('room','user')->orderBy('created_at', 'DESC');

        if ( $this->request->has('status') AND ! empty( $this->request->status ) ) {
            $query->where('status', $this->request->status);
        }

        $reservations = $query->paginate( 20 );

    	return view('user.manage', ['reservations' => $reservations]);
    }

    /**
     * Cancel a reservation
     *
     * @access public
     * @param integer $reservation_id the id of the reservation to edit
     * @return Response
     */
    public function getApproveReservation( $reservation_id = null )
    {
    	if ( empty( $reservation_id ) ) return redirect()->route('user.manage')->with('error', 'Incomplete Request!');

    	// get the reservation we want to cancel
    	$reservation = Reservation::with('user','room')->where('status', Reservation::PENDING)
    					->where('id', $reservation_id)->first();

    	// make sure we have the reservation
    	if ( $reservation ) {
    		// we have the reservation
    		// do the cancellation
    		$reservation->status = Reservation::CANCELLED;
    		// save the update
    		$saved = $reservation->save();

    		// check if the save was okay or not
    		if ( $saved ) {
    			// the reservation has been marked as CANCELLED
    			// we should send the mail to the user
    			$reservation->user->name = $reservation->user->firstname." ".$reservation->user->lastname;
    			try {
    				Mail::to( $reservation->user )->send(
    				    new ReservationCancelled( $reservation->user, $reservation->room )
    				);

    				// we are done here...send the user back with the success message
    				return redirect()->route('user.manage')->with('success', 'Reservation canceled!');
    			} catch ( Exception $e ) {
    				// there was an exception
    				info( $e );

    				// send the user back with the success message all the same
    				return redirect()->route('user.manage')->with('success', 'Reservation cancelled!');
    			}
    		} else {
    			// send the user back with error
    			return redirect()->route('user.manage')->with('error', 'Failed to cancel the reservation');
    		}
    	} else {
    		// we do not have the reservation
    		// send the user back with error
    		return redirect()->route('user.manage')->with('error', 'Reservation not found!');
    	}
    }

}
