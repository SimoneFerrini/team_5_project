<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BoolBnB - backend</title>

    {{-- favicon --}}
    <link rel="shortcut icon" sizes="114x114" href="{{ asset('/favicon-bool.png') }}">

    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->
        
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;1,400&display=swap" rel="stylesheet">

    {{-- script che stiamo usando per la visibility --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav id="my_navbar" class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <img id="logo_img" class="px-2" src="{{asset('images/logo-bool.png')}}" alt="logo">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            {{-- l'url del localhost può essere 5173 o 5174 in base a cosa si avvia prima se front o back end. 
                            se si avbvia prima il back end l'url deve essere cambiato necessariamente in 5174 altrimenti premendo il tasto home del back end ti
                            riporta ad una pagina base di laravel + vite --}}
                            <a class="nav-link" href="http://localhost:5173/">Home</a>
                        </li>    
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/houses') }}">{{ __('Dashboard') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                        </li>
                        @endif
                        @else
                        <li id="my_drop" class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('profile') }}">{{__('Profilo')}}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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

        <main class="">
            @yield('content')
        </main>
    </div>
    <footer id="footer_back">
        <div id="footer">
            <!-- sinistra -->
            <div class="links">
                <ul class="pt-4">
                <li><a href="#">Lavora con noi</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contatti</a></li>
                <li><a href="#">Termini&Servizi</a></li>
                </ul>
            </div>
            <!-- /sinistra -->
            
            <!-- destra -->

            <div class="footer_right">
                {{-- <img class="long_logo" src="{{asset('images/logochiaro.png')}}" alt="logo"> --}}
                <img class="short_logo" src="{{asset('images/logo-bool.png')}}" alt="logo">

            </div>
            <!-- /destra -->
        </div>
         
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
