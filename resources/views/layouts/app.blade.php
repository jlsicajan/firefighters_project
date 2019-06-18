<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Estacion 22 Patzun Chimaltenango') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="/css/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @yield('after-styles')
</head>
{{--background="{{ url('images/body.jpg') }}"--}}
<body>
<div id="app">
    @if(Auth::check())
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
                        {{ config('app.name', 'Estacion 22') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;@if (Auth::check())
                            @if (Auth::user()->username == 'edvin' | Auth::user()->username == 'fabian'| Auth::user()->name == 'Administrador' | Auth::user()->username == 'reina')
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-haspopup="true" aria-expanded="true">Control general<span
                                                class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li role="separator" class="divider"></li>
                                        <li><a href="{{ url('general') }}">Control de unidades</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="{{ url('gastos/combustible') }}">Control de gastos de
                                                combustible</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="{{ url('gastos/estacion') }}">Control de gastos de la estacion</a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="{{ url('control/recaudaciones') }}">Control de recaudaciones</a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="{{ url('control/novedades') }}">Control de novedades</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="{{ url('reporte/semanal') }}">Reporte semanal</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a target="_blank" href="https://google.com.gt">Control de Usuarios</a></li>
                                        <li role="separator" class="divider"></li>
                                    </ul>
                                </li>
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-haspopup="true" aria-expanded="true">Unidades<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    @foreach(\App\Unity::all() as $unity)
                                        <li role="separator" class="divider"></li>
                                        <li><a href="{{ route('unidad', ['unidad' => $unity->id]) }}">{{ $unity->name }}</a></li>
                                    @endforeach
                                        <li role="separator" class="divider"></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-haspopup="true" aria-expanded="true">Gastos<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ url('combustible') }}">Gastos de combustible</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ url('estacion') }}">Gastos de la estacion</a></li>
                                    <li role="separator" class="divider"></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('libro_novedades') }}">Libro de novedades</a></li>
                            <li><a href="{{ url('inventario_recaudaciones') }}">Inventario de recaudaciones</a></li>
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
                                    <li role="separator" class="divider"></li>
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
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ url('/cambio/contrasena') }}">Cambiar mi contraseña</a></li>
                                    <li role="separator" class="divider"></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    @endif
    @yield('content')
</div>

<!-- Scripts -->
<script src="/js/app.js"></script>
<script type="text/javascript" src="/js/bootstrap-datetimepicker/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="/js/bootstrap-datetimepicker/bootstrap-datetimepicker.es.js"
        charset="UTF-8"></script>
@yield('after_scripts')
<script>
    $(".spinner_container").hide();
    $("#name_responsible_div").hide();

    $("#name_responsible_div_a").hide();

    $("#name_responsible_div_service").hide();

    function show_spinner_loading() {
        // show spinner
        $(".spinner_container").show();
        $(".navbar").addClass('blur');
        $(".container").addClass('blur');

    }

    function hide_spinner_loading() {
        // hide spinner
        $(".spinner_container").hide();
        $(".navbar").removeClass('blur');
        $(".container").removeClass('blur');

    }

    $('#patient_name_check').click(function () {
        if ($(this).is(':checked')) {
            $("#name_patient_div").show();

            $("input#patient_responsible").prop('required', false);
            $("input#patient_name").prop('required', true);

            $("#name_responsible_div").hide();
        }
    });
    $('#patient_responsible_check').click(function () {
        if ($(this).is(':checked')) {
            $("#name_responsible_div").show();

            $("input#patient_responsible").prop('required', true);
            $("input#patient_name").prop('required', false);

            $("#name_patient_div").hide();
        }
    });

    $('#patient_name_check_a').click(function () {
        if ($(this).is(':checked')) {
            $("#name_patient_div_a").show();

            $("input#patient_responsible_a").prop('required', false);
            $("input#patient_name_a").prop('required', true);

            $("#name_responsible_div_a").hide();
        }
    });
    $('#patient_responsible_check_a').click(function () {
        if ($(this).is(':checked')) {
            $("#name_responsible_div_a").show();

            $("input#patient_responsible_a").prop('required', true);
            $("input#patient_name_a").prop('required', false);

            $("#name_patient_div_a").hide();
        }
    });

    $('#patient_name_check_service').click(function () {
        if ($(this).is(':checked')) {
            $("#name_patient_div_service").show();

            $("input#patient_responsible_service").prop('required', false);
            $("input#patient_name_service").prop('required', true);

            $("#name_responsible_div_service").hide();
        }
    });
    $('#patient_responsible_check_service').click(function () {
        if ($(this).is(':checked')) {
            $("#name_responsible_div_service").show();

            $("input#patient_responsible_service").prop('required', true);
            $("input#patient_name_service").prop('required', false);

            $("#name_patient_div_service").hide();
        }
    });
</script>
</body>
</html>
