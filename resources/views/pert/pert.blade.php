<!DOCTYPE html>
    <html lang="fr">
    <head>

        <title>CDP</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <style>
            body {
                font: 12px Montserrat;
                line-height: 1.8;
            }
            p {font-size: 12px;}
            .margin {margin-bottom: 45px;}

            .container-fluid {
                padding-top: 1px;
                padding-bottom: 1px;
            }
            .navbar {
                padding-top: 15px;
                padding-bottom: 15px;
                border: 0;
                border-radius: 0;
                margin-bottom: 0;
                font-size: 12px;

            }
            .navbar-nav  li a:hover {
                color: #1abc9c !important;
            }
        </style>

        <link rel="stylesheet" href="{{ URL::asset('D3/app/styles/main.css') }}">
    </head>
    <body>

    <!-- Navbar -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ url("home") }}">Your Environment GL</a>
            </div>
            <div>
                <ul class="nav navbar-nav">
                    @if(!auth()->guest())
                        <li><a href="{{ url('project/list') }}">Project List</a></li>
                        <li><a href="{{ url('project/new') }}">Create a Project</a></li>
                    @endif
                </ul>
                <ul class="nav navbar-nav navbar-right">

                    @if(auth()->guest())
                        @if(!Request::is('auth/login'))
                            <li><a href="{{ url('/auth/login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>

                        @endif
                        @if(!Request::is('auth/register'))
                            <li><a href="{{ url('/auth/register') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        @endif
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ auth()->User()->FirstName }} {{ auth()->User()->FamilyName }}<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </nav>

    <!-- First Container -->

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-body">
                <!--[if lt IE 10]>
                <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
                <![endif]-->

                <p> <span id="dag-name"></span></p>
                <div id="dag">
                    <svg height="450" width="100%">
                        <g transform="translate(20, 20)"/>
                    </svg>
                </div>

                <!-- build:js scripts/vendor.js -->
                <script src="{{ URL::asset('D3/app/scripts/vendor/jquery-1.10.2.js') }}"></script>
                <script src="{{ URL::asset('D3/app/scripts/vendor/d3.v3.js') }}"></script>
                <script src="{{ URL::asset('D3/app/scripts/vendor/dagre-d3.js') }}"></script>
                <!-- endbuild -->

                <!-- build:js scripts/main.js -->
                <script src="{{ URL::asset('D3/app/scripts/main.js') }}"></script>
                <!-- endbuild -->
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div id="footer">
        <div class="container" >
            <p >University of Bordeaux 2015</p>
        </div>
    </div>

    </body>
    </html>