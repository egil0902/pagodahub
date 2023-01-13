@extends('layouts.app')
@section('title', 'Page Title')


@section('content')

    <div class="py-5 text-center text-white align-items-center d-flex h-50"
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
    <br>
    <div class="container p-0  mx-auto">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card h-100 border border-5 border-dark-subtle">
                    <form name="close_cash" id="close_cash" method="post" action="{{ route('close.cash') }}"> @csrf
                        <center>
                            <button type="submit" class="btn btn-outline">
                                <h5 class="card-header">1. Cajas</h5>
                                <div class="card-body">
                                    <h5 class="card-title">Cierre diario de cajas</h5>
                                    <p class="card-text">Permite el cierre diario de las cuentas para auditoría</p>
                                </div>
                            </button>
                        </center>

                    </form>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 border border-5 border-dark-subtle">
                    <form name="closecash_list" id="closecash_list" method="get" action="{{ route('closecash.list') }}">
                        @csrf
                        <center>
                            <button type="submit" class="btn btn-outline">
                                <h5 class="card-header">2. Cajas</h5>
                                <div class="card-body">
                                    <h5 class="card-title">Listado de cierres de caja</h5>
                                    <p class="card-text">Listado de los cierres diarios de caja realizados</p>
                                </div>
                            </button>
                        </center>
                    </form>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 border border-5 border-dark-subtle">
                    <form name="valespagodarange" id="valespagodarange" method="post"
                        action="{{ route('valespagodarange') }}">
                        @csrf
                        <center>
                            <button type="submit" class="btn btn-outline">
                                <h5 class="card-header">3. Vales</h5>
                                <div class="card-body">
                                    <h5 class="card-title">Registro de rangos de vales La Pagoda</h5>
                                    <p class="card-text">Administración de registros de generacion de vales</p>
                                </div>
                            </button>
                        </center>
                    </form>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 border border-5 border-dark-subtle">
                    <form name="valepagoda" id="valepagoda" method="get" action="{{ route('valepagoda') }}">
                        @csrf
                        <center>
                            <button type="submit" class="btn btn-outline">
                                <h5 class="card-header">4. Vales</h5>
                                <div class="card-body">
                                    <h5 class="card-title">Control de los vales de La Pagoda</h5>
                                    <p class="card-text">Administración de la numeración de los vales, registro y ajunto</p>
                                </div>
                            </button>
                        </center>
                    </form>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 border border-5 border-dark-subtle">
                    <form name="valepagoda_list" id="valepagoda_list" method="GET"
                        action="{{ route('valepagoda.list') }}">
                        @csrf
                        <center>
                            <button type="submit" class="btn btn-outline">
                                <h5 class="card-header">5. Vales</h5>
                                <div class="card-body">
                                    <h5 class="card-title">Listado vales La Pagoda consumidos</h5>
                                    <p class="card-text">Muestra la lista de los vales consumidos</p>
                                </div>
                            </button>
                        </center>
                    </form>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 border border-5 border-dark-subtle">
                    <form name="loans" id="loans" method="get" action="{{ route('loans') }}"> @csrf
                        @csrf
                        <center>
                            <button type="submit" class="btn btn-outline">
                                <h5 class="card-header">6. Prestamos</h5>
                                <div class="card-body">
                                    <h5 class="card-title">Control de los Prestamos</h5>
                                    <p class="card-text">Administración de prestamos, registro de terceros y adjuntos</p>
                                </div>
                            </button>
                        </center>
                    </form>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 border border-5 border-dark-subtle">
                    <form name="loanslist" id="loanslist" method="get" action="{{ route('loans.list') }}">
                        @csrf
                        <center>
                            <button type="submit" class="btn btn-outline">
                                <h5 class="card-header">7. Prestamos</h5>
                                <div class="card-body">
                                    <h5 class="card-title">Listado de Prestamos</h5>
                                    <p class="card-text">Muestra la lista de los prestamos solicitados</p>
                                </div>
                            </button>
                        </center>
                    </form>
                </div>
            </div>

            <style>
                h5.card-header {
                    padding: var(--bs-card-cap-padding-y) var(--bs-card-cap-padding-x);
                    margin-bottom: 0;
                    color: var(--bs-card-cap-color);
                    background-color: white;
                    border-bottom: white;
                }

            </div></div>@endsection
