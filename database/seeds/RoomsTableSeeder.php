<?php

use App\Model\Room;
use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = [
        	[
        		'name' => 'Room Awesome', 'description' => 'This room is the awesomest room we have', 
        		'status' => Room::AVAILABLE 
        	],
        	[
	        	'name' => 'Presidential Treat Awesome', 'description' => 'This room has all the things you can desire', 
	        	'status' => Room::AVAILABLE 
	        ]
        ];

        $roomModel = new Room;
        foreach ( $rooms as $room ) {
        	$roomModel->create( $room );
        }
    }
}
