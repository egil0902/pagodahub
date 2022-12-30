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
   
    <div class="container p-0  mx-auto">
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <form name="close_cash" id="close_cash" method="post" action="{{ route('close.cash') }}"> @csrf
                <button type="submit" class="btn btn-light"
                    style="
                padding-left: 0px;
                padding-top: 0px;
                padding-right: 0px;
                padding-bottom: 0px;
            ">
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-header">1. Cajas</div>
                            <div class="card-body">
                                <h5 class="card-title">Cierre diario de cajas</h5>
                                <p class="card-text">Permite el cierre diario de las cuentas para auditoría</p>
                            </div>
                        </div>
                    </div>
                </button>
            </form>
            <form name="closecash_list" id="closecash_list" method="post" action="{{ route('closecash.list') }}">
                @csrf
                <button type="submit" class="btn btn-light"
                    style="
                padding-left: 0px;
                padding-top: 0px;
                padding-right: 0px;
                padding-bottom: 0px;
            ">
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-header">2. Cajas</div>
                            <div class="card-body">
                                <h5 class="card-title">Listado de cierres de caja</h5>
                                <p class="card-text">Listado de los cierres diarios de caja realizados</p>
                            </div>
                        </div>
                    </div>
                </button>
            </form>
            <form name="valespagodarange" id="valespagodarange" method="post" action="{{ route('valespagodarange') }}">
                @csrf
                <button type="submit" class="btn btn-light"
                    style="
                padding-left: 0px;
                padding-top: 0px;
                padding-right: 0px;
                padding-bottom: 0px;
            ">
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-header">3. Vales</div>
                            <div class="card-body">
                                <h5 class="card-title">Registro de rangos de vales La Pagoda</h5>
                                <p class="card-text">Administración de registros de generacion de vales</p>
                            </div>
                        </div>
                    </div>
                </button>
            </form>
            <form name="valepagoda" id="valepagoda" method="get" action="{{ route('valepagoda') }}">
                @csrf
                <button type="submit" class="btn btn-light"
                    style="
                padding-left: 0px;
                padding-top: 0px;
                padding-right: 0px;
                padding-bottom: 0px;
            ">
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-header">4. Vales</div>
                            <div class="card-body">
                                <h5 class="card-title">Control de los vales de La Pagoda</h5>
                                <p class="card-text">Administración de la numeración de los vales, registro y ajunto</p>
                            </div>
                        </div>
                    </div>
                </button>
            </form>
            <form name="valepagoda_list" id="valepagoda_list" method="GET" action="{{ route('valepagoda.list') }}">
                @csrf
                <button type="submit" class="btn btn-light"
                    style="
                padding-left: 0px;
                padding-top: 0px;
                padding-right: 0px;
                padding-bottom: 0px;
            ">
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-header">5. Vales</div>
                            <div class="card-body">
                                <h5 class="card-title">Listado vales La Pagoda consumidos</h5>
                                <p class="card-text">Muestra la lista de los vales consumidos</p>
                            </div>
                        </div>
                    </div>
                </button>
            </form>
            <form name="loans" id="loans" method="get" action="{{ route('loans') }}"> @csrf
                <button type="submit" class="btn btn-light"
                    style="
                padding-left: 0px;
                padding-top: 0px;
                padding-right: 0px;
                padding-bottom: 0px;
            ">
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-header">5. Prestamos</div>
                            <div class="card-body">
                                <h5 class="card-title">Control de los Prestamos</h5>
                                <p class="card-text">Administración de prestamos, registro de terceros y adjuntos</p>
                            </div>
                        </div>
                </button>
            </form>
        </div>
    </div>
@endsection
