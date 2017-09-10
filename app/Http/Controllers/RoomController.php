<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Room;
use Illuminate\Support\Facades\Auth;

use Exception;

class RoomController extends Controller
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
 * Display the room details for a room
 *
 *
 * @access public
 * @param integer $room_id the room id
 * @return Response
 */
public function getRoomDetails( $room_id = null )
{
    if ( empty( $room_id ) ) return redirect()->route('rooms.list')->with('error', 'Incomplete Request!');

    // make sure there is a room with that id
    $room = Room::find( $room_id );

        // display the room details
        return view(
            'RoomDetails',
            [
              'room' => $room,
            ]
        );
  }
}
