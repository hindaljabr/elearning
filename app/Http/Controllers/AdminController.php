<?php

namespace App\Http\Controllers;

use App\Mail\ReservationApproved;
use App\Model\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Exception;

class AdminController extends Controller
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
        $this->middleware('admin');

        $this->request = $request;
    }

    /**
     * Display the page for the admin to see all the reservations we have on file
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

    	return view('admin.manage', ['reservations' => $reservations]);
    }

    /**
     * Approve a reservation
     *
     * @access public
     * @param integer $reservation_id the id of the reservation to approve
     * @return Response 
     */
    public function getApproveReservation( $reservation_id = null )
    {
    	if ( empty( $reservation_id ) ) return redirect()->route('admin.manage')->with('error', 'Incomplete Request!');

    	// get the reservation we want to approve
    	$reservation = Reservation::with('user','room')->where('status', Reservation::PENDING)
    					->where('id', $reservation_id)->first();

    	// make sure we have the reservation
    	if ( $reservation ) {
    		// we have the reservation
    		// do the approval
    		$reservation->status = Reservation::APPROVED;
    		// save the update
    		$saved = $reservation->save();

    		// check if the save was okay or not
    		if ( $saved ) {
    			// the reservation has been marked as approved 
    			// we should send the mail to the user
    			$reservation->user->name = $reservation->user->firstname." ".$reservation->user->lastname;
    			try {
    				Mail::to( $reservation->user )->send(
    				    new ReservationApproved( $reservation->user, $reservation->room )
    				);

    				// we are done here...send the admin back with the success message
    				return redirect()->route('admin.manage')->with('success', 'Reservation approved!');
    			} catch ( Exception $e ) {
    				// there was an exception
    				info( $e );

    				// send the user back with the success message all the same
    				return redirect()->route('admin.manage')->with('success', 'Reservation approved!');
    			}
    		} else {
    			// send the user back with error
    			return redirect()->route('admin.manage')->with('error', 'Failed to approve the reservation');
    		}
    	} else {
    		// we do not have the reservation
    		// send the user back with error
    		return redirect()->route('admin.manage')->with('error', 'Reservation not found!');
    	}
    }

    /**
     * Reject a reservation 
     *
     * @access public
     * @param integer $reservation_id the id of the reservation we want to reject
     * @return Response 
     */
    public function getRejectReservation( $reservation_id = null )
    {
    	if ( empty( $reservation_id ) ) return redirect()->route('admin.manage')->with('error', 'Incomplete Request!');

    	// get the reservation we want to reject
    	$reservation = Reservation::with('user','room')->where('status', Reservation::PENDING)
    					->where('id', $reservation_id)->first();

    	// make sure we have the reservation
    	if ( $reservation ) {
    		// we have the reservation
    		// do the rejection
    		$reservation->status = Reservation::REJECTED;
    		// save the update
    		$saved = $reservation->save();

    		// check if the save was okay or not
    		if ( $saved ) {
    			// the reservation has been as rejected
    			return redirect()->route('admin.manage')->with('success', 'Reservation rejected');
    		} else {
    			// send the user back with error
    			return redirect()->route('admin.manage')->with('error', 'Failed to approve the reservation');
    		}
    	} else {
    		// we do not have the reservation
    		// send the user back with error
    		return redirect()->route('admin.manage')->with('error', 'Reservation not found!');
    	}
    }

}
