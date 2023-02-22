@extends('layouts.app')
@section('title', 'Page Title')


@section('content')

    <div class="py-1 text-center text-white align-items-center h-50"
        style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, .75), rgba(0, 0, 0, .75)), url(https://static.pingendo.com/cover-bubble-dark.svg);  background-position: center center, center center;  background-size: cover, cover;  background-repeat: repeat, repeat;">
        <div class="container py-5">
            <div class="row">
                <div class="mx-auto col-lg-8 col-md-10">
                    <h3 class="display-3">Pagoda Hub</h3>
                    <h3>Sistema web integrado de control y seguimiento gerencial de las empresas del Grupo la Pagoda</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="p-5 m-0 border-0 bd-example">

        {{-- Close Cash --}}
        @foreach ($permisos2->records as $user)
            @foreach ($user->PAGODAHUB_closecash as $acceso)
                @if ($acceso->Name == 'closecash')
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title"> <svg xmlns="http://www.w3.org/2000/svg" width="37" height="37"
                                    fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                    <path
                                        d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                                    <path
                                        d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                                    <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                                </svg> Cajas</h1>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                @foreach ($user->PAGODAHUB_closecash as $acceso)
                                    @if ($acceso->Name == 'closecash')
                                        <div class="col">
                                            <div class="card h-100 border border-5 border-dark-subtle">
                                                <form name="close_cash" id="close_cash" method="post"
                                                    action="{{ route('close.cash') }}"> @csrf
                                                    <center>
                                                        <button type="submit" class="btn btn-outline">
                                                            {{-- <h5 class="card-header">Cajas</h5> --}}
                                                            <div class="card-body">
                                                                <h5 class="card-title">Cierre diario de cajas</h5>
                                                                <p class="card-text">Permite el cierre diario de las cuentas
                                                                    para
                                                                    auditoría</p>
                                                            </div>
                                                        </button>
                                                    </center>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                @foreach ($user->PAGODAHUB_closecash as $acceso)
                                    @if ($acceso->Name == 'closecash')
                                        <div class="col">
                                            <div class="card h-100 border border-5 border-dark-subtle">
                                                <form name="closecash_list" id="closecash_list" method="get"
                                                    action="{{ route('closecash.list') }}">
                                                    @csrf
                                                    <center>
                                                        <button type="submit" class="btn btn-outline">
                                                            {{-- <h5 class="card-header">Cajas</h5> --}}
                                                            <div class="card-body">
                                                                <h5 class="card-title">Listado de cierres de caja</h5>
                                                                <p class="card-text">Listado de los cierres diarios de caja
                                                                    realizados
                                                                </p>
                                                            </div>
                                                        </button>
                                                    </center>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <br>
                @endif
            @endforeach
        @endforeach

        {{-- Vale --}}
        @foreach ($permisos2->records as $user)
            @foreach ($user->PAGODAHUB_closecash as $acceso)
                @if ($acceso->Name == 'vale')
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title"> <svg xmlns="http://www.w3.org/2000/svg" width="37" height="37"
                                    fill="currentColor" class="bi bi-credit-card-2-back" viewBox="0 0 16 16">
                                    <path
                                        d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1z" />
                                    <path
                                        d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm13 2v5H1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm-1 9H2a1 1 0 0 1-1-1v-1h14v1a1 1 0 0 1-1 1z" />
                                </svg> Vales</h1>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                @foreach ($user->PAGODAHUB_closecash as $acceso)
                                    @if ($acceso->Name == 'valespagodarange')
                                        <div class="col">
                                            <div class="card h-100 border border-5 border-dark-subtle">
                                                <form name="valespagodarange" id="valespagodarange" method="post"
                                                    action="{{ route('valespagodarange') }}">
                                                    @csrf
                                                    <center>
                                                        <button type="submit" class="btn btn-outline">
                                                            {{--  <h5 class="card-header">Vales</h5> --}}
                                                            <div class="card-body">
                                                                <h5 class="card-title">Registro de rangos de vales La Pagoda
                                                                </h5>
                                                                <p class="card-text">Administración de registros de
                                                                    generacion
                                                                    de
                                                                    vales</p>
                                                            </div>
                                                        </button>
                                                    </center>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                @foreach ($user->PAGODAHUB_closecash as $acceso)
                                    @if ($acceso->Name == 'valepagoda')
                                        <div class="col">
                                            <div class="card h-100 border border-5 border-dark-subtle">
                                                <form name="valepagoda" id="valepagoda" method="get"
                                                    action="{{ route('valepagoda') }}">
                                                    @csrf
                                                    <center>
                                                        <button type="submit" class="btn btn-outline">
                                                            {{-- <h5 class="card-header">Vales</h5> --}}
                                                            <div class="card-body">
                                                                <h5 class="card-title">Control de los vales de La Pagoda
                                                                </h5>
                                                                <p class="card-text">Administración de la numeración de los
                                                                    vales,
                                                                    registro y
                                                                    ajunto
                                                                </p>
                                                            </div>
                                                        </button>
                                                    </center>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                @foreach ($user->PAGODAHUB_closecash as $acceso)
                                    @if ($acceso->Name == 'valepagoda.list')
                                        <div class="col">
                                            <div class="card h-100 border border-5 border-dark-subtle">
                                                <form name="valepagoda_list" id="valepagoda_list" method="GET"
                                                    action="{{ route('valepagoda.list') }}">
                                                    @csrf
                                                    <center>
                                                        <button type="submit" class="btn btn-outline">
                                                            {{-- <h5 class="card-header">Vales</h5> --}}
                                                            <div class="card-body">
                                                                <h5 class="card-title">Listado vales La Pagoda consumidos
                                                                </h5>
                                                                <p class="card-text">Muestra la lista de los vales
                                                                    consumidos
                                                                </p>
                                                            </div>
                                                        </button>
                                                    </center>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <br>
                @endif
            @endforeach
        @endforeach

        {{-- Loans --}}
        @foreach ($permisos2->records as $user)
            @foreach ($user->PAGODAHUB_closecash as $acceso)
                @if ($acceso->Name == 'loans')
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title"> <svg xmlns="http://www.w3.org/2000/svg" width="37" height="37"
                                    fill="currentColor" class="bi bi-wallet" viewBox="0 0 16 16">
                                    <path
                                        d="M0 3a2 2 0 0 1 2-2h13.5a.5.5 0 0 1 0 1H15v2a1 1 0 0 1 1 1v8.5a1.5 1.5 0 0 1-1.5 1.5h-12A2.5 2.5 0 0 1 0 12.5V3zm1 1.732V12.5A1.5 1.5 0 0 0 2.5 14h12a.5.5 0 0 0 .5-.5V5H2a1.99 1.99 0 0 1-1-.268zM1 3a1 1 0 0 0 1 1h12V2H2a1 1 0 0 0-1 1z" />
                                </svg> Prestamos</h1>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                @foreach ($user->PAGODAHUB_closecash as $acceso)
                                    @if ($acceso->Name == 'loans')
                                        <div class="col">
                                            <div class="card h-100 border border-5 border-dark-subtle">
                                                <form name="loans" id="loans" method="get"
                                                    action="{{ route('loans') }}">
                                                    @csrf
                                                    @csrf
                                                    <center>
                                                        <button type="submit" class="btn btn-outline">
                                                            {{-- <h5 class="card-header">Prestamos</h5> --}}
                                                            <div class="card-body">
                                                                <h5 class="card-title">Control de los Prestamos</h5>
                                                                <p class="card-text">Administración de prestamos, registro
                                                                    de
                                                                    terceros
                                                                    y
                                                                    adjuntos
                                                                </p>
                                                            </div>
                                                        </button>
                                                    </center>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                @foreach ($user->PAGODAHUB_closecash as $acceso)
                                    @if ($acceso->Name == 'loans')
                                        <div class="col">
                                            <div class="card h-100 border border-5 border-dark-subtle">
                                                <form name="loanslist" id="loanslist" method="get"
                                                    action="{{ route('loans.list') }}">
                                                    @csrf
                                                    <center>
                                                        <button type="submit" class="btn btn-outline">
                                                            {{-- <h5 class="card-header">Prestamos</h5> --}}
                                                            <div class="card-body">
                                                                <h5 class="card-title">Listado de Prestamos</h5>
                                                                <p class="card-text">Muestra la lista de los prestamos
                                                                    solicitados
                                                                </p>
                                                            </div>
                                                        </button>
                                                    </center>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <br>
                @endif
            @endforeach
        @endforeach


        {{-- Market --}}
        @foreach ($permisos2->records as $user)
            @foreach ($user->PAGODAHUB_closecash as $acceso)
                @if ($acceso->Name == 'market')
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="37" height="37"
                                    fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                                    <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                </svg> Mercado
                            </h1>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                @foreach ($user->PAGODAHUB_closecash as $acceso)
                                    @if ($acceso->Name == 'market')
                                        <div class="col">
                                            <div class="card h-100 border border-5 border-dark-subtle">
                                                <form name="market" id="market" method="get"
                                                    action="{{ route('market') }}">
                                                    @csrf
                                                    <center>
                                                        <button type="submit" class="btn btn-outline">
                                                            {{-- <h5 class="card-header">Compras</h5> --}}
                                                            <div class="card-body">
                                                                <h5 class="card-title">Recepcion de productos</h5>
                                                                <p class="card-text">---------------</p>
                                                            </div>
                                                        </button>
                                                    </center>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                @foreach ($user->PAGODAHUB_closecash as $acceso)
                                    @if ($acceso->Name == 'market')
                                        <div class="col">
                                            <div class="card h-100 border border-5 border-dark-subtle">
                                                <form name="loanslist" id="loanslist" method="get"
                                                    action="{{ route('home') }}">
                                                    @csrf
                                                    <center>
                                                        <button type="submit" class="btn btn-outline">
                                                            {{-- <h5 class="card-header">Compras</h5> --}}
                                                            <div class="card-body">
                                                                <h5 class="card-title">Carga de facturas</h5>
                                                                <p class="card-text">---------------</p>
                                                            </div>
                                                        </button>
                                                    </center>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                @foreach ($user->PAGODAHUB_closecash as $acceso)
                                    @if ($acceso->Name == 'market')
                                        <div class="col">
                                            <div class="card h-100 border border-5 border-dark-subtle">
                                                <form name="loanslist" id="loanslist" method="get"
                                                    action="{{ route('home') }}">
                                                    @csrf
                                                    <center>
                                                        <button type="submit" class="btn btn-outline">
                                                            {{-- <h5 class="card-header">Compras</h5> --}}
                                                            <div class="card-body">
                                                                <h5 class="card-title">Listado de creditos por proveedor
                                                                </h5>
                                                                <p class="card-text">---------------</p>
                                                            </div>
                                                        </button>
                                                    </center>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <br>
                @endif
            @endforeach
        @endforeach

        {{-- Bank --}}
        @foreach ($permisos2->records as $user)
            @foreach ($user->PAGODAHUB_closecash as $acceso)
                @if ($acceso->Name == 'bank')
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title"> <svg xmlns="http://www.w3.org/2000/svg" width="37"
                                    height="37" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
                                    <path
                                        d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.501.501 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89L8 0ZM3.777 3h8.447L8 1 3.777 3ZM2 6v7h1V6H2Zm2 0v7h2.5V6H4Zm3.5 0v7h1V6h-1Zm2 0v7H12V6H9.5ZM13 6v7h1V6h-1Zm2-1V4H1v1h14Zm-.39 9H1.39l-.25 1h13.72l-.25-1Z" />
                                </svg> Banco</h1>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                @foreach ($user->PAGODAHUB_closecash as $acceso)
                                    @if ($acceso->Name == 'bank')
                                        <div class="col">
                                            <div class="card h-100 border border-5 border-dark-subtle">
                                                <form name="loanslist" id="loanslist" method="get"
                                                    action="{{ route('home') }}">
                                                    @csrf
                                                    <center>
                                                        <button type="submit" class="btn btn-outline">
                                                            {{-- <h5 class="card-header">Banco</h5> --}}
                                                            <div class="card-body">
                                                                <h5 class="card-title">Solicitud Supervisor</h5>
                                                                <p class="card-text">---------------</p>
                                                            </div>
                                                        </button>
                                                    </center>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                @foreach ($user->PAGODAHUB_closecash as $acceso)
                                    @if ($acceso->Name == 'bank')
                                        <div class="col">
                                            <div class="card h-100 border border-5 border-dark-subtle">
                                                <form name="loanslist" id="loanslist" method="get"
                                                    action="{{ route('home') }}">
                                                    @csrf
                                                    <center>
                                                        <button type="submit" class="btn btn-outline">
                                                            {{--  <h5 class="card-header">Banco</h5> --}}
                                                            <div class="card-body">
                                                                <h5 class="card-title">Entrega</h5>
                                                                <p class="card-text">---------------</p>
                                                            </div>
                                                        </button>
                                                    </center>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <br>
                @endif
            @endforeach
        @endforeach

        <style>
            h5.card-header {
                padding: var(--bs-card-cap-padding-y) var(--bs-card-cap-padding-x);
                margin-bottom: 0;
                color: var(--bs-card-cap-color);
                background-color: white;
                border-bottom: white;
            }
        </style>
    </div>
@endsection
