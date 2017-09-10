@php
	$pageTitle = "Events";
@endphp

@extends('layouts.app')

@section('content')

<table class="EventsDisplay" style="width:20% ; border:4px solid #ccc">
  <thread>
    <tr>
      <th> Event ID </th>
      <th> Event Name </th>
      <th> Event Presenter </th>
      <th> Event Date </th>
      <th> Event Time </th>
      <th> Event Description </th>
      <th> Event Photo </th>
      <th> Event Attandes </th>
      <th> Event Catgory </th>
      <th> More </th>

    </tr>
  </thread>

    @foreach($EventInfo as $TheEvent)
    <tr>
<th style="width:5%; text-align:left">{{ $TheEvent -> Event_ID }} </th>
<th style="width:5%; text-align:left">{{ $TheEvent -> Event_name }}</th>
<th style="width:5%; text-align:left">{{ $TheEvent -> Event_presenter }}</th>
<th style="width:5%; text-align:left">{{ $TheEvent -> Event_date }}</th>
<th style="width:5%; text-align:left">{{ $TheEvent -> Event_time }}</th>
<th style="width:5%; text-align:left">{{ $TheEvent -> Event_description }}</th>
<th style="width:5%; text-align:left">  <image src="Upload/{{ $TheEvent -> Event_photo }}"> </th>
<th style="width:5%; text-align:left">{{ $TheEvent -> Event_attendees }}</th>
<th style="width:5%; text-align:left">{{ $TheEvent -> Catgory_ID }}</th>
<!-- <th style="width:5%; text-align:left"> <a href="{{route('Events', ['Event_ID' => 'View Event Detials'])}}">View Event Detials</a></th>-->
</tr>
    @endforeach
</table>
@endsection
