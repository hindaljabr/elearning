@php
	$pageTitle = "Rooms";
@endphp

@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="col-md-12">
			<h1 class="text-center"><strong>Rooms</strong></h1>
			<br />
		</div>
	</div>

	<div class="w3-content w3-display-container" style="max-width:600px">
	 <img class="mySlides" src="C:\xampp\htdocs\reservations\resources\views\Photo\Room1.jpg" style="width:100%">
	 <img class="mySlides" src="C:\xampp\htdocs\reservations\resources\views\Photo\Room2.jpg" style="width:100%">
	 <img class="mySlides" src="C:\xampp\htdocs\reservations\resources\views\Photo\Room3.jpg" style="width:100%">
	 <img class="mySlides" src="C:\xampp\htdocs\reservations\resources\views\Photo\Room4.jpg" style="width:100%">
	 <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
		 <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
		 <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
		 <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
		 <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
		 <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span>
			<span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(4)"></span>
	 </div>
	</div>

	<div class="row">
	    <div class="col-md-12">
	       @if( $allrooms->count() )
	       		{{-- we have the rooms let display them 3 on each row --}}
	       		@foreach( $allrooms->chunk( 3 ) as $chunk )
	       			<div class="row">
	       				{{-- now display the current 3 that we have --}}
	       				@foreach ( $chunk as $room )
	       					<div class="col-lg-4">
	       						<div class="panel panel-info">
	       							<div class="panel-body">
	       								<h2 class="text-center"><strong>{{ $room->name }}</strong></h2>
	       								<hr />
	       								<p>{{ str_limit($room->description, 100 ) }}</p>
	       							</div>
	       							<div class="panel-footer">
	       								<div class="row">
	       									{{-- <div class="col-lg-6">
	       										<a href="" class="btn btn-default btn-block">Details</a>
	       									</div> --}}
	       									<div class="col-lg-6">
	       										<a href="{{ route('reservation.form', ['room_id' => $room->id]) }}" class="btn btn-primary btn-block">
	       											Reserve
	       										</a>
														<a href="{{ route('roomdetails', ['room_id' => $room->id]) }}" class="btn btn-primary btn-block">
	       											Details
	       										</a>
	       									</div>
	       								</div>
	       							</div>
	       						</div>
	       					</div>
	       				@endforeach
	       			</div>
	       		@endforeach

	       		<div class="text-center">{{ $allrooms->links() }}</div>
	       @else
	       		<div class="panel panel-danger">
	       			<div class="panel-body">
	       				<div class="text-center text-danger">
	       					No record to display
	       				</div>
	       			</div>
	       		</div>
	       @endif
	    </div>
	</div>
@endsection
