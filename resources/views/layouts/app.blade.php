<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <!-- Icon -->
    <link rel="icon" type="image/png" href="{{asset('image/army.png')}}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{asset('image/army.png')}}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{asset('image/army.png')}}" sizes="96x96">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        .navbar-light .navbar-brand {
            color: #ffffff !important;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #ffffff !important;
        }
        
        a {
            color: #4b5320 !important;
        }

        .btn-secondary {
            background-color: #4b5320 !important;
        }

        .btn-success {
            background-color: #fdfdfd !important;
        }

        .decorate {
            text-decoration: none !important;
        }

        .inline {
            display: -webkit-inline-box !important;
        }

        .navbar-expand-md .navbar-collapse {
            width: inherit;
        }

        .btn-primary {
            background-color: #4b5320 !important;
            border-color: #6c757d !important;
            color: white !important;
        }

        .btn-info {
            background-color: transparent !important;
            border-color: transparent !important;
            color: #4b5320 !important;
        }

        select {
            font-family: 'FontAwesome', 'Second Font name'
        }

        input {
            font-family: 'FontAwesome', 'Second Font name'
        }
    </style>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <!-- toastr -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" 
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- end toast -->
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="background-color:#4b5320 !important;">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('image/army.png') }}" alt="Nigerian Army" style="width:18%">
                    Nigerian Army
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            <!-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
                        @else
                        @hasrole('Admin')
                            <li><a class="nav-link mx-2 btn btn-secondary {{ (request()->is('users')) ? 'btn btn-secondary-outline' : 'text-white' }}" href="{{ route('users.index') }}">Manage Users</a></li>
                            <li><a class="nav-link mx-2 btn btn-secondary {{ (request()->is('roles')) ? 'btn btn-secondary-outline' : 'text-white' }}" href="{{ route('roles.index') }}">Manage Role</a></li>
                        @endhasrole
                        @hasrole('User')
                            <li><a href="/" class="nav-link mx-2 btn btn-secondary {{ (request()->is('/')) ? 'btn btn-secondary-outline' : 'text-white' }}">Add Document</a></li>
                            <li><a class="nav-link mx-2 btn btn-secondary {{ (request()->is('files')) ? 'btn btn-secondary-outline' : 'text-white' }}" href="/files">Archive</a></li>
                            <!-- <li><a href="/type" class="nav-link {{ (request()->is('type')) ? 'text-secondary' : 'text-white' }}">Sort by File Type</a></li>
                            <li><a href="/date" class="nav-link {{ (request()->is('date')) ? 'text-secondary' : 'text-white' }}">Sort by Date</a></li> -->
                            <form class="col-12 col-lg-auto inline mb-10 mb-lg-8 mx-5 me-lg-10 px-2" style="width: 300px; height: 40px;" action="/search" method="post">
                                @csrf
                                <input type="search" class="form-control form-control-dark" name="q" placeholder="Search by responsible person, class, date, keyword, description and so on..." aria-label="Search">
                                <button class="btn btn-primary mt-1" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        @endhasrole
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Folder</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/folder" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm">
                                        <label for="name">Folder name</label>
                                        <input type="text" name="name" placeholder="Enter name" class="form-control" required>
                                    </div>
                                    <!-- <div class="col-sm">
                                        <label for="pin">Lock folder</label>
                                        <input type="number" class="form-control" placeholder="Enter 4 digit pin" name="pin" 
                                            maxlength="4" pattern="^0[1-9]|[1-9]\d$" onkeypress="return isNumeric(event)" 
                                            oninput="maxLengthCheck(this)">
                                    </div> -->
                                    <script>
                                        function maxLengthCheck(object) {
                                            if (object.value.length > object.maxLength)
                                            object.value = object.value.slice(0, object.maxLength)
                                        }
                                            
                                        function isNumeric (evt) {
                                            var theEvent = evt || window.event;
                                            var key = theEvent.keyCode || theEvent.which;
                                            key = String.fromCharCode (key);
                                            var regex = /[0-9]|\./;
                                            if ( !regex.test(key) ) {
                                            theEvent.returnValue = false;
                                            if(theEvent.preventDefault) theEvent.preventDefault();
                                            }
                                        }
                                    </script>
                                </div>
                                <div class="row">
                                    <div class="col-sm my-3">
                                        <button class="form-control btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')
        </main>
    </div>

    <!-- pop up -->
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    <script>
        @if(Session::has('success'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
                toastr.success("{{ session('success') }}");
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.options =
                {
                "closeButton" : true,
                "progressBar" : true
                }
                    toastr.error("{{$error}}");
            @endforeach
        @endif
        @if(Session::has('info'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
                toastr.info("{{ session('info') }}");
        @endif
        @if(Session::has('warning'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.warning("{{ session('warning') }}");
        @endif
    </script>
</body>
</html>
