<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pigeon Post') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="../sass/app.scss" rel="stylesheet">
    <!-- Styles -->
    <style>
        .navbar {
            background-color: transparent;
            overflow: hidden;
            position: fixed; /* Set the navbar to fixed position */
            top: 0; /* Position the navbar at the top of the page */
            width: 100%;
        }

        .top-nav-collapse {
            background-color: rgb(255, 255, 255);
        }

        @media only screen and (max-width: 768px) {
            .navbar {
                background-color: rgb(0, 0, 0);
            }
        }

        .main {
            margin-top: 30px; /* Add a top margin to avoid content overlay */
            }

        html, body {
                background-color:rgb(0, 0, 0);
                color: #d5dee4;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
    </style>
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-dark fixed-top">
                <a class="navbar-brand text-white mr-4" href="{{ url('/posts') }}">
                    {{ config('app.name','Pigeon Post') }}
                </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarToggle">
                <div class="navbar-nav">
                    <a class="nav-item text-white mt-1 mr-3" href="{{ url('/posts/create') }}">Share!</a>
                    <a class="nav-item text-white mt-1 mr-3" href="{{ url('/global') }}">Global</a>
                    <a class="nav-item text-white mt-1 mr-3" href="{{ url('/posts') }}">Personal</a>

                </div>


                <!-- Navbar Right Side -->

                <div class="navbar-nav ml-auto mt-1">
                    <form class="nav-item  form-inline d-flex justify-content-center md-form form-sm mt-0" action="/search" role="search" method="POST">
                        {{ csrf_field() }}
                        <input class="form-control bg-transparent form-control-sm mr-4 w-100" type="text" placeholder="Search Users"
                          aria-label="Search" name="q">
                    </form>
                    @if (Auth::guest())
                        <a class="nav-item text-white mt-1 mr-2" href="{{ url('/login') }}">Login</a>
                        <a class="nav-item text-white mt-1" href="{{ url('/register') }}">Register</a>
                    @else
                    <a class="nav-item text-white mt-1 mr-3" href="{{ url('/users', Auth::user()->id) }}">Profile</a>
                        <a class="text-white mt-1" href="{{ url('/logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @endif
                  </div>
                </div>
            </div>
          </nav>

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @include ('layouts.partials._notifications')
                </div>
            </div>
        </div>

        <div class="container">
            @yield('content')
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>
