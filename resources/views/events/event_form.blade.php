@php
	$pageTitle = "Event From";
@endphp

@extends('layouts.app')

@section('content')


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <link rel="stylesheet" href="/resources/demos/style.css">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script>
      $( function() {
        $( "#datepicker" ).datepicker({
          changeMonth: true,
          changeYear: true,
          dateFormat:'yy-m-d'
        });
      } );
      </script>

  </head>
  <body>


    <div class="eventform">
      <div id="forminsurttext">
    <form name="eventstore" method="post" enctype="multipart/form-data" action="{{ url('EventsForm') }}">
      {{csrf_field()}}
  <div>  Event Name: <br> <input type="text" name="Event_name"></div>
  <div>  Presenter Name: <br> <input type="text" name="Event_presenter"></div>
  <div>  Date of Event: <br>   <input id="datepicker" name="Event_date" type="text" placeholder="Choose a date"> </div>
  <div>  Time of Event: <br> <select name="Event_time">
  <option value="08:00:00">08:00 AM</option>
  <option value="09:00:00">09:00 AM</option>
  <option value="10:00:00">10:00 AM</option>
  <option value="11:00:00">11:00 AM</option>
  <option value="12:00:00">12:00 PM</option>
  <option value="13:00:00">01:00 PM</option>
  <option value="14:00:00">02:00 PM</option>
  <option value="15:00:00">03:00 PM</option>
  <option value="16:00:00">04:00 PM</option>
  <option value="17:00:00">05:00 PM</option>
  <option value="18:00:00">06:00 PM</option>
  <option value="19:00:00">07:00 PM</option>
  <option value="20:00:00">08:00 PM</option>
  <option value="21:00:00">09:00 PM</option>
  <option value="22:00:00">10:00 PM</option>
  <option value="23:00:00">11:00 PM</option>
  <option value="00:00:00">12:00 AM</option>
</select> </div>
  <div>
    Event Catgory: <br>
     <select name="Catgory_ID">
       @foreach($EventCatg as $theEventCatg)
    <option value="{{ $theEventCatg -> Category_ID }}">{{ $theEventCatg -> Category_name }}</option>
    @endforeach
  </select>
</div>
  <div>  Event Description: 	<br> <textarea class="input" name="Event_description" rows="7" cols="30"></textarea><br /> </div>
  </div>
    <!-- uploading image to represent the event and insert it in the database -->
    <div id="imgeupload" >
      		<div>
      			Image Represent The Event <input type="file" name="Event_photo">

<!--      			<button type="submit" name="upload">Upload</button> -->
      		</div>

    </div>
    <div id="submitbutton" >
          <input type="submit" name="submit" value="Submit">
        </div>
  </div>   	</form>

  <div>
@foreach ($errors->all() as $error)
{{$error}} <br>
@endforeach

  </div>
@endsection
