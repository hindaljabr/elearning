@php
	use Carbon\Carbon;

	$pageTitle = "Room Details";

	$carbonInst = new Carbon;
@endphp

@extends('layouts.app')

@section('content')


    <img class="img-circle" src="C:\xampp\htdocs\reservations\resources\views\Photo\Room1.jpg" alt="Room1" width="300" height="200" frameborder="0" style="border:0" allowfullscreen>
    <div >


<h1>Hello</h1>
<h3>Details for {{$room->name}}</h3>

          <div>
              {{$room->Image}}
              {{$room->Capacity}}
              {{$room->description}}
          </div>


    <div>
      <button style = "border-style: solid; background-color: white; left: -5em;"type="button" onclick="alert('Loading')">Reserve!

    </div>

@endsection
