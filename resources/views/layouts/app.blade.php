<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ ! empty( $pageTitle ) ? $pageTitle.' | ' : '' }} {{ config('app.name') }}
    </title>

    <link href="{{ asset('js/jquery-ui/themes/smoothness/jquery-ui.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">

        .__disabled {
          cursor: not-allowed;
          filter: alpha(opacity=65);
          -webkit-box-shadow: none;
                  box-shadow: none;
          opacity: .65;
          pointer-events: none;
        }

        .bolder {
            font-weight: bolder !important;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('rooms.list') }}">Rooms</a></li>
                        @if( Auth::check() && Auth::user()->type == App\User::ADMIN )
                            <li><a href="{{ route('admin.manage') }}">Manage Reservation</a></li>
                        @endif
                        @if( Auth::check() && Auth::user()->type == App\User::ADMIN )
                            <li><a href="{{ route('admin.manage') }}">Manage Room</a></li>
                        @endif

                        @if( Auth::check() && Auth::user()->type == App\User::USER )
                            <li><a href="{{ route('user.manage') }}">My Reservations</a></li>
                        @endif
                        <li><a href="Story.php">About</a></li>
                        <li><a href="RoomsReservation.php">Services</a></li>
                        <li><a href="Categories.php">Hosted events</a></li>
                        <li><a href="Contact.php">Contact Us</a></li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->firstname.' '.Auth::user()->lastname }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
  <nav class="navbar navbar-default navbar-fixed-bottom">
  <!--  <footer >
<div style="position: fixed;" >

</div>
    <ul>
      <li>About</li>
      <li><a  href=Story.php >Story</a></li>
      <li><a  href=WhyYouNeedUs.php>Why you need us</a></li>
      <li><a href=WhyWeNeedYou.php>Why we need you</a></li>
    </ul>

    <ul>
      <li>Services</li>
      <li><a  href=CoursesDevelopment.php>Courses development</a></li>
      <li><a  href=EducationalSolutions.php>Educational solutions</a></li>
      <li><a href=RoomsReservation.php>Rooms reservation</a></li>
    </ul>

    <ul>
      <li>Hosted events</li>
      <li><a  href=Calender.php>Calender</a></li>
      <li><a  href=Categories.php>Categories</a></li>
      <li><a href=UpcomingEvents.php>Upcoming events</a></li>
    </ul>

    <ul>
      <li>Contact Us</li>
      <li><a href=Map.php >Map </a></li>
      <li><a href=Contact.php >Contact</a></li>
    </ul>
</div>
<div class="bottom">
  <h5>Have a question? Email us at <a href="mailto:example@example.com">af.gh@hotmail.com</a></h5>
  <h6>Copyright 2017, All Rights Reserved </h6>
</div >

  </div>
</footer>-->
        </nav>

        <div class="container" style="padding-top: 60px;">
            @include('includes.flash')

            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript">
        window.lastSelected = null

        // date picker from now to five years
        $(".datepicker").datepicker({
            dateFormat : 'yy-mm-dd',
            changeMonth : true,
            changeYear : true,
            showAnim : "slideDown",
            yearRange: "c:c+5",
            // showButtonPanel: true
        });

        // when the user chooses a date, load the available hours for that date
        function getAvailableHours( date ) {
            if ( window.lastSelected != date ) {
                // we have a new date selected let work with it
                // just reload the page with the selected date
                window.location.search = 'd='+date

                // TODO: set the lastSelected when we are done
                window.lastSelected = date
            }
        }
    </script>
</body>
</html>
