<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .navbar-custom {
            background-color: #a70606;  
            transition: background-color 0.3s ease;
        }

        .navbar-custom:hover {
            background-color: #8b0505; /* Color más oscuro al pasar el mouse */
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: #ffffff !important;
        }

        .nav-link {
            color: #ffffff !important;
        }

        .nav-link:hover {
            color: #ffcccc !important;
        }

        .dropdown-menu {
            background-color: #ecf0f1;
        }

        .dropdown-item {
            color: #2c3e50;
        }

        .dropdown-item:hover {
            background-color: #dcdcdc;
        }

        .user-icon {
            margin-right: 3px;
        }



        
        .search-container {
            width: 100%;
            margin: 20px 0;
        }
        .tab-content {
            margin-top: 20px;
        }
        .tab-pane {
            display: none;
        }
        .tab-pane.active {
            display: block;
        }
        .btn-search {
            width: 100%;
        }

    </style>
</head>
<body>
    <div id="app">
        <header>
            <nav class="navbar navbar-expand-md navbar-light navbar-custom shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('uatfpostgrado-0c98a2f6.WEBP') }}" alt="Logo" style="height: 70px;">
                    </a>
                    <a class="navbar-brand" href="#">Biblioteca Virtual</a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-md-0">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">
                                    <i class="fas fa-home"></i> Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="archivos-link" class="nav-link" href="{{ route('archivos') }}">
                                    <i class="fas fa-file-alt"></i> Archivos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-star"></i> Destacados
                                </a>
                            </li>
                        </ul>

                        <ul class="navbar-nav ms-auto">
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">
                                            <i class="fas fa-sign-in-alt"></i> {{ __('Login') }}
                                        </a>
                                    </li>
                                @endif
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">
                                            <i class="fas fa-user-plus"></i> {{ __('Register') }}
                                        </a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fas fa-user-circle user-icon"></i> {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#{{ route('profile') }}">
                                            <i class="fas fa-user"></i> Perfil
                                        </a>
                                        <a class="dropdown-item" href="#{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <nav class="navbar navbar-expand-md navbar-light" style="background-color: #002141;">
  
            </nav>




            <div class="container">
            <div class="search-container">
                <ul class="nav nav-tabs" id="searchTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="author-tab" data-bs-toggle="tab" href="#author" role="tab" aria-controls="author" aria-selected="true">Autor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="career-tab" data-bs-toggle="tab" href="#career" role="tab" aria-controls="career" aria-selected="false">Carrera</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="type-tab" data-bs-toggle="tab" href="#type" role="tab" aria-controls="type" aria-selected="false">Tipo</a>
                    </li>
                </ul>
                <div class="tab-content mt-0" id="searchTabsContent">
                    <div class="tab-pane show active" id="author" role="tabpanel" aria-labelledby="author-tab">
                        <div class="bg-danger text-white p-3 rounded d-flex">
                            <input type="text" class="form-control me-2 border-0" placeholder="Buscar por Autor">
                            <button class="btn btn-light border-0" type="button" onclick="searchFunction()">Buscar</button>
                        </div>
                    </div>
                    <div class="tab-pane show" id="career" role="tabpanel" aria-labelledby="career-tab">
                        <div class="bg-danger text-white p-3 rounded d-flex">
                            <input type="text" class="form-control me-2 border-0" placeholder="Buscar por Carrera">
                            <button class="btn btn-light border-0" type="button" onclick="searchFunction()">Buscar</button>
                        </div>
                    </div>
                    <div class="tab-pane show" id="type" role="tabpanel" aria-labelledby="type-tab">
                        <div class="bg-danger text-white p-3 rounded d-flex">
                            <input type="text" class="form-control me-2 border-0" placeholder="Buscar por Tipo">
                            <button class="btn btn-light border-0" type="button" onclick="searchFunction()">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <style>
            .search-container {
                background-color: #002147; /* Fondo azul solo para el área de búsqueda */
                padding: 20px; /* Espaciado interno */
                border-radius: 5px; /* Bordes redondeados */
            }
            .nav-tabs {
                border: none; /* Quitar borde de las pestañas */
            }
            .nav-tabs .nav-link {
                color: white; /* Letras en blanco */
                border: none; /* Quitar borde de las pestañas */
            }
            .nav-tabs .nav-link.active {
                background-color: #a70606; /* Fondo rojo para pestañas activas */
            }
            .bg-danger {
                background-color: #a70606 !important;
            }
            .form-control {
                background-color: white; /* Campo de búsqueda blanco */
                color: black; /* Texto en negro dentro del campo */
            }
            .btn-light {
                background-color: white; /* Botón de búsqueda blanco */
                color: black; /* Texto en negro para el botón */
            }
            .btn-light:hover {
                background-color: #f8f9fa; /* Color claro al pasar el mouse */
            }
        </style>

        <script>
            function searchFunction() {
                // Aquí puedes implementar la lógica de búsqueda
                alert("Función de búsqueda ejecutada");
            }
        </script>






            <main class="py-4">
                @if(request()->is('archivos'))
                    <div id="content">
                        @yield('content')
                    </div>
                @else
                    <div id="content2">
                        @yield('content2')
                    </div>
                @endif
            </main>

    </div>
 




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
