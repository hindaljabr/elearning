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

  public function getaddRoomForm($room_id = null)
  {


      if ( $room = Room::find( $room_id ) ) return redirect()->route('addRoom_form')->with('error', 'You already added this room');

      // make sure there is a room with that id //
      $room = Room::find( $room_id );

          // display the room details
          return view(
              'addRoom_form',
              [
                'room' => $room,
              ]
          );
    }

    public function postaddRoomForm()
    {
      return view(
          'addRoom_form'

      );


      // OLD: if the room does not exist, send the user back
      // RIGHT: if room exists; error + show a message
  //    if ( ! $room ) {
    //      return back()->with('error', 'Invalid room provided!')->withInput();
      //}


      // validate the submitted form
      $this->validate( $this->request, [
          'name' => 'required|name|unique',
          'description' => 'required|min:255',
          'image' => 'required|string',
          'capacity' => 'numeric'
      ]);

      // form is valid
      // get the room submitted values
      $input = $this->request->except(['_token','d']);

      // save the new reservation
      $saved = Room::create( $input );

      // check if the room was created or not
      if ( $saved ) {
          // the reservation has been created

          // return: you added the room successfully
          return redirect()->route('addroom.form')->with(
              'success', 'Room added successfully.'
          );
      } else {
          // the reservation was not created
          return back()->with('error', 'Failed to add room. Please try again later')->withInput();
      }

      }

  protected function validator(array $data)
  {
      return Validator::make($data, [
        'name' => 'required|name|unique',
        'description' => 'required|min:255',
        'image' => 'required|string',
        'capacity' => 'numeric'
      ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\User
   */
  protected function create(array $data)
  {
      return rooms::create([
          'name' => $data['name'],
          'description' => $data['description'],
          'capacity' => $data['capacity'],
          'image' => $data['image'],
      ]);
  }

  public function destroy($id)
   {
       Room::find($id)->delete();
       return redirect()->route('RoomDetails')
                       ->with('success','Room deleted successfully');
   }

   public function getManageRoom()
    {

        return redirect()->route('admin.manageRoom')
                        ->with('success','To manage Room page ');
    }


}
