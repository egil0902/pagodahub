@extends('layouts.app')

@section('content')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,0,200" />
    <form name="closecash_import" id="closecash_import" method="post" action="{{ route('closecash.import') }}"
        enctype="multipart/form-data">
        @csrf
        <div class="card text-center m-2">
            <div class="row border m-1">
                <div class="col">
                    <div class="card-body">
                        <p for="cars" class="card-text">Sucursal</p>
                        <select class="form-control" name="AD_Org_ID" id="AD_Org_ID">
                            <option value="0">*</option>
                            @if (isset($orgs))
                                @if ($orgs->{'records-size'} > 0)
                                    @foreach ($orgs->records as $org)
                                        <option
                                            {{ isset($request->AD_Org_ID) ? ($request->AD_Org_ID == $org->id ? __('selected') : __('')) : __('') }}
                                            value="{{ $org->id }}">{{ $org->Name }}</option>
                                    @endforeach
                                @endif
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="card-body">
                        <div class="form-group">
                            <p class="card-text">Fecha</p>
                            <div class="">
                                <input name="DateTrx" type="date" id="abc"
                                    value={{ isset($request->DateTrx) ? date('Y-m-d', strtotime($request->DateTrx)) : date('Y-m-d') }}
                                    class="form-control" placeholder="0.00">
                                    @foreach ($permisos->records as $user)
                                    @foreach ($user->PAGODAHUB_closecash as $acceso)
                                        @if ($acceso->Name == 'closecash')
                                        <script>
                                            // Obtener la fecha actual
                                            var hoy = new Date();
                                            // Restar 3 días a la fecha actual
                                            var tresDiasAtras = new Date(hoy.getTime() - (3 * 24 * 60 * 60 * 1000));
                                            // Establecer el atributo min en el campo de fecha con la fecha de hace 3 días
                                            document.getElementById("abc").max = hoy.toISOString().split("T")[0];
                                            document.getElementById("abc").min = tresDiasAtras.toISOString().split("T")[0];
                                        </script>
                                        @break
                                        @endif
                                    @endforeach
                                    @foreach ($user->PAGODAHUB_closecash as $acceso)
                                        @if ($acceso->Name == 'closecash.day')
                                        <script>
                                            // Obtener la fecha actual
                                            var hoy = new Date();
                                            // Restar 3 días a la fecha actual
                                            var tresDiasAtras = new Date(hoy.getTime() - (3650 * 24 * 60 * 60 * 1000));
                                            // Establecer el atributo min en el campo de fecha con la fecha de hace 3 días
                                            document.getElementById("abc").max = hoy.toISOString().split("T")[0];
                                            document.getElementById("abc").min = tresDiasAtras.toISOString().split("T")[0];
                                        </script>
                                        @break
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card-body">
                        <div class="form-group">
                            <p class="card-text">Importar</p>
                            <button type="submit" class="btn btn-primary form-control" href="#">Importar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if (isset($closecashsumlist))
        @if ($list->isNotEmpty())
            @foreach ($list as $dataday)
                <form name="closecash_edit" id="closecash_edit" method="POST" action="{{ route('closecash.edit') }}"
                    enctype="multipart/form-data">
            @endforeach
        @endif
        @if ($list->isEmpty())
            <form name="closecash_store" id="closecash_store" method="POST" action="{{ route('closecash.store') }}"
                enctype="multipart/form-data">
        @endif
        @csrf
        @if ($closecashsumlist->{'records-size'} > 0)
            @foreach ($closecashsumlist->records as $data)
                <input name="DateTrx" value="{{ $request->DateTrx }}" type="hidden">
                <input name="AD_Org_ID" value="{{ $request->AD_Org_ID }}" type="hidden">
                <div class="card text-center m-2">
                    <div class="row border m-1">
                        <div class="col">
                            <div class="card-body">
                                <label><b>Cantidad de cierres: {{ $data->gh_closecash_id_count }}</b></label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card-body">
                                @if ($list->isNotEmpty())
                                    @foreach ($list as $dataday)
                                        <span class="material-symbols-outlined">
                                            edit_square
                                        </span>
                                        <br>

                                        <a href="{{ route('download-pdf') }}">
                                            <button type="button" class="btn btn-outline-secondary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z">
                                                    </path>
                                                    <path
                                                        d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z">
                                                    </path>
                                                </svg>
                                                Imprimir
                                            </button>
                                        </a>
                                    @endforeach
                                @endif
                                @if ($list->isEmpty())
                                    <span class="material-symbols-outlined">
                                        note_add
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <div class="card-body">
                                <label>Inicio caja:<b id="InicioCaja"> {{ $data->BeginningBalance }}
                                    </b></label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card text-center m-2">


                    @if (isset($closecashlist))
                        <div class="table-responsive">
                            <table class="table table table-borderless">
                                <thead id="miTablaPersonalizada">
                                    <tr>
                                        <th scope="col" style="width: 50px;">#</th>
                                        <th scope="col"
                                            style="
                                        padding-right: 25px;
                                    ">
                                            Caja</th>
                                        <th scope="col"
                                            style="
                                        padding-right: 25px;
                                    ">
                                            Cajera</th>
                                        <th scope="col"
                                            style="
                                        padding-left: 25px;
                                    ">
                                            Inicio caja</th>
                                        <th scope="col"
                                            style="
                                        padding-left: 25px;
                                    ">
                                            Subtotal</th>
                                        <th scope="col"
                                            style="
                                        padding-left: 25px;
                                    ">
                                            Monto contado</th>
                                        <th scope="col"
                                            style="
                                        padding-left: 25px;
                                    ">
                                            Monto X</th>
                                        <th scope="col"
                                            style="
                                        padding-left: 25px;
                                    ">
                                            Diferencia</th>
                                    </tr>
                                </thead>
                                @php $cuenta = 1;  @endphp
                                @if ($closecashlist->{'records-size'} > 0)
                                    @foreach ($closecashlist->records as $closecashl)
                                    <tbody style="font-size: 14px; <?php echo (isset($closecashl->ba_value) ? '' : 'color: red;') ?>">

                                            <tr>
                                                <th cope="row" class="text-start text-capitalize"
                                                    style="padding-right: 10px;">
                                                    @php echo $cuenta++;  @endphp</th>
                                                <th class="text-start text-capitalize" style="padding-right: 25px;">
                                                    {{ $closecashl->ba_name }}</th>
                                                <td class="text-start text-capitalize" style="padding-right: 25px;">
                                                    {{ $closecashl->u_name }}</td>
                                                <td class="text-end" style="padding-left: 25px;">
                                                    @php
                                                        echo number_format($closecashl->BeginningBalance, 2, ',', ' ');
                                                    @endphp
                                                </td>
                                                <td class="text-end"
                                                    style="
                                                padding-left: 25px;
                                            ">
                                                    @php
                                                        echo number_format($closecashl->SubTotal, 2, ',', ' ');
                                                    @endphp
                                                </td>
                                                <td class="text-end"
                                                    style="
                                                padding-left: 25px;
                                            ">
                                                    @php
                                                        echo number_format($closecashl->NetTotal, 2, ',', ' ');
                                                    @endphp
                                                </td>
                                                <td class="text-end"
                                                    style="
                                                padding-left: 25px;
                                            ">
                                                    @php
                                                        echo number_format($closecashl->XAmt, 2, ',', ' ');
                                                    @endphp
                                                </td>
                                                <td class="text-end"
                                                    style="
                                                padding-left: 25px;
                                            ">
                                                    @php
                                                        echo number_format($closecashl->DifferenceAmt, 2, ',', ' ');
                                                    @endphp
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    @endif

                </div>


                @if ($list->isNotEmpty())
                    @foreach ($list as $dataday)
                        <div class="col-2 col-sm-2 col-md-2 col-lg-2" name="id">
                            <input hidden name="id" value="{{ $dataday->id }}">
                        </div>
                    @endforeach
                @endif



                <center>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" id="ver_sistema" class="btn btn-primary">Ocultar sistema</button>
                        <button style="border-bottom-right-radius: 7px !important; border-top-right-radius: 7px !important;" type="button" id="ver_fiscalizadora" class="btn btn-primary">Ocultar
                            fiscalizadora</button>
                        <button style="display:none" type="button" id="ver_gerente" class="btn btn-primary">Ocultar gerente</button>
                        
                    </div>
                    <span style="float: right; font-weight: normal;">Agencia ?</span><input id="agencia-checkbox" type="checkbox" style="float: right;margin-top: 5px; margin-right: 5px;"> 
                </center>

                <div class="card-group m-2">

                    <div class="card" id="card_sistema" style="display: block;">
                        <div class="card-body">

                            <h5 class="card-title"><b>Monto sistema</b></h5>
                            <div class="table-responsive">
                                <table class="table table-borderless ">
                                    <thead id="miTablaPersonalizada">
                                        <tr>
                                            <th>
                                                <p class="card-text">Efectivo</p>
                                            </th>
                                            <th></th>
                                            <th>
                                                <h5 align="right" class="mb-0 fw-bold" id="Montosistema_t">
                                                    {{ $data->x_oneamt * 1 + $data->x_fiveamt * 5 + $data->x_tenamt * 10 + $data->x_twentyamt * 20 + $data->x_fiftyamt * 50 + $data->x_hundredamt * 100, 2 }}
                                                </h5>
                                                <input hidden name="efectivo_sistema"
                                                    value="{{ $data->x_oneamt * 1 + $data->x_fiveamt * 5 + $data->x_tenamt * 10 + $data->x_twentyamt * 20 + $data->x_fiftyamt * 50 + $data->x_hundredamt * 100, 2 }}">

                                            </th>
                                            <th>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>$1 *</td>
                                            <td> <input name="x_oneamtSistema" value="{{ $data->x_oneamt }}"
                                                    type="number" class="form-control" readonly
                                                    class="text-left  form-control" placeholder="0.00"></td>
                                            <td align="right">
                                                @php
                                                    echo number_format($data->x_oneamt * 1, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>$5 *</td>
                                            <td><input name="x_fiveamtSistema" value="{{ $data->x_fiveamt }}"
                                                    type="number" class="form-control" readonly
                                                    class="text-left  form-control" placeholder="0.00"></td>
                                            <td align="right">
                                                @php
                                                    echo number_format($data->x_fiveamt * 5, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>$10 *</td>
                                            <td><input name="x_tenamtSistema" value="{{ $data->x_tenamt }}"
                                                    type="number" class="form-control" readonly
                                                    class="text-left  form-control" placeholder="0.00"></td>
                                            <td align="right">
                                                @php
                                                    echo number_format($data->x_tenamt * 10, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>$20 *</td>
                                            <td><input name="x_twentyamtSistema" value="{{ $data->x_twentyamt }}"
                                                    type="number" class="form-control" readonly
                                                    class="text-left  form-control" placeholder="0.00"></td>
                                            <td align="right">
                                                @php
                                                    echo number_format($data->x_twentyamt * 20, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>$50 *</td>
                                            <td><input name="x_fiftyamtSistema" value="{{ $data->x_fiftyamt }}"
                                                    type="number" class="form-control" readonly
                                                    class="text-left  form-control" placeholder="0.0"></td>
                                            <td align="right">
                                                @php
                                                    echo number_format($data->x_fiftyamt * 50, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>$100 *</td>
                                            <td><input name="x_hundredamtSistema" value="{{ $data->x_hundredamt }}"
                                                    type="number" class="form-control" readonly
                                                    class="text-left  form-control" placeholder="0.00"></td>
                                            <td align="right">
                                                @php
                                                    echo number_format($data->x_hundredamt * 100, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br><br>
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead id="miTablaPersonalizada">
                                        <tr>
                                            <th>Otros</th>
                                            <th></th>
                                            <th align="right">
                                                <h5 align="right" class="mb-0 fw-bold" id="Otros">
                                                    {{ $data->yappy + $data->otros + $data->valespagoda + $data->CheckAmt + $data->LotoAmt + $data->CreditAmt + $data->CardAmt + $data->CashAmt + $data->CoinRoll + $data->InvoiceAmt + $data->VoucherAmt + $data->GrantAmt }}
                                                </h5>
                                                <input hidden name="otros_sistema"
                                                    value="{{ $data->yappy + $data->otros + $data->valespagoda + $data->CheckAmt + $data->LotoAmt + $data->CreditAmt + $data->CardAmt + $data->CashAmt + $data->CoinRoll + $data->InvoiceAmt + $data->VoucherAmt + $data->GrantAmt }}">
                                            </th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Yappy</td>
                                            <td> <input name="yappySistema" value="{{ $data->yappy }}" type="number"
                                                    class="form-control" step="0.01" readonly placeholder="0.00"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Otros</td>
                                            <td><input name="otrosSistema" value="{{ $data->otros }}" type="number"
                                                    class="form-control" step="0.01" readonly placeholder="0.00"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input disabled step="0.01" class="form-control">
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Vales pagoda </td>
                                            <td><input name="valespagodaSistema" value="{{ $data->valespagoda }}"
                                                    type="number" class="form-control" step="0.01" readonly
                                                    placeholder="0.00"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td> Monto cheques</td>
                                            <td> <input name="CheckAmtSistema" value="{{ $data->CheckAmt }}"
                                                    type="number" class="form-control" step="0.01" readonly
                                                    placeholder="0.00">
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td> Loteria</td>
                                            <td> <input name="LotoAmtSistema" value="{{ $data->LotoAmt }}"
                                                    type="number" class="form-control" step="0.01" readonly
                                                    placeholder="0.00">
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Vale</td>
                                            <td> <input name="valeAmt" value="{{ $data->CreditAmt }}" type="number"
                                                    class="form-control" step="0.01" readonly placeholder="0.00">
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Tarjetas </td>
                                            <td> <input name="CardAmtSistema" value="{{ $data->CardAmt }}"
                                                    type="number" class="form-control" step="0.01" readonly
                                                    placeholder="0.00">
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input disabled sstep="0.01" class="form-control">
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input disabled sstep="0.01" class="form-control">
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input disabled sstep="0.01" class="form-control">
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input disabled sstep="0.01" class="form-control">
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input disabled step="0.01" class="form-control">
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td> Sencillo </td>
                                            <td><input name="CashAmtSistema" value="{{ $data->CashAmt }}" type="number"
                                                    class="form-control" step="0.01" readonly placeholder="0.00">
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Rollos </td>
                                            <td> <input name="CoinRollSistema" value="{{ $data->CoinRoll }}"
                                                    type="number" class="form-control" step="0.01" readonly
                                                    placeholder="0.00">
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Facturas </td>
                                            <td> <input name="InvoiceAmtSistema" value="{{ $data->InvoiceAmt }}"
                                                    type="number" class="form-control" step="0.01" readonly
                                                    placeholder="0.00">
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input disabled step="0.01" class="form-control">
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:12px; ">Vale digital </td>
                                            <td> <input name="VoucherAmtSistema" value="{{ $data->VoucherAmt }}"
                                                    type="number" class="form-control" step="0.01" readonly
                                                    placeholder="0.00">
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Beca digital </td>
                                            <td> <input name="GrantAmtSistema" value="{{ $data->GrantAmt }}"
                                                    type="number" class="form-control" step="0.01" readonly
                                                    placeholder="0.00">
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Subtotal super</td>
                                            <td></td>
                                            <td align="right">
                                                <h6 id="Monto_Subtotal_Sistema" name="sub_total_super_sistema">
                                                    {{ $data->SubTotal }}
                                                </h6>
                                                <input hidden name="sub_total_super_sistema"
                                                    value="{{ $data->SubTotal }}">
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br><br>
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead id="miTablaPersonalizada">
                                        <tr>
                                            <th style="width: 200px;">
                                                <h4 class="mb-0">Monto contado</h4>
                                            </th>
                                            <th style="width: 0px;">

                                            </th>
                                            <th>
                                                <h5 class="mb-0 fw-bold" id="Monto_contado_Sistema"
                                                    name="monto_contado_sistema" align="right">
                                                    {{ $data->NetTotal }}</h5>

                                                <input hidden name="monto_contado_sistema" value="{{ $data->NetTotal }}">
                                            </th>
                                            <th>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>Monto X </td>
                                            <td></td>
                                            <td align="right">
                                                <h6 id="Monto_X_Sistema" name="monto_x_sistema">{{ $data->XAmt }}</h6>
                                                <input hidden name="monto_x_sistema" value="{{ $data->XAmt }}">
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Diferencia</td>
                                            <td></td>
                                            <td align="right">@php
                                                echo number_format($data->DifferenceAmt, 2, ',', ' ');
                                            @endphp
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card" id="card_fiscalizadora">
                        <div class="card-body">
                            <h5 class="card-title"> <b> Fiscalizadora</b></h5>
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead id="miTablaPersonalizada">
                                        <tr>
                                            <th>
                                                <p class="card-text">Efectivo</p>
                                            </th>
                                            <th> </th>
                                            <th align="right">
                                                <h5 align="right" class="mb-0 fw-bold text-success"
                                                    id="Fiscalizadora_t">0
                                                </h5>
                                            </th>
                                            <th align="right">
                                                <div align="right">Diferencia</div>
                                            </th>
                                            <th style="width: 23px;">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>$1 *</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->x_oneamtFiscalizadora }}"
                                                            name="x_oneamtFiscalizadora" type="number"
                                                            class="form-control"
                                                            class="text-left  form-control form-control"placeholder="0.00"
                                                            onchange="cal();clonx_oneamtFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonx_oneamtFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" name="x_oneamtFiscalizadora" type="number"
                                                        class="form-control"
                                                        class="text-left  form-control"placeholder="0.00"
                                                        onchange="cal();clonx_oneamtFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonx_oneamtFiscalizadora();cal();colores()">
                                                @endif
                                            </td>
                                            <td align="right">
                                                <div class="col borde" id="x_oneamtFiscalizadora_t">
                                                    {{ $data->x_oneamt * 1 }}</div>
                                            </td>
                                            <td align="right">
                                                <div class="col borde text-success" id="x_oneamtFiscalizadora_r"
                                                    style="padding-left: 10px;">0.00</div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>$5 *</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->x_fiveamtFiscalizadora }}"
                                                            name="x_fiveamtFiscalizadora" type="number"
                                                            class="form-control"
                                                            class="text-left  form-control form-control"
                                                            placeholder="0.00"
                                                            onchange="cal();clonx_fiveamtFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonx_fiveamtFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" name="x_fiveamtFiscalizadora" type="number"
                                                        class="form-control" class="text-left  form-control"
                                                        placeholder="0.00"
                                                        onchange="cal();clonx_fiveamtFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonx_fiveamtFiscalizadora();cal();colores()">
                                                @endif
                                            </td>
                                            <td align="right">
                                                <div class="col borde" id="x_fiveamtFiscalizadora_t">
                                                    {{ $data->x_fiveamt * 5 }}</div>
                                            </td>
                                            <td align="right">
                                                <div class="col borde text-success" id="x_fiveamtFiscalizadora_r"
                                                    style="padding-left: 10px;">0.00</div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>$10 *</td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->x_tenamtFiscalizadora }}"
                                                            name="x_tenamtFiscalizadora" type="number"
                                                            class="form-control" class="text-left  form-control"
                                                            placeholder="0.00"
                                                            onchange="cal();clonx_tenamtFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonx_tenamtFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" name="x_tenamtFiscalizadora" type="number"
                                                        class="form-control" class="text-left  form-control"
                                                        placeholder="0.00"
                                                        onchange="cal();clonx_tenamtFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonx_tenamtFiscalizadora();cal();colores()">
                                                @endif

                                            </td>
                                            <td align="right">
                                                <div class="col borde" id="x_tenamtFiscalizadora_t">
                                                    {{ $data->x_tenamt * 10 }}</div>
                                            </td>
                                            <td align="right">
                                                <div class="col borde text-success" id="x_tenamtFiscalizadora_r"
                                                    style="padding-left: 10px;">0.00</div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>$20 *</td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->x_twentyamtFiscalizadora }}"
                                                            name="x_twentyamtFiscalizadora" type="number"
                                                            class="form-control" class="text-left  form-control"
                                                            placeholder="0.00"
                                                            onchange="cal();clonx_twentyamtFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonx_twentyamtFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" name="x_twentyamtFiscalizadora" type="number"
                                                        class="form-control" class="text-left  form-control"
                                                        placeholder="0.00"
                                                        onchange="cal();clonx_twentyamtFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonx_twentyamtFiscalizadora();cal();colores()">
                                                @endif
                                            </td>
                                            <td align="right">
                                                <div class="col borde" id="x_twentyamtFiscalizadora_t">
                                                    {{ $data->x_twentyamt * 20 }}</div>
                                            <td align="right">
                                                <div class="col borde text-success" id="x_twentyamtFiscalizadora_r"
                                                    style="padding-left: 10px;">
                                                    0.00</div>
                                            </td>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>$50 *</td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->x_fiftyamtFiscalizadora }}"
                                                            name="x_fiftyamtFiscalizadora" type="number"
                                                            class="form-control" class="text-left  form-control"
                                                            placeholder="0.00"
                                                            onchange="cal();clonx_fiftyamtFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonx_fiftyamtFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" name="x_fiftyamtFiscalizadora" type="number"
                                                        class="form-control" class="text-left  form-control"
                                                        placeholder="0.00"
                                                        onchange="cal();clonx_fiftyamtFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonx_fiftyamtFiscalizadora();cal();colores()">
                                                @endif

                                            </td>
                                            <td align="right">
                                                <div class="col borde" id="x_fiftyamtFiscalizadora_t">
                                                    {{ $data->x_fiftyamt * 50 }} </div>
                                            </td>
                                            <td align="right">
                                                <div class="col borde text-success" id="x_fiftyamtFiscalizadora_r"
                                                    style="padding-left: 10px;">0.00</div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>$100 *</td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->x_hundredamtFiscalizadora }}"
                                                            name="x_hundredamtFiscalizadora" type="number"
                                                            class="form-control" class="text-left  form-control"
                                                            placeholder="0.00"
                                                            onchange="cal();clonx_hundredamtFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonx_hundredamtFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" name="x_hundredamtFiscalizadora" type="number"
                                                        class="form-control" class="text-left  form-control"
                                                        placeholder="0.00"
                                                        onchange="cal();clonx_hundredamtFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonx_hundredamtFiscalizadora();cal();colores()">
                                                @endif


                                            <td align="right">
                                                <div class="col borde" id="x_hundredamtFiscalizadora_t">
                                                    {{ $data->x_hundredamt * 100 }} </div>
                                            </td>
                                            <td align="right">
                                                <div class="col borde text-success" id="x_hundredamtFiscalizadora_r"
                                                    style="padding-left: 10px;">
                                                    0.00</p>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <br><br>
                            <div class="table-responsive">
                                <table class="table table table-borderless">
                                    <thead id="miTablaPersonalizada">
                                        <tr>
                                            <th> Otros</th>
                                            <th></th>
                                            <th align="right">
                                                <h5 align="right" class="mb-0 fw-bold text-success"
                                                    id="Otros_Fiscalizadora_t">0</h5>
                                            </th>
                                            <th align="right">
                                                <div align="right">Diferencia</div>
                                            </th>
                                            <th style="width: 23px;">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Yappy</td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->yappyFiscalizadora }}"
                                                            id="yappyFiscalizadora" name="yappyFiscalizadora"
                                                            type="number" class="form-control" step="0.01"
                                                            placeholder="0.00"
                                                            onchange="cal();clonyappyFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonyappyFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" id="yappyFiscalizadora"
                                                        name="yappyFiscalizadora" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00"
                                                        onchange="cal();clonyappyFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonyappyFiscalizadora();cal();colores()">
                                                @endif


                                            </td>
                                            <td></td>
                                            <td align="right">
                                                <div class="col borde text-success" id="yappyFiscalizadora_r">0.0
                                                </div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Otros</td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="otrosFiscalizadora" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();clonotrosFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonotrosFiscalizadora();cal();colores()"
                                                            value="{{ $dataday->otrosFiscalizadora }}">
                                                    @endforeach
                                                @else
                                                    <input name="otrosFiscalizadora" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00"
                                                        onchange="cal();clonotrosFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonotrosFiscalizadora();cal();colores()"
                                                        value="">
                                                @endif

                                            </td>
                                            <td></td>
                                            <td align="right">
                                                <div class="col borde text-success" id="otrosFiscalizadora_r">0.0
                                                </div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Primera parte</td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="otrosprimeroFiscalizadora" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();clonotrosprimeroFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonotrosprimeroFiscalizadora();cal();colores()"
                                                            value="{{ $dataday->otrosprimeroFiscalizadora }}">
                                                    @endforeach
                                                @else
                                                    <input name="otrosprimeroFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clonotrosprimeroFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonotrosprimeroFiscalizadora();cal();colores()"
                                                        value="">
                                                @endif

                                            </td>
                                            <td></td>
                                            <td align="right">
                                                <div class="col borde text-success" id="otrosprimeroFiscalizadora_r">
                                                </div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Vales pagoda </td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="valespagodaFiscalizadora" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();clonvalespagodaFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonvalespagodaFiscalizadora();cal();colores()"
                                                            value="{{ $dataday->valespagodaFiscalizadora }}">
                                                    @endforeach
                                                @else
                                                    <input name="valespagodaFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clonvalespagodaFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonvalespagodaFiscalizadora();cal();colores()"
                                                        value="">
                                                @endif
                                            </td>

                                            </td>
                                            <td></td>
                                            <td align="right">
                                                <div class="col borde text-success" id="valespagodaFiscalizadora_r">
                                                    0.0</div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Monto cheques</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="CheckAmtFiscalizadora" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();clonCheckAmtFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonCheckAmtFiscalizadora();cal();colores()"
                                                            value="{{ $dataday->CheckAmtFiscalizadora }}">
                                                    @endforeach
                                                @else
                                                    <input name="CheckAmtFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clonCheckAmtFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonCheckAmtFiscalizadora();cal();colores()"
                                                        value="">
                                                @endif
                                            </td>
                                            <td></td>
                                            <td align="right">
                                                <div class="col borde text-success" id="CheckAmtFiscalizadora_r">
                                                    0.0
                                                </div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Loteria</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="LotoAmtFiscalizadora" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();clonLotoAmtFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonLotoAmtFiscalizadora();cal();colores()"
                                                            value="{{ $dataday->LotoAmtFiscalizadora }}">
                                                    @endforeach
                                                @else
                                                    <input name="LotoAmtFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clonLotoAmtFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonLotoAmtFiscalizadora();cal();colores()"
                                                        value="">
                                                @endif
                                            </td>
                                            <td></td>
                                            <td align="right">
                                                <div class="col borde text-success" id="LotoAmtFiscalizadora_r">
                                                    0.0
                                                </div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Vale</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->valeAmtFiscalizadora }}"
                                                            name="valeAmtFiscalizadora" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();clonvaleAmtFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonvaleAmtFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" name="valeAmtFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clonvaleAmtFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonvaleAmtFiscalizadora();cal();colores()">
                                                @endif
                                            </td>
                                            <td></td>
                                            <td align="right">
                                                <div class="col borde text-success" id="valeAmtFiscalizadora_r">
                                                    0.0
                                                </div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta clave</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->CardClaveFiscalizadora }}"
                                                            name="CardClaveFiscalizadora" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();clonCardClaveFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonCardClaveFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" name="CardClaveFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clonCardClaveFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonCardClaveFiscalizadora();cal();colores()">
                                                @endif
                                            </td>
                                            <td></td>
                                            <td align="right">
                                                <div style="visibility: hidden;" class="col borde text-success"
                                                    id="CardClaveFiscalizadora_r">0.0</div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta vale</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->CardValeFiscalizadora }}"
                                                            name="CardValeFiscalizadora" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();clonCardValeFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonCardValeFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" name="CardValeFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clonCardValeFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonCardValeFiscalizadora();cal();colores()">
                                                @endif

                                            </td>
                                            <td></td>
                                            <td align="right">
                                                <div style="visibility: hidden;" class="col borde text-success"
                                                    id="CardValeFiscalizadora_r">0.0</div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta visa</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->CardVisaFiscalizadora }}"
                                                            name="CardVisaFiscalizadora" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();clonCardVisaFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonCardVisaFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" name="CardVisaFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clonCardVisaFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonCardVisaFiscalizadora();cal();colores()">
                                                @endif
                                            </td>
                                            <td></td>
                                            <td align="right">
                                                <div class="col borde text-success" id="CardVisaFiscalizadora_r">
                                                    0.0
                                                </div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta master</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->CardMasterFiscalizadora }}"
                                                            name="CardMasterFiscalizadora" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();clonCardMasterFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonCardMasterFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" name="CardMasterFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clonCardMasterFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonCardMasterFiscalizadora();cal();colores()">
                                                @endif
                                            </td>
                                            <td></td>
                                            <td align="right">
                                                <div style="visibility: hidden;" class="col borde text-success"
                                                    id="CardMasterFiscalizadora_r">0.0</div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta american</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->CardAEFiscalizadora }}"
                                                            name="CardAEFiscalizadora" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();clonCardAEFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonCardAEFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" name="CardAEFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clonCardAEFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonCardAEFiscalizadora();cal();colores()">
                                                @endif
                                            </td>
                                            <td></td>
                                            <td align="right">
                                                <div style="visibility: hidden;" class="col borde text-success"
                                                    id="CardAEFiscalizadora_r">0.0</div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta bac</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->CardBACFiscalizadora }}"
                                                            name="CardBACFiscalizadora" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();clonCardBACFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonCardBACFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" name="CardBACFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clonCardBACFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonCardBACFiscalizadora();cal();colores()">
                                                @endif
                                            </td>
                                            <td></td>
                                            <td align="right">
                                                <div style="visibility: hidden;" class="col borde text-success"
                                                    id="CardBACFiscalizadora_r">0.0</div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sencillo</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->CashAmtFiscalizadora }}"
                                                            name="CashAmtFiscalizadora" value="" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();clonCashAmtFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonCashAmtFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" name="CashAmtFiscalizadora" value=""
                                                        type="number" class="form-control" step="0.01"
                                                        placeholder="0.00"
                                                        onchange="cal();clonCashAmtFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonCashAmtFiscalizadora();cal();colores()">
                                                @endif
                                            </td>
                                            <td></td>
                                            <td align="right">
                                                <div class="col borde text-success" id="CashAmtFiscalizadora_r">
                                                    0.0
                                                </div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Rollos </td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->CoinRollFiscalizadora }}"
                                                            name="CoinRollFiscalizadora" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();clonCoinRollFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonCoinRollFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" name="CoinRollFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clonCoinRollFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonCoinRollFiscalizadora();cal();colores()">
                                                @endif
                                            </td>
                                            <td></td>
                                            <td align="right">
                                                <div class="col borde text-success" id="CoinRollFiscalizadora_r">
                                                    0.0
                                                </div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Facturas</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->InvoiceAmtFiscalizadora }}"
                                                            name="InvoiceAmtFiscalizadora" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();clonInvoiceAmtFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonInvoiceAmtFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" name="InvoiceAmtFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clonInvoiceAmtFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonInvoiceAmtFiscalizadora();cal();colores()">
                                                @endif
                                            </td>
                                            <td></td>
                                            <td align="right">
                                                <div class="col borde text-success" id="InvoiceAmtFiscalizadora_r">
                                                    0.0</div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Facturas propias</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->InvoiceAmtPropiasFiscalizadora }}"
                                                            name="InvoiceAmtPropiasFiscalizadora" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();clonInvoiceAmtPropiasFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonInvoiceAmtPropiasFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" name="InvoiceAmtPropiasFiscalizadora"
                                                        type="number" class="form-control" step="0.01"
                                                        placeholder="0.00"
                                                        onchange="cal();clonInvoiceAmtPropiasFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonInvoiceAmtPropiasFiscalizadora();cal();colores()">
                                                @endif
                                            </td>
                                            <td></td>
                                            <td align="right">
                                                <div style="visibility: hidden;" class="col borde text-success"
                                                    id="InvoiceAmtPropiasFiscalizadora_r"></div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Vale digital </td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->VoucherAmtFiscalizadora }}"
                                                            name="VoucherAmtFiscalizadora" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();clonVoucherAmtFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonVoucherAmtFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" name="VoucherAmtFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clonVoucherAmtFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonVoucherAmtFiscalizadora();cal();colores()">
                                                @endif
                                            </td>
                                            <td></td>
                                            <td align="right">
                                                <div class="col borde text-success" id="VoucherAmtFiscalizadora_r">
                                                    0.0</div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Beca digital </td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->GrantAmtFiscalizadora }}"
                                                            name="GrantAmtFiscalizadora" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();clonGrantAmtFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonGrantAmtFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" name="GrantAmtFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clonGrantAmtFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonGrantAmtFiscalizadora();cal();colores()">
                                                @endif
                                            </td>
                                            <td></td>
                                            <td align="right">
                                                <div class="col borde text-success" id="GrantAmtFiscalizadora_r">
                                                    0.0
                                                </div>
                                            </td>
                                            <td>
                                                <input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <br><br>

                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead id="miTablaPersonalizada">
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th align="right">
                                            </th>
                                            <th align="right">

                                            </th>
                                            <th style="width: 23px;">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Sencillo Supervisora</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input value="{{ $dataday->SencilloSupervisoraFiscalizadora }}"
                                                            name="SencilloSupervisoraFiscalizadora" type="number"
                                                            step="0.01" class="form-control"
                                                            class="text-left  form-control" placeholder="0.00"
                                                            onchange="cal();clonSencilloSupervisoraFiscalizadora();cal();colores()"
                                                            onkeyup="cal();clonSencilloSupervisoraFiscalizadora();cal();colores()">
                                                    @endforeach
                                                @else
                                                    <input value="" name="SencilloSupervisoraFiscalizadora"
                                                        type="number" class="form-control"
                                                        class="text-left  form-control" placeholder="0.00"
                                                        step="0.01"
                                                        onchange="cal();clonSencilloSupervisoraFiscalizadora();cal();colores()"
                                                        onkeyup="cal();clonSencilloSupervisoraFiscalizadora();cal();colores()">
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total panaderia</td>
                                            <td><input name="totalPanaderiaFiscalizadora" type="number"
                                                    class="form-control" step="0.01" placeholder="0.00"
                                                    onchange="cal();clontotalPanaderiaFiscalizadora();cal();colores()"
                                                    onkeyup="cal();clontotalPanaderiaFiscalizadora();cal();colores()"
                                                    @if ($list->isNotEmpty()) @foreach ($list as $dataday)
                                            value="{{ $dataday->totalPanaderiaFiscalizadora }}"
                                            @endforeach
                                            @else
                                                value="" @endif>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td><input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Total pagatodo</td>
                                            <td><input name="totalPagatodoFiscalizadora" type="number"
                                                    class="form-control" step="0.01" placeholder="0.00"
                                                    onchange="cal();clontotalPagatodoFiscalizadora();cal();colores()"
                                                    onkeyup="cal();clontotalPagatodoFiscalizadora();cal();colores()"
                                                    @if ($list->isNotEmpty()) @foreach ($list as $dataday)
                                            value="{{ $dataday->totalPagatodoFiscalizadora }}"
                                            @endforeach
                                            @else
                                                value="" @endif>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td><input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total super</td>
                                            <td> <input name="totalsuperFiscalizadora" type="number"
                                                    class="form-control" step="0.01" placeholder="0.00"
                                                    onchange="cal();clontotalsuperFiscalizadora();cal();colores()"
                                                    onkeyup="cal();clontotalsuperFiscalizadora();cal();colores()"
                                                    @if ($list->isNotEmpty()) @foreach ($list as $dataday)
                                                value="{{ $dataday->totalsuperFiscalizadora }}"
                                                @endforeach
                                                @else
                                                value="" @endif>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td><input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dinero de taxi</td>
                                            <td><input name="dineroTaxiFiscalizadora" type="number"
                                                    class="form-control" step="0.01" placeholder="0.00"
                                                    onchange="cal();clondineroTaxiFiscalizadora();cal();colores()"
                                                    onkeyup="cal();clondineroTaxiFiscalizadora();cal();colores()"
                                                    @if ($list->isNotEmpty()) @foreach ($list as $dataday)
                                                value="{{ $dataday->dineroTaxiFiscalizadora }}"
                                                @endforeach
                                                @else
                                                value="" @endif>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td><input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Vuelto de mercado</td>
                                            <td><input name="vueltoMercadoFiscalizadora" type="number"
                                                    class="form-control" step="0.01" placeolder="0.00"
                                                    onchange="cal();clonvueltoMercadoFiscalizadora();cal();colores()"
                                                    onkeyup="cal();clonvueltoMercadoFiscalizadora();cal();colores()"
                                                    @if ($list->isNotEmpty()) @foreach ($list as $dataday)
                                                value="{{ $dataday->vueltoMercadoFiscalizadora }}"
                                                @endforeach
                                                @else
                                                value="" @endif>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td><input style="visibility: hidden;" class="form-check-input"
                                                    type="checkbox" value="1" id="check_" name="check_">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Comentarios</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <textarea name="comentariosFiscalizadora" value="" placeholder="Comentarios" class="form-control">{{ $dataday->comentariosFiscalizadora }}</textarea>
                                                    @endforeach
                                                @else
                                                    <textarea name="comentariosFiscalizadora" value="" placeholder="Comentarios" class="form-control"></textarea>
                                                @endif
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-borderless">

                                    <thead id="miTablaPersonalizada">
                                        <tr>
                                            <td>Subtotal super</td>
                                            <td></td>
                                            <td align="right">
                                                <h6 class="mb-0 text-success" id="Monto_Fiscalizadora_t"></h6>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <h4 class="mb-0">Monto contado</h4>
                                            </th>
                                            <th></th>
                                            <th align="right">
                                                <h5 class="mb-0 fw-bold text-success" id="Monto_contado_Fiscalizadora"
                                                    align="right">

                                                </h5>
                                            </th>
                                            <th align="right">

                                            </th>
                                            <th style="width: 23px;">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>Monto X</td>
                                            <td></td>
                                            <td align="right">
                                                <h6 class="mb-0" id="Monto_X_Fiscalizadora">{{ $data->XAmt }}
                                                </h6>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Diferencia</td>
                                            <td></td>
                                            <td align="right">
                                                <h6 class="mb-0" id="Diferencia_Fiscalizadora">
                                                    {{ $data->DifferenceAmt }}</h6>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="form-check checkbox-xl text-center">
                                <div class="form-check checkbox-xl text-center">
                                    @if ($list->isNotEmpty())
                                        @foreach ($list as $dataday)
                                            @if ($dataday->check_fis == 1)
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_fis" name="check_fis"
                                                    style="margin-left: 1px;margin-left: 50%;margin-right: 1px;margin-top: 1px;margin-bottom: 1px;"
                                                    checked>
                                            @else
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_fis" name="check_fis"
                                                    style="margin-left: 1px;margin-left: 50%;margin-right: 1px;margin-top: 1px;margin-bottom: 1px;">
                                            @endif
                                        @endforeach
                                    @else
                                        <input class="form-check-input" type="checkbox" value="1"
                                            id="check_fis" name="check_fis"
                                            style="margin-left: 1px;margin-left: 50%;margin-right: 1px;margin-top: 1px;margin-bottom: 1px;">
                                    @endif
                                </div>
                            </div>
                            <p class="form-check-label text-center">Verificado por fiscalizadora</p> --}}
                        </div>

                    </div>

                    <div style="display:none" class="card" id="card_gerente">
                        <div class="card-body">

                            <h5 class="card-title"><b>Gerente</b>
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead id="miTablaPersonalizada">
                                        <tr>
                                            <th>Efectivo</th>
                                            <th> </th>

                                            <th align="right">
                                                <h5 align="right" class="mb-0 fw-bold text-success" id="Gerente_t">0
                                                </h5>
                                            </th>
                                            <th align="right">
                                                <div align="right" id="">
                                                    Diferencia</div>
                                            </th>
                                            <th style="width: 23px;">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>$1 * </td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="x_oneamtGerente" type="number"
                                                            class="form-control" class="text-left  form-control"
                                                            placeholder="0.00" onchange="cal();colores()"
                                                            onkeyup="cal();colores()"
                                                            value="{{ $dataday->x_oneamtGerente }}" />
                                                    @endforeach
                                                @else
                                                    <input name="x_oneamtGerente" type="number" class="form-control"
                                                        class="text-left  form-control" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="" />
                                                @endif
                                            </td>
                                            <td align="right">
                                                <div class="col borde" id="x_oneamtGerente_t">0.00</div>
                                            </td>
                                            <td align="right">
                                                <div class="col borde text-success" id="x_oneamtGerente_r">0.00</div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_x_oneamtGerente" name="check_x_oneamtGerente"
                                                    {{ isset($dataday->check_x_oneamtGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>$5 *</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="x_fiveamtGerente" type="number"
                                                            class="form-control" class="text-left  form-control"
                                                            placeholder="0.00" onchange="cal();colores()"
                                                            onkeyup="cal();colores()"
                                                            value="{{ $dataday->x_fiveamtGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="x_fiveamtGerente" type="number" class="form-control"
                                                        class="text-left  form-control" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="">
                                                @endif
                                            </td>

                                            <td align="right">
                                                <div class="col borde" id="x_fiveamtGerente_t">
                                                    0.00</div>
                                            </td>
                                            <td align="right">
                                                <div class="col borde text-success" id="x_fiveamtGerente_r">0.00</div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_x_fiveamtGerente" name="check_x_fiveamtGerente"
                                                    {{ isset($dataday->check_x_fiveamtGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>$10 *</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="x_tenamtGerente" type="number"
                                                            class="form-control" class="text-left  form-control"
                                                            placeholder="0.00" onchange="cal();colores()"
                                                            onkeyup="cal();colores()"
                                                            value="{{ $dataday->x_tenamtGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="x_tenamtGerente" type="number" class="form-control"
                                                        class="text-left  form-control" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="">
                                                @endif
                                            </td>

                                            <td align="right">
                                                <div class="col borde" id="x_tenamtGerente_t">
                                                    0.00</div>
                                            </td>
                                            <td align="right">
                                                <div class="col borde text-success" id="x_tenamtGerente_r">0.00</div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_x_tenamtGerente" name="check_x_tenamtGerente"
                                                    {{ isset($dataday->check_x_tenamtGerente) ? __('checked') : __('') }}>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>$20 *</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="x_twentyamtGerente" type="number"
                                                            class="form-control" class="text-left  form-control"
                                                            placeholder="0.00" onchange="cal();colores()"
                                                            onkeyup="cal();colores()"
                                                            value="{{ $dataday->x_twentyamtGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="x_twentyamtGerente" type="number"
                                                        class="form-control" class="text-left  form-control"
                                                        placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()" value="">
                                                @endif
                                            </td>

                                            <td align="right">
                                                <div class="col borde" id="x_twentyamtGerente_t">
                                                    0.00</div>
                                            </td>
                                            <td align="right">
                                                <div class="col borde text-success" id="x_twentyamtGerente_r">0.00</div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_x_twentyamtGerente" name="check_x_twentyamtGerente"
                                                    {{ isset($dataday->check_x_twentyamtGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>$50 *</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="x_fiftyamtGerente" type="number"
                                                            class="form-control" class="text-left  form-control"
                                                            placeholder="0.00" onchange="cal();colores()"
                                                            onkeyup="cal();colores()"
                                                            value="{{ $dataday->x_fiftyamtGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="x_fiftyamtGerente" type="number"
                                                        class="form-control" class="text-left  form-control"
                                                        placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()" value="">
                                                @endif
                                            </td>

                                            <td align="right">
                                                <div class="col borde" id="x_fiftyamtGerente_t">
                                                    0.00</div>
                                            </td>
                                            <td align="right">
                                                <div class="col borde text-success" id="x_fiftyamtGerente_r">0.00</div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_x_fiftyamtGerente" name="check_x_fiftyamtGerente"
                                                    {{ isset($dataday->check_x_fiftyamtGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>$100 *</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="x_hundredamtGerente" type="number"
                                                            class="form-control" class="text-left  form-control"
                                                            placeholder="0.00" onchange="cal();colores()"
                                                            onkeyup="cal();colores()"
                                                            value="{{ $dataday->x_hundredamtGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="x_hundredamtGerente" type="number"
                                                        class="form-control" class="text-left  form-control"
                                                        placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()" value="">
                                                @endif
                                            </td>

                                            <td align="right">
                                                <div class="col borde" id="x_hundredamtGerente_t">
                                                    0.00</div>
                                            </td>
                                            <td align="right">
                                                <div class="col borde text-success" id="x_hundredamtGerente_r">0.00
                                                </div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_x_hundredamtGerente" name="check_x_hundredamtGerente"
                                                    {{ isset($dataday->check_x_hundredamtGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                            <br><br>
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead id="miTablaPersonalizada">
                                        <tr>
                                            <th>Otros</th>
                                            <th>
                                            </th>
                                            <th align="right">
                                                <h5 align="right" class="mb-0 fw-bold text-success"
                                                    id="Otros_Gerente_t">
                                                    0</h5>
                                            </th>
                                            <th align="right">
                                                <div align="right" id="">
                                                    Diferencia</div>
                                            </th>
                                            <th style="width: 23px;">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Yappy</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input id="yappyGerente" name="yappyGerente" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();colores()" onkeyup="cal();colores()"
                                                            value="{{ $dataday->yappyGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="yappyGerente" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()" value="">
                                                @endif
                                            </td>
                                            <th>
                                                <div style="visibility: hidden;" class="col borde text-success"
                                                    id="yappyGerente_t">0.0</div>
                                            </th>
                                            <td align="right">
                                                <div class="col borde text-success" id="yappyGerente_r">0.0</div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_yappyGerente" name="check_yappyGerente"
                                                    {{ isset($dataday->check_x_yappyGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Otros</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="otrosGerente" type="number" class="form-control"
                                                            step="0.01" placeholder="0.00"
                                                            onchange="cal();colores()" onkeyup="cal();colores()"
                                                            value="{{ $dataday->otrosGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="otrosGerente" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()" value="">
                                                @endif
                                            </td>
                                            <th>
                                                <div style="visibility: hidden;" class="col borde text-success"
                                                    id="otrosGerente_t">0.0</div>
                                            </th>
                                            <td align="right">
                                                <div class="col borde text-success" id="otrosGerente_r">0.0</div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_otrosGerente" name="check_otrosGerente"
                                                    {{ isset($dataday->check_x_otrosGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Primera parte</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="otrosprimeroGerente" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();colores()" onkeyup="cal();colores()"
                                                            value="{{ $dataday->otrosprimeroGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="otrosprimeroGerente" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="">
                                                @endif
                                            </td>
                                            <th>
                                                <div style="visibility: hidden;" class="col borde text-success"
                                                    id="otrosprimeroGerente_t">0.0</div>
                                            </th>
                                            <td align="right">
                                                <div class="col borde text-success" id="otrosprimeroGerente_r">0.0</div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_otrosprimeroGerente" name="check_otrosprimeroGerente"
                                                    {{ isset($dataday->check_x_otrosprimeroGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Vales pagoda </td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="valespagodaGerente" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();colores()" onkeyup="cal();colores()"
                                                            value="{{ $dataday->valespagodaGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="valespagodaGerente" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="">
                                                @endif
                                            </td>
                                            <th>
                                                <div style="visibility: hidden;" class="col borde text-success"
                                                    id="valespagodaGerente_t">0.0</div>
                                            </th>
                                            <td align="right">
                                                <div class="col borde text-success" id="valespagodaGerente_r">0.0
                                                </div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_valespagodaGerente" name="check_valespagodaGerente"
                                                    {{ isset($dataday->check_x_valespagodaGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Monto cheques</td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="CheckAmtGerente" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();colores()" onkeyup="cal();colores()"
                                                            value="{{ $dataday->CheckAmtGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="CheckAmtGerente" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()" value="">
                                                @endif
                                            </td>
                                            <th>
                                                <div style="visibility: hidden;" class="col borde text-success"
                                                    id="CheckAmtGerente_t">0.0</div>
                                            </th>
                                            <td align="right">
                                                <div class="col borde text-success" id="CheckAmtGerente_r">0.0
                                                </div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_CheckAmtGerente" name="check_CheckAmtGerente"
                                                    {{ isset($dataday->check_x_CheckAmtGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Loteria</td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="LotoAmtGerente" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();colores()" onkeyup="cal();colores()"
                                                            value="{{ $dataday->LotoAmtGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="LotoAmtGerente" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()" value="">
                                                @endif
                                            </td>
                                            <th>
                                                <div style="visibility: hidden;" class="col borde text-success"
                                                    id="LotoAmtGerente_t">0.0</div>
                                            </th>
                                            <td align="right">
                                                <div class="col borde text-success" id="LotoAmtGerente_r">0.0
                                                </div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_LotoAmtGerente" name="check_LotoAmtGerente"
                                                    {{ isset($dataday->check_x_LotoAmtGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Vale</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="valeAmtGerente" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();colores()" onkeyup="cal();colores()"
                                                            value="{{ $dataday->valeAmtGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="valeAmtGerente" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()" value="">
                                                @endif
                                            </td>
                                            <th>
                                                <div style="visibility: hidden;" class="col borde"
                                                    id="valeAmtGerente_t">
                                                    0.0
                                                </div>
                                            </th>
                                            <td align="right">
                                                <div class="col borde text-success" id="valeAmtGerente_r">0.0
                                                </div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_valeAmtGerente" name="check_valeAmtGerente"
                                                    {{ isset($dataday->check_x_valeAmtGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta clave</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="CardClaveGerente" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();colores()" onkeyup="cal();colores()"
                                                            value="{{ $dataday->CardClaveGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="CardClaveGerente" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()" value="">
                                                @endif
                                            </td>
                                            <th>
                                                <div style="visibility: hidden;" class="col borde text-success"
                                                    id="CardClaveGerente_t">0.00</div>
                                            </th>
                                            <td align="right">
                                                <div style="visibility: hidde;" class="col borde text-success"
                                                    id="CardClaveGerente_r">0.0</div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_CardClaveGerente" name="check_CardClaveGerente"
                                                    {{ isset($dataday->check_x_CardClaveGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta vale</td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="CardValeGerente" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();colores()" onkeyup="cal();colores()"
                                                            value="{{ $dataday->CardValeGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="CardValeGerente" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()" value="">
                                                @endif
                                            </td>
                                            <th>
                                                <div style="visibility: hidden;" style="visibility: hidde;"
                                                    class="col borde text-success" id="CardValeGerente_t">0.0
                                                </div>
                                            </th>
                                            <td align="right">
                                                <div style="visibility: hidde;" class="col borde text-success"
                                                    id="CardValeGerente_r">0.0</div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_CardValeGerente" name="check_CardValeGerente"
                                                    {{ isset($dataday->check_x_CardValeGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta visa</td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="CardVisaGerente" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();colores()" onkeyup="cal();colores()"
                                                            value="{{ $dataday->CardVisaGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="CardVisaGerente" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()" value="">
                                                @endif
                                            </td>
                                            <th>
                                                <div style="visibility: hidden;" class="col borde text-success"
                                                    id="CardVisaGerente_t">0.0</div>
                                            </th>
                                            <td align="right">
                                                <div class="col borde text-success" id="CardVisaGerente_r">0.0
                                                </div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_CardVisaGerente" name="check_CardVisaGerente"
                                                    {{ isset($dataday->check_x_CardVisaGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta master</td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="CardMasterGerente" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();colores()" onkeyup="cal();colores()"
                                                            value="{{ $dataday->CardMasterGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="CardMasterGerente" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="">
                                                @endif
                                            </td>
                                            <th>
                                                <div style="visibility: hidden;" style="visibility: hidde;"
                                                    class="col borde text-success" id="CardMasterGerente_t">0.00
                                                </div>
                                            </th>
                                            <td align="right">
                                                <div style="visibility: hidde;" class="col borde text-success"
                                                    id="CardMasterGerente_r">0.0</div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_CardMasterGerente" name="check_CardMasterGerente"
                                                    {{ isset($dataday->check_x_CardMasterGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta american</td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="CardAEGerente" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();colores()" onkeyup="cal();colores()"
                                                            value="{{ $dataday->CardAEGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="CardAEGerente" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()" value="">
                                                @endif
                                            </td>
                                            <th>
                                                <div style="visibility: hidden;" style="visibility: hidde;"
                                                    class="col borde text-success" id="CardAEGerente_t">0.00</div>
                                            </th>
                                            <td align="right">
                                                <div style="visibility: hidde;" class="col borde text-success"
                                                    id="CardAEGerente_r">0.0</div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_CardAEGerente" name="check_CardAEGerente"
                                                    {{ isset($dataday->check_x_CardAEGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta bac</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="CardBACGerente" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();colores()" onkeyup="cal();colores()"
                                                            value="{{ $dataday->CardBACGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="CardBACGerente" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()" value="">
                                                @endif
                                            </td>
                                            <th>
                                                <div style="visibility: hidden;" style="visibility: hidde;"
                                                    class="col borde text-success" id="CardBACGerente_t">0.00
                                                </div>
                                            </th>
                                            <td align="right">
                                                <div style="visibility: hidde;" class="col borde text-success"
                                                    id="CardBACGerente_r">0.0</div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_CardBACGerente" name="check_CardBACGerente"
                                                    {{ isset($dataday->check_x_CardBACGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sencillo</td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="CashAmtGerente" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();colores()" onkeyup="cal();colores()"
                                                            value="{{ $dataday->CashAmtGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="CashAmtGerente" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()" value="">
                                                @endif
                                            </td>
                                            <th>
                                                <div style="visibility: hidden;" class="col borde text-success"
                                                    id="CashAmtGerente_t">0.00</div>
                                            </th>
                                            <td align="right">
                                                <div class="col borde text-success" id="CashAmtGerente_r">0.0
                                                </div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_CashAmtGerente" name="check_CashAmtGerente"
                                                    {{ isset($dataday->check_x_CashAmtGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Rollos </td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="CoinRollGerente" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();colores()" onkeyup="cal();colores()"
                                                            value="{{ $dataday->CoinRollGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="CoinRollGerente" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()" value="">
                                                @endif
                                            </td>
                                            <th>
                                                <div style="visibility: hidden;" class="col borde text-success"
                                                    id="CoinRollGerente_t">0.00</div>
                                            </th>
                                            <td align="right">
                                                <div class="col borde text-success" id="CoinRollGerente_r">0.0
                                                </div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_CoinRollGerente" name="check_CoinRollGerente"
                                                    {{ isset($dataday->check_x_CoinRollGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Facturas </td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="InvoiceAmtGerente" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();colores()" onkeyup="cal();colores()"
                                                            value="{{ $dataday->InvoiceAmtGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="InvoiceAmtGerente" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="">
                                                @endif
                                            </td>
                                            <th>
                                                <div style="visibility: hidden;" class="col borde text-success"
                                                    id="InvoiceAmtGerente_t">0.00</div>
                                            </th>
                                            <td align="right">
                                                <div class="col borde text-success" id="InvoiceAmtGerente_r">
                                                    0.0
                                                </div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_InvoiceAmtGerente" name="check_InvoiceAmtGerente"
                                                    {{ isset($dataday->check_x_InvoiceAmtGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Facturas propias</td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="InvoiceAmtPropiasGerente" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();colores()" onkeyup="cal();colores()"
                                                            value="{{ $dataday->InvoiceAmtPropiasGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="InvoiceAmtPropiasGerente" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="">
                                                @endif
                                            </td>
                                            <th>
                                                <div style="visibility: hidden;" class="col borde text-success"
                                                    id="InvoiceAmtPropiasGerente_t">0.0</div>
                                            </th>
                                            <td align="right">
                                                <div class="col borde text-success" id="InvoiceAmtPropiasGerente_r">
                                                    0.0</div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_InvoiceAmtPropiasGerente"
                                                    name="check_InvoiceAmtPropiasGerente"
                                                    {{ isset($dataday->check_x_InvoiceAmtPropiasGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Vale digital </td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="VoucherAmtGerente" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();colores()" onkeyup="cal();colores()"
                                                            value="{{ $dataday->VoucherAmtGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="VoucherAmtGerente" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="">
                                                @endif
                                            </td>
                                            <th>
                                                <div style="visibility: hidden;" class="col borde text-success"
                                                    id="VoucherAmtGerente_t">0.0</div>
                                            </th>
                                            <td align="right">
                                                <div class="col borde text-success" id="VoucherAmtGerente_r">0.0
                                                </div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_VoucherAmtGerente" name="check_VoucherAmtGerente"
                                                    {{ isset($dataday->check_x_VoucherAmtGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Beca digital </td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="GrantAmtGerente" type="number"
                                                            class="form-control" step="0.01" placeholder="0.00"
                                                            onchange="cal();colores()" onkeyup="cal();colores()"
                                                            value="{{ $dataday->GrantAmtGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="GrantAmtGerente" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()" value="">
                                                @endif
                                            </td>
                                            <th>
                                                <div style="visibility: hidden;" class="col borde text-success"
                                                    id="GrantAmtGerente_t">0.0</div>
                                            </th>
                                            <td align="right">
                                                <div class="col borde text-success" id="GrantAmtGerente_r">0.0
                                                </div>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="check_GrantAmtGerente" name="check_GrantAmtGerente"
                                                    {{ isset($dataday->check_x_GrantAmtGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <br><br>

                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead id="miTablaPersonalizada">
                                        <th>
                                        </th>
                                        <th>
                                        </th>
                                        <th>
                                        </th>
                                        <th>
                                        </th>
                                        <th style="width: 23px;">
                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Sencillo Supervisora
                                            </td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="SencilloSupervisoraGerente" type="number"
                                                            class="form-control" class="text-left  form-control"
                                                            placeholder="0.00" onchange="cal();colores()"
                                                            step="0.01" onkeyup="cal();colores()"
                                                            value="{{ $dataday->SencilloSupervisoraGerente }}">
                                                    @endforeach
                                                @else
                                                    <input name="SencilloSupervisoraGerente" type="number"
                                                        class="form-control" class="text-left  form-control"
                                                        placeholder="0.00" onchange="cal();colores()" step="0.01"
                                                        onkeyup="cal();colores()" value="">
                                                @endif
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td><input class="form-check-input" type="checkbox" value="1"
                                                    id="check_SencilloSupervisoraGerente"
                                                    name="check_SencilloSupervisoraGerente"
                                                    {{ isset($dataday->check_SencilloSupervisoraGerente) ? __('checked') : __('') }}>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Total panaderia</td>
                                            <td><input name="totalPanaderiaGerente"
                                                    @if ($list->isNotEmpty()) @foreach ($list as $dataday)
                                                value="{{ $dataday->totalPanaderiaGerente }}"
                                                @endforeach
                                                @else
                                                value="" @endif
                                                    type="number" class="form-control" step="0.01"
                                                    placeholder="0.00"></td>
                                            <td></td>
                                            <td></td>
                                            <td><input class="form-check-input" type="checkbox" value="1"
                                                    id="check_totalPanaderiaGerente" name="check_totalPanaderiaGerente"
                                                    {{ isset($dataday->check_x_totalPanaderiaGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total pagatodo</td>
                                            <td><input name="totalPagatodoGerente"
                                                    @if ($list->isNotEmpty()) @foreach ($list as $dataday)
                                                value="{{ $dataday->totalsuperGerente }}"
                                                @endforeach
                                                @else
                                                value="" @endif
                                                    type="number" class="form-control" step="0.01"
                                                    placeholder="0.00"></td>
                                            <td></td>
                                            <td></td>
                                            <td><input class="form-check-input" type="checkbox" value="1"
                                                    id="check_totalPagatodoGerente" name="check_totalPagatodoGerente"
                                                    {{ isset($dataday->check_x_totalPagatodoGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total super</td>
                                            <td> <input name="totalsuperGerente"
                                                    @if ($list->isNotEmpty()) @foreach ($list as $dataday)
                                                value="{{ $dataday->totalsuperGerente }}"
                                                @endforeach
                                                @else
                                                value="" @endif
                                                    type="number" class="form-control" step="0.01"
                                                    placeholder="0.00"> </td>
                                            <td></td>
                                            <td></td>
                                            <td><input class="form-check-input" type="checkbox" value="1"
                                                    id="check_totalsuperGerente" name="check_totalsuperGerente"
                                                    {{ isset($dataday->check_x_totalsuperGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dinero de taxi</td>
                                            <td><input name="dineroTaxiGerente"
                                                    @if ($list->isNotEmpty()) @foreach ($list as $dataday)
                                                value="{{ $dataday->dineroTaxiGerente }}"
                                                @endforeach
                                                @else
                                                value="" @endif
                                                    type="number" class="form-control" step="0.01"
                                                    placeholder="0.00"> </td>
                                            <td></td>
                                            <td></td>
                                            <td><input class="form-check-input" type="checkbox" value="1"
                                                    id="check_dineroTaxiGerente" name="check_dineroTaxiGerente"
                                                    {{ isset($dataday->check_x_dineroTaxiGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Vuelto de mercado</td>
                                            <td>
                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <input name="vueltoMercadoGerente"
                                                            value="{{ $dataday->vueltoMercadoGerente }}"
                                                            type="number" class="form-control" step="0.01"
                                                            placeholder="0.00">
                                                    @endforeach
                                                @else
                                                    <input name="vueltoMercadoGerente" value="" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00">
                                                @endif
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td><input class="form-check-input" type="checkbox" value="1"
                                                    id="check_vueltoMercadoGerente" name="check_vueltoMercadoGerente"
                                                    {{ isset($dataday->check_x_vueltoMercadoGerente) ? __('checked') : __('') }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Comentarios</td>
                                            <td>

                                                @if ($list->isNotEmpty())
                                                    @foreach ($list as $dataday)
                                                        <textarea name="comentariosGerente" value="" placeholder="Comentarios" class="form-control"> {{ $dataday->comentariosGerente }}</textarea>
                                                    @endforeach
                                                @else
                                                    <textarea name="comentariosGerente" value="" placeholder="Comentarios" class="form-control"></textarea>
                                                @endif
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead id="miTablaPersonalizada">
                                        <tr>
                                            <td>Subtotal super</td>
                                            <td></td>
                                            <td align="right">
                                                <h6 class="mb-0 text-success" id="Monto_Gerente_t"></h6>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <h4 class="mb-0">Monto contado</h4>
                                            </th>
                                            <th>

                                            </th>
                                            <th>
                                                <h5 class="mb-0 fw-bold text-success" id="Monto_contado_Gerente"
                                                    align="right">
                                                </h5>
                                            </th>
                                            <th>
                                            </th>
                                            <th style="width: 23px;">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>Monto X</td>
                                            <td></td>
                                            <td align="right">
                                                <h6 class="mb-0" id="Monto_X_t">{{ $data->XAmt }}</h6>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Diferencia</td>
                                            <td></td>
                                            <td align="right">
                                                <h6 class="mb-0" id="Monto_Diferencia_t">
                                                    {{ $data->DifferenceAmt }}</h6>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="form-check checkbox-xl text-center">
                                @if ($list->isNotEmpty())
                                    @foreach ($list as $dataday)
                                        @if ($dataday->check_ger == 1)
                                            <input class="form-check-input" type="checkbox" value="1"
                                                id="check_ger" name="check_ger"
                                                style="margin-left: 1px;margin-left: 50%;margin-right: 1px;margin-top: 1px;margin-bottom: 1px;"
                                                checked>
                                        @else
                                            <input class="form-check-input" type="checkbox" value="1"
                                                id="check_ger" name="check_ger"
                                                style="margin-left: 1px;margin-left: 50%;margin-right: 1px;margin-top: 1px;margin-bottom: 1px;">
                                        @endif
                                    @endforeach
                                @else
                                    <input class="form-check-input" type="checkbox" value="1" id="check_ger"
                                        name="check_ger"
                                        style="margin-left: 1px;margin-left: 50%;margin-right: 1px;margin-top: 1px;margin-bottom: 1px;">
                                @endif
                            </div>
                            <p class="form-check-label text-center">Verificado por gerente</p> --}}
                        </div>
                    </div>
                </div>

                <div class="card text-center">
                    <div class="card-body">
                        <h3> <b>Recuerde validar que coincida el total con la Z generada en el día</b> </h3>
                    </div>
                </div>
                <div class="card text-center m-2">
                    <div class="row border m-1">
                        <div class="col">
                            <div class="card-body">

                                @if ($list->isNotEmpty())
                                    @foreach ($list as $dataday)
                                        <label for="formFileMultiple" class="form-label">Por favor adjunte los
                                            reportes</label>
                                        <input class=" subirimagen form-control" type="file" id="filePicker"
                                            placeholder="Recibo" name="FileCedula" value="0"
                                            onchange="imgsize()" onkeyup="imgsize()" accept=".png, .jpg, .jpeg">
                                        <textarea style="display:none;" name="Fileclosecash" id="base64textarea" placeholder="Base64 will appear here"
                                            cols="50" rows="15">{{ $dataday->Fileclosecash }}</textarea>
                                        <br>
                                        <center><img id="img1" class="rounded"
                                                src="data:image/png;base64,{{ $dataday->Fileclosecash }}"
                                                border="1" style="width: 50%;">
                                        </center>
                                    @endforeach
                                @else
                                    <label for="formFileMultiple" class="form-label">Por favor adjunte los
                                        reportes</label>
                                    <input class=" subirimagen form-control" type="file" id="filePicker"
                                        placeholder="Recibo" name="FileCedula" value="0" onchange="imgsize()"
                                        onkeyup="imgsize()" accept=".png, .jpg, .jpeg">
                                    <textarea style="display:none;" name="Fileclosecash" id="base64textarea" placeholder="Base64 will appear here"
                                        cols="50" rows="15"></textarea>
                                    <br>
                                    <center><img id="img1" class="rounded" src="" border="1"
                                            style="width: 50%;">
                                    </center>
                                @endif



                                {{--  --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card text-center m-2">
                    <div class="row border m-1">
                        <div class="col">
                            <div class="card-body">

                                <div class="d-grid gap-2">

                                    <button type="submit" class="btn btn-primary" type="button"
                                        onclick="zero()">Guardar</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @if ($list->isNotEmpty())
                    @foreach ($list as $dataday)
                        <script src="js/calculo_edit.js" defer></script>
                    @endforeach
                @else
                    <script src="js/calculo_new.js" defer></script>
                @endif
            @endforeach
        @endif
        </form>
        <script>
            

            function imprimirpagina() {
                window.print();
            }
            var handleFileSelect = function(evt) {
                var files = evt.target.files;
                var file = files[0];
                if (files && file) {
                    var reader = new FileReader();
                    reader.onload = function(readerEvt) {
                        var binaryString = readerEvt.target.result;
                        document.getElementById("base64textarea").value = btoa(binaryString);
                        document.getElementById("img1").src = "data:image/png;base64," + btoa(binaryString);

                    };
                    reader.readAsBinaryString(file);
                }
            };
            if (window.File && window.FileReader && window.FileList && window.Blob) {
                document.getElementById('filePicker').addEventListener('change', handleFileSelect, false);

            } else {
                alert('The File APIs are not fully supported in this browser.');
            }
            //// Mostrar y Ocultar
            const formulario = document.getElementById('card_sistema');
            const boton = document.getElementById('ver_sistema');

            boton.addEventListener('click', () => {
                if (formulario.style.display === 'none') {
                    formulario.style.display = 'block';
                    boton.textContent = 'Ocultar sistema';
                } else {
                    formulario.style.display = 'none';
                    boton.textContent = 'Mostrar sistema';
                }
            });

            const formulario2 = document.getElementById('card_fiscalizadora');
            const boton2 = document.getElementById('ver_fiscalizadora');

            boton2.addEventListener('click', () => {
                if (formulario2.style.display === 'none') {
                    formulario2.style.display = 'block';
                    boton2.textContent = 'Ocultar fiscalizadora';
                } else {
                    formulario2.style.display = 'none';
                    boton2.textContent = 'Mostrar fiscalizadora';
                }
            });

            const formulario3 = document.getElementById('card_gerente');
            const boton3 = document.getElementById('ver_gerente');

            boton3.addEventListener('click', () => {
                if (formulario3.style.display === 'none') {
                    formulario3.style.display = 'block';
                    boton3.textContent = 'Ocultar gerente';
                } else {
                    formulario3.style.display = 'none';
                    boton3.textContent = 'Mostrar gerente';
                }
            });

            const checkbox = document.getElementById('agencia-checkbox');
            checkbox.addEventListener('change', () => {
                if (checkbox.checked) {
                    formulario3.style.display = 'block';
                    boton3.style.display = 'block';
                    formulario2.style.display = 'none';
                    boton2.style.display = 'none';
                } else {
                    formulario3.style.display = 'none';
                    boton3.style.display = 'none';
                    formulario2.style.display = 'block';
                    boton2.style.display = 'block';
                }
            });
        </script>
        <style>
            .table>:not(caption)>*>* {
                padding: 0rem;
            }

            .form-check-input {
                scale: 1.5;
                margin-left: 8px;

            }

            .material-symbols-outlined {
                font-variation-settings:
                    'FILL'0,
                    'wght'700,
                    'GRAD'200,
                    'opsz'48
            }

            #miTablaPersonalizada th {
                width: 100px;
                /* overflow: auto; */
                border: 0px solid;
            }

            table {
                table-layout: fixed;
            }
        </style>
    @endif
@endsection
