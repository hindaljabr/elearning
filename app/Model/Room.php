<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
	// constants for identifying room statu
	const AVAILABLE = "AVAILABLE";
	const BOOKED = "BOOKED";
	
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];
}
