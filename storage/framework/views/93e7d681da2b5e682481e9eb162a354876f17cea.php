<!DOCTYPE html>
<html>
  <head
    <meta charset="utf-8">
    <title>RoomDetails</title>

    <style >

    .Moreinfo{
        float:left;
        position:relative;

        margin-right:12em;

    }

    .mainPic  { float: right;
          margin-left: 2em;
          margin-top: 2em; }

          .img-circle {
    border-radius: 60%;
}

    </style>

  </head>


  <body>

    <img class="img-circle" src="C:\xampp\htdocs\Elearning_O\resources\views\Photo\Room1.jpg" alt="Room1" width="300" height="200" frameborder="0" style="border:0" allowfullscreen>
    <div >
<?php

<h1>Hello</h1>
//@foreach($room as $room1)
<h3>Details for {{$room->'room_name'}}</h3>

          <div>{{$room->['Image']}}
              {{$room->['Capacity']}}
              {{$room->['Room_describtion']}}
          </div>
//  @endforeach
 ?>

    <div>
      <button style = "border-style: solid; background-color: white; left: -5em;"type="button" onclick="alert('Loading')">Reserve!

    </div>
  </body>
</html>
