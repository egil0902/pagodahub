<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @livewireStyles

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">
                {{-- <img src="img/pagodalogo.jpeg" alt="Logo" width="100%" height="75"
                    class="d-inline-block align-text-top"> --}}

            </a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        @if (Route::has('login'))
                            @auth
                                <a class="nav-link active" aria-current="page" href="{{ url('/home') }}">
                                    {{ config('app.name', 'Laravel') }}
                                </a>
                            @else
                                <a class="nav-link active" aria-current="page" href="{{ url('/') }}">
                                    {{ config('app.name', 'Laravel') }}
                                </a>
                            @endauth
                        @endif
                    </li>
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/home') }}" class="nav-link active" aria-current="page">Inicio</a>

                            </li>
                        @else
                            {{-- <a href="{{ route('login') }}" class="nav-link active" aria-current="page">Inicio de
                                    sesión</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="nav-link active" aria-current="page">Registrarse</a>
                                @endif --}}
                        @endauth
                    @endif
                    </li>
                        @auth
                            @if(isset($permisos2))
                                @foreach ($permisos2->records as $user)
                                    @foreach ($user->PAGODAHUB_closecash as $acceso)
                                        @if ($acceso->Name == 'closecash')
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                                        <path
                                                            d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                                                        <path
                                                            d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                                                        <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                                                    </svg>
                                                    Caja
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-dark">
                                                    <li>
                                                        <form name="close_cash" id="close_cash" method="post"
                                                            action="{{ route('close.cash') }}"> 
                                                                @csrf
                                                                <button type="submit" class="dropdown-item">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                    fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                                                                    <path
                                                                        d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                                                    </svg>Cierre diario de cajas
                                                                </button>
                                                        </form>
                                                    </li>
                                                    <li> <a class="dropdown-item" href="/closecash_list">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                                                <path
                                                                    d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                                                            </svg>
                                                            Listado de Cierres de cajas</a></li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                @endforeach
                                @foreach ($permisos2->records as $user)
                                    @foreach ($user->PAGODAHUB_closecash as $acceso)
                                        @if ($acceso->Name == 'vale')
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-credit-card-2-back" viewBox="0 0 16 16">
                                                        <path
                                                            d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1z" />
                                                        <path
                                                            d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm13 2v5H1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm-1 9H2a1 1 0 0 1-1-1v-1h14v1a1 1 0 0 1-1 1z" />
                                                    </svg>
                                                    Vales
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-dark">
                                                    <li>
                                                        <form name="valespagodarange" id="valespagodarange" method="post"
                                                                    action="{{ route('valespagodarange') }}">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                    width="16" height="16" fill="currentColor" class="bi bi-stickies"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M1.5 0A1.5 1.5 0 0 0 0 1.5V13a1 1 0 0 0 1 1V1.5a.5.5 0 0 1 .5-.5H14a1 1 0 0 0-1-1H1.5z" />
                                                                    <path
                                                                        d="M3.5 2A1.5 1.5 0 0 0 2 3.5v11A1.5 1.5 0 0 0 3.5 16h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 16 9.586V3.5A1.5 1.5 0 0 0 14.5 2h-11zM3 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V9h-4.5A1.5 1.5 0 0 0 9 10.5V15H3.5a.5.5 0 0 1-.5-.5v-11zm7 11.293V10.5a.5.5 0 0 1 .5-.5h4.293L10 14.793z" />
                                                                </svg>Registro de rango de vales
                                                                </button>
                                                        </form>
                                                    </li>
                                                    <li> <a class="dropdown-item" href="/valepagoda">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-journal-check" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd"
                                                                    d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                                                <path
                                                                    d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                                                <path
                                                                    d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                                            </svg>
                                                            Control de vales La Pagoda</a></li>
                                                    <li> <a class="dropdown-item" href="/valepagoda_list">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-list-check" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd"
                                                                    d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                                                            </svg>
                                                            Listado de vales La Pagoda consumidos</a>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                @endforeach
                                @foreach ($permisos2->records as $user)
                                    @foreach ($user->PAGODAHUB_closecash as $acceso)
                                        @if ($acceso->Name == 'loans')
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Prestamos
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-dark">
                                                    <li>
                                                        <a class="dropdown-item" href="/loans">
                                                            Crear prestamos</a>
                                                    </li>
                                                    <li> 
                                                        <a class="dropdown-item" href="/loans_debt">
                                                            Pagar prestamos
                                                        </a>
                                                    </li>
                                                    <li> 
                                                        <a class="dropdown-item" href="/loans_list">
                                                            Listar prestamos
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                @endforeach
                                @foreach ($permisos2->records as $user)
                                    @foreach ($user->PAGODAHUB_closecash as $acceso)
                                        @if ($acceso->Name == 'market')
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Mercado
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-dark">
                                                    <li>
                                                        <a class="dropdown-item" href="../market">Recepcion productos</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="../marketinvoice">Carga de facturas</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="../facture">Listado de facturas</a>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                @endforeach
                                @foreach ($permisos2->records as $user)
                                    @php
                                        $hasBank = false;
                                        $hasBankGerency = false;
                                    @endphp

                                    @foreach ($user->PAGODAHUB_closecash as $acceso)
                                        @if ($acceso->Name == 'bank')
                                            @php $hasBank = true; @endphp
                                        @elseif ($acceso->Name == 'bank.gerency')
                                            @php $hasBankGerency = true; @endphp
                                        @endif
                                    @endforeach

                                    @if ($hasBank || $hasBankGerency)
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Banco
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-dark">
                                                <li> <a class="dropdown-item" href="/requestBrink">
                                                        Solicitud Brink
                                                    </a>
                                                </li>
                                                @if ($hasBankGerency)
                                                <li> <a class="dropdown-item" href="/requestGerency">
                                                        Solicitud gerencia
                                                    </a>
                                                </li>
                                                @endif
                                                <li>
                                                    <a class="dropdown-item" href="/Brink">
                                                        Banco supervisor
                                                    </a>
                                                </li>
                                                <li> <a class="dropdown-item" href="/BrinkSend">
                                                        Envio bancos
                                                    </a>
                                                </li>
                                                
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endauth
                </ul>
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Inicio de sesión') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar Sesión') }}
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
    <main class="py-2">
        @yield('content')
    </main>
    @livewireScripts
</body>

</html>
