<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FaceTEC</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    
</head>

<body>
    <div id="app">
        <nav style="background: #57b2f8;" class="navbar navbar-expand-md navbar-light navbar-laravel position">
            <div class="container">
                <strong>
                    
                    <a style="color: white; font-size: 20px; font-family: 'Nunito', sans-serif;" class="navbar-brand" href="{{ url('/home') }}">
                    <img src="logo.png" width="30"> 
                    FACE-TEC
                    </a>
                    
                </strong>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a style="color: white; font-size: 20px;" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" v-pre>
                                <!--{{ Auth::user()->name }} <span class="caret"></span> -->
                                <img src="foto_perfil/padrao.png" width="40px" style="border: 8px solid white; border-radius: 50px; background: white;"/>
                            </a>


                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class='dropdown-item' href='/profile'>
                                    Minha conta
                                </a>

                                <a class='dropdown-item' href='/perfil_edit'>
                                    Editar Perfil
                                </a>

                                <?php 
                                if(Auth::user()->role == 0){
                                    
                                    echo "<a class='dropdown-item' href='/register'>
                                        Registrar conta
                                    </a>";
                                }
                                ?>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                                    @csrf
                                </form>


                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>




        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>