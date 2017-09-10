<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>
        <?php echo e(! empty( $pageTitle ) ? $pageTitle.' | ' : ''); ?> <?php echo e(config('app.name')); ?>

    </title>

    <link href="<?php echo e(asset('js/jquery-ui/themes/smoothness/jquery-ui.min.css')); ?>" rel="stylesheet">
    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
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
                    <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                        <?php echo e(config('app.name', 'Laravel')); ?>

                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo e(route('rooms.list')); ?>">Rooms</a></li>
                        <?php if( Auth::check() && Auth::user()->type == App\User::ADMIN ): ?>
                            <li><a href="<?php echo e(route('admin.manage')); ?>">Admin Dashboard</a></li>
                        <?php endif; ?>
                        <?php if( Auth::check() && Auth::user()->type == App\User::USER ): ?>
                            <li><a href="<?php echo e(route('user.manage')); ?>">My Reservations</a></li>
                        <?php endif; ?>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <?php if(Auth::guest()): ?>
                            <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
                            <li><a href="<?php echo e(route('register')); ?>">Register</a></li>
                        <?php else: ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <?php echo e(Auth::user()->firstname.' '.Auth::user()->lastname); ?> <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="<?php echo e(route('logout')); ?>"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                            <?php echo e(csrf_field()); ?>

                                        </form>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container" style="padding-top: 60px;">
            <?php echo $__env->make('includes.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery-ui/jquery-ui.min.js')); ?>"></script>
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
