<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <!-- Left Side Of Navbar -->
        <a class="navbar-brand nav-link " href="{{ url('/') }}">Estacion 22</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0 bg-dark">
            @if (Auth::check())
                @if (Auth::user()->username == 'edvin' | Auth::user()->username == 'fabian'| Auth::user()->name == 'Administrador' | Auth::user()->username == 'reina')
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link " data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="true">Control general<span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu bg-dark">
                            <li role="separator" class="divider"></li>
                            <li><a class="nav-link " href="{{ url('general') }}">Control de unidades</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a class="nav-link " href="{{ url('gastos/combustible') }}">Control de gastos de
                                    combustible</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a class="nav-link " href="{{ url('gastos/estacion') }}">Control de gastos de la estacion</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a class="nav-link " href="{{ url('control/recaudaciones') }}">Control de recaudaciones</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a class="nav-link " href="{{ url('control/novedades') }}">Control de novedades</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a class="nav-link " href="{{ url('reporte/semanal') }}">Reporte semanal</a></li>
                            <li role="separator" class="divider"></li>
                        </ul>
                    </li>
                @endif
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link " data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="true">Unidades<span class="caret"></span></a>
                    <ul class="dropdown-menu bg-dark">
                        @foreach(\App\Unity::all() as $unity)
                            <li role="separator" class="divider"></li>
                            <li><a class="nav-link " href="{{ route('unidad', ['unidad' => $unity->id]) }}">{{ $unity->name }}</a></li>
                        @endforeach
                        <li role="separator" class="divider"></li>
                    </ul>
                </li>
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link bg-dark" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="true">Gastos<span class="caret"></span></a>
                    <ul class="dropdown-menu bg-dark">
                        <li role="separator" class="divider"></li>
                        <li><a class="nav-link " href="{{ url('combustible') }}">Gastos de combustible</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a class="nav-link " href="{{ url('estacion') }}">Gastos de la estacion</a></li>
                        <li role="separator" class="divider"></li>
                    </ul>
                </li>
                <li><a class="nav-link " href="{{ url('libro_novedades') }}">Libro de novedades</a></li>
                <li><a class="nav-link " href="{{ url('inventario_recaudaciones') }}">Inventario de recaudaciones</a></li>
            @endif
        </ul>

        <ul class="navbar-nav ml-auto mt-2 mt-lg-0 bg-dark">
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Entrar</a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle nav-link " data-toggle="dropdown" role="button"
                       aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu bg-dark" role="menu">
                        <li role="separator" class="divider"></li>
                        <li>
                            <a class="nav-link " href="{{ url('/logout') }}"
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
                        <li><a class="nav-link " href="{{ url('/cambio/contrasena') }}">Cambiar mi contraseña</a></li>
                        <li role="separator" class="divider"></li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</nav>