@php
	use Carbon\Carbon;

	$pageTitle = "Room Details";

	$carbonInst = new Carbon;
@endphp

@extends('layouts.app')

@section('content')


<h3>Details for {{$room->name}}</h3>

          <div>
        <h5> <img src="{{ $room -> Image }}"> </h5>
        <h5> Room Capacity: {{$room-> Capacity}}</h5> <br>
        <h5> Room description:{{$room-> description}}</h5><br>
          </div>
    <div>
			<div class="col-lg-6">
				<a href="{{ route('reservation.form', ['room_id' => $room->id]) }}" class="btn btn-primary btn-block">
					Reserve
				</a>
    </div>
		

@endsection


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<img  src="C:\xampp\htdocs\reservations\resources\views\Photo\Room1.jpg" alt="Room1" width="300" height="200" >


	</body>
</html>
