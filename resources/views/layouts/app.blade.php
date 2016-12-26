<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
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
                    &nbsp;@if (Auth::check())
                        <li><a href="">Control general</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="true">Unidades<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('unidad', ['unidad' => 'ad21']) }}">UNIDAD A21</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('unidad', ['unidad' => 'rd']) }}">UNIDAD RD 19</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('unidad', ['unidad' => 'mdp22']) }}">UNIDAD MDP-22</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('unidad', ['unidad' => 'tdp22']) }}">UNIDAD TDP-22</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('unidad', ['unidad' => 'ee22']) }}">UNIDAD EE-22</a></li>
                                <li role="separator" class="divider"></li>
                                <img src="/images/unitys/MDP-22.jpg" style="margin: 10px; height: 250px; width: 350px"
                                     class="navimg">
                            </ul>
                        </li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Entrar</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Salir del sistema
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                          style="display: none;">
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

    @yield('content')
</div>

<!-- Scripts -->
<script src="/js/app.js"></script>
@yield('after_scripts')
</body>
</html>
