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
                                <input name="DateTrx" type="date"
                                    value={{ isset($request->DateTrx) ? date('Y-m-d', strtotime($request->DateTrx)) : date('Y-m-d') }}
                                    class="form-control" placeholder="0.00">
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
                            <table class="table table table-bordered">
                                <thead>
                                    <tr>
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
                                @if ($closecashlist->{'records-size'} > 0)
                                    @foreach ($closecashlist->records as $closecashl)
                                        <tbody style="font-size: 14px">
                                            <tr>
                                                <th scope="row" class="text-start text-capitalize"
                                                    style="
                                                padding-right: 25px;
                                            ">
                                                    {{ $closecashl->ba_name }}</th>
                                                <td class="text-start text-capitalize"
                                                    style="
                                                padding-right: 25px;
                                            ">
                                                    {{ $closecashl->u_name }}</td>
                                                <td class="text-end"
                                                    style="
                                                padding-left: 25px;
                                            ">
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
                <style>
                    .table>:not(caption)>*>* {
                        padding: 0rem;
                    }

                    .card {
                        --bs-card-spacer-y: 0.2rem;
                        --bs-card-spacer-x: 0.2rem;
                    }

                    .material-symbols-outlined {
                        font-variation-settings:
                            'FILL'0,
                            'wght'700,
                            'GRAD'200,
                            'opsz'48
                    }
                </style>

                @if ($list->isNotEmpty())
                    @foreach ($list as $dataday)
                        <div class="col-2 col-sm-2 col-md-2 col-lg-2" name="id">
                            <input hidden name="id" value="{{ $dataday->id }}">
                        </div>
                    @endforeach
                @endif


                <div class="card-group m-2">
                    <div class="card">
                        <div class="card-body">

                            <h5 class="card-title"><b>Monto sistema</b></h5>
                            <table class="table table-borderless ">
                                <thead>
                                    <tr>
                                        <th style="width: 100px;">
                                            <p class="card-text">Efectivo</p>
                                        </th>
                                        <th style="width: 100px;"></th>
                                        <th style="width: 100px;">
                                            <h5 align="right" class="mb-0 fw-bold" id="Montosistema_t">
                                                {{ $data->x_oneamt * 1 + $data->x_fiveamt * 5 + $data->x_tenamt * 10 + $data->x_twentyamt * 20 + $data->x_fiftyamt * 50 + $data->x_hundredamt * 100, 2 }}
                                            </h5>
                                        </th>
                                        <th style="width: 100px;">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>$1 *</td>
                                        <td> <input style="width: 100px;" name="x_oneamtSistema"
                                                value="{{ $data->x_oneamt }}" type="number" class="form-control"
                                                readonly class="text-left  form-control" placeholder="0.00"></td>
                                        <td align="right">
                                            @php
                                                echo number_format($data->x_oneamt * 1, 2, ',', ' ');
                                            @endphp
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>$5 *</td>
                                        <td><input style="width: 100px;" name="x_fiveamtSistema"
                                                value="{{ $data->x_fiveamt }}" type="number" class="form-control"
                                                readonly class="text-left  form-control" placeholder="0.00"></td>
                                        <td align="right">
                                            @php
                                                echo number_format($data->x_fiveamt * 5, 2, ',', ' ');
                                            @endphp
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>$10 *</td>
                                        <td><input style="width: 100px;" name="x_tenamtSistema"
                                                value="{{ $data->x_tenamt }}" type="number" class="form-control"
                                                readonly class="text-left  form-control" placeholder="0.00"></td>
                                        <td align="right">
                                            @php
                                                echo number_format($data->x_tenamt * 10, 2, ',', ' ');
                                            @endphp
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>$20 *</td>
                                        <td><input style="width: 100px;" name="x_twentyamtSistema"
                                                value="{{ $data->x_twentyamt }}" type="number" class="form-control"
                                                readonly class="text-left  form-control" placeholder="0.00"></td>
                                        <td align="right">
                                            @php
                                                echo number_format($data->x_twentyamt * 20, 2, ',', ' ');
                                            @endphp
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>$50 *</td>
                                        <td><input style="width: 100px;" name="x_fiftyamtSistema"
                                                value="{{ $data->x_fiftyamt }}" type="number" class="form-control"
                                                readonly class="text-left  form-control" placeholder="0.0"></td>
                                        <td align="right">
                                            @php
                                                echo number_format($data->x_fiftyamt * 50, 2, ',', ' ');
                                            @endphp
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>$100 *</td>
                                        <td><input style="width: 100px;" name="x_hundredamtSistema"
                                                value="{{ $data->x_hundredamt }}" type="number" class="form-control"
                                                readonly class="text-left  form-control" placeholder="0.00"></td>
                                        <td align="right">
                                            @php
                                                echo number_format($data->x_hundredamt * 100, 2, ',', ' ');
                                            @endphp
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br><br>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th style="width: 100px;">Otros</th>
                                        <th style="width: 100px;"></th>
                                        <th style="width: 100px;" align="right">
                                            <h5 align="right" class="mb-0 fw-bold" id="Otros">
                                                {{ $data->yappy + $data->otros + $data->valespagoda + $data->CheckAmt + $data->LotoAmt + $data->CreditAmt + $data->CardAmt + $data->CashAmt + $data->CoinRoll + $data->InvoiceAmt + $data->VoucherAmt + $data->GrantAmt }}
                                            </h5>
                                        </th>
                                        <th style="width: 100px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-size:12px;">Yappy</td>
                                        <td> <input style="width: 100px;" name="yappySistema"
                                                value="{{ $data->yappy }}" type="number" class="form-control"
                                                step="0.01" readonly placeholder="0.00"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Otros</td>
                                        <td><input style="width: 100px;" name="otrosSistema" value="{{ $data->otros }}"
                                                type="number" class="form-control" step="0.01" readonly
                                                placeholder="0.00"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input style="width: 100px;" disabled step="0.01" class="form-control">
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Vales pagoda </td>
                                        <td><input style="width: 100px;" name="valespagodaSistema"
                                                value="{{ $data->valespagoda }}" type="number" class="form-control"
                                                step="0.01" readonly placeholder="0.00"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;"> Monto cheques</td>
                                        <td> <input style="width: 100px;" name="CheckAmtSistema"
                                                value="{{ $data->CheckAmt }}" type="number" class="form-control"
                                                step="0.01" readonly placeholder="0.00">
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;"> Loteria</td>
                                        <td> <input style="width: 100px;" name="LotoAmtSistema"
                                                value="{{ $data->LotoAmt }}" type="number" class="form-control"
                                                step="0.01" readonly placeholder="0.00">
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Vale</td>
                                        <td> <input style="width: 100px;" name="valeAmt" value="{{ $data->CreditAmt }}"
                                                type="number" class="form-control" step="0.01" readonly
                                                placeholder="0.00">
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Tarjetas </td>
                                        <td> <input style="width: 100px;" name="CardAmtSistema"
                                                value="{{ $data->CardAmt }}" type="number" class="form-control"
                                                step="0.01" readonly placeholder="0.00">
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input style="width: 100px;" disabled sstep="0.01" class="form-control">
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input style="width: 100px;" disabled sstep="0.01" class="form-control">
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input style="width: 100px;" disabled sstep="0.01" class="form-control">
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input style="width: 100px;" disabled sstep="0.01" class="form-control">
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input style="width: 100px;" disabled step="0.01" class="form-control">
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;"> Sencillo </td>
                                        <td><input style="width: 100px;" name="CashAmtSistema"
                                                value="{{ $data->CashAmt }}" type="number" class="form-control"
                                                step="0.01" readonly placeholder="0.00">
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Rollos </td>
                                        <td> <input style="width: 100px;" name="CoinRollSistema"
                                                value="{{ $data->CoinRoll }}" type="number" class="form-control"
                                                step="0.01" readonly placeholder="0.00">
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Facturas </td>
                                        <td> <input style="width: 100px;" name="InvoiceAmtSistema"
                                                value="{{ $data->InvoiceAmt }}" type="number" class="form-control"
                                                step="0.01" readonly placeholder="0.00">
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input style="width: 100px;" disabled step="0.01" class="form-control">
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px; ">Vale digital </td>
                                        <td> <input style="width: 100px;" name="VoucherAmtSistema"
                                                value="{{ $data->VoucherAmt }}" type="number" class="form-control"
                                                step="0.01" readonly placeholder="0.00">
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Beca digital </td>
                                        <td> <input style="width: 100px;" name="GrantAmtSistema"
                                                value="{{ $data->GrantAmt }}" type="number" class="form-control"
                                                step="0.01" readonly placeholder="0.00">
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Subtotal super</td>
                                        <td></td>
                                        <td align="right">
                                            <h6 id="Monto_Subtotal_Sistema">{{ $data->SubTotal }}</h6>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br><br>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th style="width: 200px;">
                                            <h4 class="mb-0">Monto contado</h4>
                                        </th>
                                        <th style="width: 0px;">

                                        </th>
                                        <th style="width: 100px;">
                                            <h5 class="mb-0 fw-bold" id="Monto_contado_Sistema" align="right">
                                                {{ $data->NetTotal }}</h5>
                                        </th>
                                        <th style="width: 100px;">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>Monto X </td>
                                        <td></td>
                                        <td align="right">
                                            <h6 id="Monto_X_Sistema">{{ $data->XAmt }}</h6>
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

                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title"> <b> Fiscalizadora </b></h5>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>
                                            <p class="card-text">Efectivo</p>
                                        </th>
                                        <th> </th>
                                        <th align="right">
                                            <h5 align="right" class="mb-0 fw-bold text-success" id="Fiscalizadora_t">0
                                            </h5>
                                        </th>
                                        <th align="right">
                                            <div align="right" style="font-size:12px;">Diferencia</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width: 100px;">$1 *</td>
                                        <td style="width: 100px;">
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;"
                                                        value="{{ $dataday->x_oneamtFiscalizadora }}"
                                                        name="x_oneamtFiscalizadora" type="number" class="form-control"
                                                        class="text-left  form-control form-control"placeholder="0.00"
                                                        onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" value="" name="x_oneamtFiscalizadora"
                                                    type="number" class="form-control"
                                                    class="text-left  form-control"placeholder="0.00"
                                                    onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()">
                                            @endif
                                        </td>
                                        <td style="width: 100px;" align="right">
                                            <div class="col borde" id="x_oneamtFiscalizadora_t">
                                                {{ $data->x_oneamt * 1 }}</div>
                                        </td>
                                        <td style="width: 100px;" align="right">
                                            <div class="col borde text-success" id="x_oneamtFiscalizadora_r"
                                                style="padding-left: 10px;">0.00</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>$5 *</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;"
                                                        value="{{ $dataday->x_fiveamtFiscalizadora }}"
                                                        name="x_fiveamtFiscalizadora" type="number" class="form-control"
                                                        class="text-left  form-control form-control" placeholder="0.00"
                                                        onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" value="" name="x_fiveamtFiscalizadora"
                                                    type="number" class="form-control" class="text-left  form-control"
                                                    placeholder="0.00" onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()">
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
                                    </tr>
                                    <tr>
                                        <td>$10 *</td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;"
                                                        value="{{ $dataday->x_tenamtFiscalizadora }}"
                                                        name="x_tenamtFiscalizadora" type="number" class="form-control"
                                                        class="text-left  form-control" placeholder="0.00"
                                                        onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" value="" name="x_tenamtFiscalizadora"
                                                    type="number" class="form-control" class="text-left  form-control"
                                                    placeholder="0.00" onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()">
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
                                    </tr>
                                    <tr>
                                        <td>$20 *</td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;"
                                                        value="{{ $dataday->x_twentyamtFiscalizadora }}"
                                                        name="x_twentyamtFiscalizadora" type="number"
                                                        class="form-control" class="text-left  form-control"
                                                        placeholder="0.00" onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" value=""
                                                    name="x_twentyamtFiscalizadora" type="number" class="form-control"
                                                    class="text-left  form-control" placeholder="0.00"
                                                    onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()">
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
                                    </tr>
                                    <tr>
                                        <td>$50 *</td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;"
                                                        value="{{ $dataday->x_fiftyamtFiscalizadora }}"
                                                        name="x_fiftyamtFiscalizadora" type="number"
                                                        class="form-control" class="text-left  form-control"
                                                        placeholder="0.00" onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" value=""
                                                    name="x_fiftyamtFiscalizadora" type="number" class="form-control"
                                                    class="text-left  form-control" placeholder="0.00"
                                                    onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()">
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
                                    </tr>
                                    <tr>
                                        <td>$100 *</td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;"
                                                        value="{{ $dataday->x_hundredamtFiscalizadora }}"
                                                        name="x_hundredamtFiscalizadora" type="number"
                                                        class="form-control" class="text-left  form-control"
                                                        placeholder="0.00" onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" value=""
                                                    name="x_hundredamtFiscalizadora" type="number" class="form-control"
                                                    class="text-left  form-control" placeholder="0.00"
                                                    onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()">
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
                                    </tr>
                                </tbody>
                            </table>
                            <br><br>
                            <table class="table table table-borderless">
                                <thead>
                                    <tr>
                                        <th style="width: 100px;"> Otros</th>
                                        <th style="width: 100px;"></th>
                                        <th style="width: 100px;" align="right">
                                            <h5 align="right" class="mb-0 fw-bold text-success"
                                                id="Otros_Fiscalizadora_t">0.00</h5>
                                        </th>
                                        <th style="width: 100px;" align="right">
                                            <div align="right" style="font-size:12px;">Diferencia</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-size:12px;">Yappy</td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;"
                                                        value="{{ $dataday->yappyFiscalizadora }}"
                                                        id="yappyFiscalizadora" name="yappyFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" value="" id="yappyFiscalizadora"
                                                    name="yappyFiscalizadora" type="number" class="form-control"
                                                    step="0.01" placeholder="0.00"
                                                    onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()">
                                            @endif


                                        </td>
                                        <td></td>
                                        <td align="right">
                                            <div class="col borde text-success" id="yappyFiscalizadora_r">0.0
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Otros</td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;" name="otrosFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()"
                                                        value="{{ $dataday->otrosFiscalizadora }}">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" name="otrosFiscalizadora" type="number"
                                                    class="form-control" step="0.01" placeholder="0.00"
                                                    onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()" value="">
                                            @endif

                                        </td>
                                        <td></td>
                                        <td align="right">
                                            <div class="col borde text-success" id="otrosFiscalizadora_r">0.0
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Primera parte</td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;" name="otrosprimeroFiscalizadora"
                                                        type="number" class="form-control" step="0.01"
                                                        placeholder="0.00" onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()"
                                                        value="{{ $dataday->otrosprimeroFiscalizadora }}">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" name="otrosprimeroFiscalizadora"
                                                    type="number" class="form-control" step="0.01"
                                                    placeholder="0.00" onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()" value="">
                                            @endif

                                        </td>
                                        <td></td>
                                        <td align="right">
                                            <div class="col borde text-success" id="otrosprimeroFiscalizadora_r">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Vales pagoda </td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;" name="valespagodaFiscalizadora"
                                                        type="number" class="form-control" step="0.01"
                                                        placeholder="0.00" onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()"
                                                        value="{{ $dataday->valespagodaFiscalizadora }}">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" name="valespagodaFiscalizadora"
                                                    type="number" class="form-control" step="0.01"
                                                    placeholder="0.00" onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()" value="">
                                            @endif
                                        </td>

                                        </td>
                                        <td></td>
                                        <td align="right">
                                            <div class="col borde text-success" id="valespagodaFiscalizadora_r">
                                                0.0</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;"> Monto cheques</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;" name="CheckAmtFiscalizadora"
                                                        type="number" class="form-control" step="0.01"
                                                        placeholder="0.00" onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()"
                                                        value="{{ $dataday->CheckAmtFiscalizadora }}">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" name="CheckAmtFiscalizadora" type="number"
                                                    class="form-control" step="0.01" placeholder="0.00"
                                                    onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()" value="">
                                            @endif
                                        </td>
                                        <td></td>
                                        <td align="right">
                                            <div class="col borde text-success" id="CheckAmtFiscalizadora_r">
                                                0.0
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Loteria</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;" name="LotoAmtFiscalizadora"
                                                        type="number" class="form-control" step="0.01"
                                                        placeholder="0.00" onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()"
                                                        value="{{ $dataday->LotoAmtFiscalizadora }}">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" name="LotoAmtFiscalizadora" type="number"
                                                    class="form-control" step="0.01" placeholder="0.00"
                                                    onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()" value="">
                                            @endif
                                        </td>
                                        <td></td>
                                        <td align="right">
                                            <div class="col borde text-success" id="LotoAmtFiscalizadora_r">
                                                0.0
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Vale</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;"
                                                        value="{{ $dataday->valeAmtFiscalizadora }}"
                                                        name="valeAmtFiscalizadora" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00"
                                                        onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" value="" name="valeAmtFiscalizadora"
                                                    type="number" class="form-control" step="0.01"
                                                    placeholder="0.00" onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()">
                                            @endif
                                        </td>
                                        <td></td>
                                        <td align="right">
                                            <div class="col borde text-success" id="valeAmtFiscalizadora_r">
                                                0.0
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Tarjeta clave</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;"
                                                        value="{{ $dataday->CardClaveFiscalizadora }}"
                                                        name="CardClaveFiscalizadora" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00"
                                                        onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" value="" name="CardClaveFiscalizadora"
                                                    type="number" class="form-control" step="0.01"
                                                    placeholder="0.00" onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()">
                                            @endif
                                        </td>
                                        <td></td>
                                        <td align="right">
                                            <div style="visibility: hidden;" class="col borde text-success"
                                                id="CardClaveFiscalizadora_r">0.0</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Tarjeta vale</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;"
                                                        value="{{ $dataday->CardValeFiscalizadora }}"
                                                        name="CardValeFiscalizadora" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00"
                                                        onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" value="" name="CardValeFiscalizadora"
                                                    type="number" class="form-control" step="0.01"
                                                    placeholder="0.00" onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()">
                                            @endif

                                        </td>
                                        <td></td>
                                        <td align="right">
                                            <div style="visibility: hidden;" class="col borde text-success"
                                                id="CardValeFiscalizadora_r">0.0</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Tarjeta visa</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;"
                                                        value="{{ $dataday->CardVisaFiscalizadora }}"
                                                        name="CardVisaFiscalizadora" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00"
                                                        onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" value="" name="CardVisaFiscalizadora"
                                                    type="number" class="form-control" step="0.01"
                                                    placeholder="0.00" onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()">
                                            @endif
                                        </td>
                                        <td></td>
                                        <td align="right">
                                            <div class="col borde text-success" id="CardVisaFiscalizadora_r">
                                                0.0
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Tarjeta master</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;"
                                                        value="{{ $dataday->CardMasterFiscalizadora }}"
                                                        name="CardMasterFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" value=""
                                                    name="CardMasterFiscalizadora" type="number" class="form-control"
                                                    step="0.01" placeholder="0.00"
                                                    onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()">
                                            @endif
                                        </td>
                                        <td></td>
                                        <td align="right">
                                            <div style="visibility: hidden;" class="col borde text-success"
                                                id="CardMasterFiscalizadora_r">0.0</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Tarjeta american</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;"
                                                        value="{{ $dataday->CardAEFiscalizadora }}"
                                                        name="CardAEFiscalizadora" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00"
                                                        onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" value="" name="CardAEFiscalizadora"
                                                    type="number" class="form-control" step="0.01"
                                                    placeholder="0.00" onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()">
                                            @endif
                                        </td>
                                        <td></td>
                                        <td align="right">
                                            <div style="visibility: hidden;" class="col borde text-success"
                                                id="CardAEFiscalizadora_r">0.0</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Tarjeta bac</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;"
                                                        value="{{ $dataday->CardBACFiscalizadora }}"
                                                        name="CardBACFiscalizadora" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00"
                                                        onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" value="" name="CardBACFiscalizadora"
                                                    type="number" class="form-control" step="0.01"
                                                    placeholder="0.00" onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()">
                                            @endif
                                        </td>
                                        <td></td>
                                        <td align="right">
                                            <div style="visibility: hidden;" class="col borde text-success"
                                                id="CardBACFiscalizadora_r">0.0</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Sencillo</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;"
                                                        value="{{ $dataday->CashAmtFiscalizadora }}"
                                                        name="CashAmtFiscalizadora" value="" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" value="" name="CashAmtFiscalizadora"
                                                    value="" type="number" class="form-control" step="0.01"
                                                    placeholder="0.00" onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()">
                                            @endif
                                        </td>
                                        <td></td>
                                        <td align="right">
                                            <div class="col borde text-success" id="CashAmtFiscalizadora_r">
                                                0.0
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Rollos </td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;"
                                                        value="{{ $dataday->CoinRollFiscalizadora }}"
                                                        name="CoinRollFiscalizadora" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00"
                                                        onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" value="" name="CoinRollFiscalizadora"
                                                    type="number" class="form-control" step="0.01"
                                                    placeholder="0.00" onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()">
                                            @endif
                                        </td>
                                        <td></td>
                                        <td align="right">
                                            <div class="col borde text-success" id="CoinRollFiscalizadora_r">
                                                0.0
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Facturas</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;"
                                                        value="{{ $dataday->InvoiceAmtFiscalizadora }}"
                                                        name="InvoiceAmtFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" value=""
                                                    name="InvoiceAmtFiscalizadora" type="number" class="form-control"
                                                    step="0.01" placeholder="0.00"
                                                    onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()">
                                            @endif
                                        </td>
                                        <td></td>
                                        <td align="right">
                                            <div class="col borde text-success" id="InvoiceAmtFiscalizadora_r">
                                                0.0</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Facturas propias</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;"
                                                        value="{{ $dataday->InvoiceAmtPropiasFiscalizadora }}"
                                                        name="InvoiceAmtPropiasFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" value=""
                                                    name="InvoiceAmtPropiasFiscalizadora" type="number"
                                                    class="form-control" step="0.01" placeholder="0.00"
                                                    onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()">
                                            @endif
                                        </td>
                                        <td></td>
                                        <td align="right">
                                            <div style="visibility: hidden;" class="col borde text-success"
                                                id="InvoiceAmtPropiasFiscalizadora_r"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Vale digital </td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;"
                                                        value="{{ $dataday->VoucherAmtFiscalizadora }}"
                                                        name="VoucherAmtFiscalizadora" type="number"
                                                        class="form-control" step="0.01" placeholder="0.00"
                                                        onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" value=""
                                                    name="VoucherAmtFiscalizadora" type="number" class="form-control"
                                                    step="0.01" placeholder="0.00"
                                                    onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()">
                                            @endif
                                        </td>
                                        <td></td>
                                        <td align="right">
                                            <div class="col borde text-success" id="VoucherAmtFiscalizadora_r">
                                                0.0</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Beca digital </td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;"
                                                        value="{{ $dataday->GrantAmtFiscalizadora }}"
                                                        name="GrantAmtFiscalizadora" type="number" class="form-control"
                                                        step="0.01" placeholder="0.00"
                                                        onchange="cal();clon();cal();colores()"
                                                        onkeyup="cal();clon();cal();colores()">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" value="" name="GrantAmtFiscalizadora"
                                                    type="number" class="form-control" step="0.01"
                                                    placeholder="0.00" onchange="cal();clon();cal();colores()"
                                                    onkeyup="cal();clon();cal();colores()">
                                            @endif
                                        </td>
                                        <td></td>
                                        <td align="right">
                                            <div class="col borde text-success" id="GrantAmtFiscalizadora_r">
                                                0.0
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Subtotal super</td>
                                        <td></td>
                                        <td align="right">
                                            <h6 class="mb-0 text-success" id="Monto_Fiscalizadora_t"></h6>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br><br>


                            <table class="table table-borderless">
                                <thead>
                                    <th style="width: 100px;">
                                    </th>
                                    <th style="width: 100px;">
                                    </th>
                                    <th style="width: 100px;">
                                    </th>
                                    <th style="width: 100px;">
                                    </th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-size:12px;">Total panaderia</td>
                                        <td><input name="totalPanaderiaFiscalizadora" type="number" class="form-control"
                                                step="0.01" style="width: 100px;" placeholder="0.00"
                                                @if ($list->isNotEmpty()) @foreach ($list as $dataday)
                                            value="{{ $dataday->totalPanaderiaFiscalizadora }}"
                                            @endforeach
                                            @else
                                                value="" @endif>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Total pagatodo</td>
                                        <td><input name="totalPagatodoFiscalizadora" type="number" class="form-control"
                                                step="0.01" style="width: 100px;" placeholder="0.00"
                                                @if ($list->isNotEmpty()) @foreach ($list as $dataday)
                                            value="{{ $dataday->totalPagatodoFiscalizadora }}"
                                            @endforeach
                                            @else
                                                value="" @endif>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Total super</td>
                                        <td> <input name="totalsuperFiscalizadora" type="number" class="form-control"
                                                step="0.01" style="width: 100px;" placeholder="0.00"
                                                @if ($list->isNotEmpty()) @foreach ($list as $dataday)
                                                value="{{ $dataday->totalsuperFiscalizadora }}"
                                                @endforeach
                                                @else
                                                value="" @endif>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Dinero de taxi</td>
                                        <td><input name="dineroTaxiFiscalizadora" type="number" class="form-control"
                                                step="0.01" style="width: 100px;" placeholder="0.00"
                                                @if ($list->isNotEmpty()) @foreach ($list as $dataday)
                                                value="{{ $dataday->dineroTaxiFiscalizadora }}"
                                                @endforeach
                                                @else
                                                value="" @endif>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;"> Vuelto de mercado</td>
                                        <td><input name="vueltoMercadoFiscalizadora" type="number" class="form-control"
                                                step="0.01" style="width: 100px;" placeholder="0.00"
                                                @if ($list->isNotEmpty()) @foreach ($list as $dataday)
                                                value="{{ $dataday->vueltoMercadoFiscalizadora }}"
                                                @endforeach
                                                @else
                                                value="" @endif>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Comentarios</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <textarea name="comentariosFiscalizadora" value="" style="width: 100px;" placeholder="Comentarios"
                                                        class="form-control">{{ $dataday->comentariosFiscalizadora }}</textarea>
                                                @endforeach
                                            @else
                                                <textarea name="comentariosFiscalizadora" value="" style="width: 100px;" placeholder="Comentarios"
                                                    class="form-control"></textarea>
                                            @endif
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>

                            </table>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th style="width: 200px;">
                                            <h4 class="mb-0">Monto contado</h4>
                                        </th>
                                        <th style="width: 0px;">

                                        </th>
                                        <th style="width: 100px;">
                                            <h5 class="mb-0 fw-bold text-success" id="Monto_contado_Fiscalizadora"
                                                align="right">

                                            </h5>
                                        </th>
                                        <th style="width: 100px;">
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

                    </div>



                    <div class="card">
                        <div class="card-body">

                            <h5 class="card-title"><b>Gerente</b></h5>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th style="width: 100px;">Efectivo</th>
                                        <th style="width: 100px;"> </th>
                                        <th style="width: 100px;">
                                            <h5 align="right" class="mb-0 fw-bold text-success" id="Gerente_t">
                                                0
                                            </h5>
                                        </th>
                                        <th style="width: 100px;" align="right">
                                            <div align="right" style="font-size:12px;">Diferencia</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>$1 *</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;" name="x_oneamtGerente" type="number"
                                                        class="form-control" class="text-left  form-control"
                                                        placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()"
                                                        value="{{ $dataday->x_oneamtGerente }}" />
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" name="x_oneamtGerente" type="number"
                                                    class="form-control" class="text-left  form-control"
                                                    placeholder="0.00" onchange="cal();colores()"
                                                    onkeyup="cal();colores()" value="" />
                                            @endif
                                        </td>
                                        <td align="right">
                                            <div class="col borde" id="x_oneamtGerente_t">0.00</div>
                                        </td>
                                        <td align="right">
                                            <div class="col borde text-success" id="x_oneamtGerente_r"
                                                style="padding-left: 10px;">0.00</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>$5 *</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;" name="x_fiveamtGerente"
                                                        type="number" class="form-control"
                                                        class="text-left  form-control" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="{{ $dataday->x_fiveamtGerente }}">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" name="x_fiveamtGerente" type="number"
                                                    class="form-control" class="text-left  form-control"
                                                    placeholder="0.00" onchange="cal();colores()"
                                                    onkeyup="cal();colores()" value="">
                                            @endif
                                        </td>
                                        <td align="right">
                                            <div class="col borde" id="x_fiveamtGerente_t">
                                                0.00</div>
                                        </td>
                                        <td align="right">
                                            <div class="col borde text-success" id="x_fiveamtGerente_r"
                                                style="padding-left: 10px;">0.00</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>$10 *</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;" name="x_tenamtGerente" type="number"
                                                        class="form-control" class="text-left  form-control"
                                                        placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()"
                                                        value="{{ $dataday->x_tenamtGerente }}">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" name="x_tenamtGerente" type="number"
                                                    class="form-control" class="text-left  form-control"
                                                    placeholder="0.00" onchange="cal();colores()"
                                                    onkeyup="cal();colores()" value="">
                                            @endif
                                        </td>
                                        <td align="right">
                                            <div class="col borde" id="x_tenamtGerente_t">
                                                0.00</div>
                                        </td>
                                        <td align="right">
                                            <div class="col borde text-success" id="x_tenamtGerente_r"
                                                style="padding-left: 10px;">0.00</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>$20 *</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;" name="x_twentyamtGerente"
                                                        type="number" class="form-control"
                                                        class="text-left  form-control" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="{{ $dataday->x_twentyamtGerente }}">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" name="x_twentyamtGerente" type="number"
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
                                            <div class="col borde text-success" id="x_twentyamtGerente_r"
                                                style="padding-left: 10px;">0.00</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>$50 *</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;" name="x_fiftyamtGerente"
                                                        type="number" class="form-control"
                                                        class="text-left  form-control" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="{{ $dataday->x_fiftyamtGerente }}">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" name="x_fiftyamtGerente" type="number"
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
                                            <div class="col borde text-success" id="x_fiftyamtGerente_r"
                                                style="padding-left: 10px;">0.00</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>$100 *</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input style="width: 100px;" name="x_hundredamtGerente"
                                                        type="number" class="form-control"
                                                        class="text-left  form-control" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="{{ $dataday->x_hundredamtGerente }}">
                                                @endforeach
                                            @else
                                                <input style="width: 100px;" name="x_hundredamtGerente" type="number"
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
                                            <div class="col borde text-success" id="x_hundredamtGerente_r"
                                                style="padding-left: 10px;">0.00</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br><br>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th style="width: 100px;">Otros</th>
                                        <th style="width: 100px;">
                                        </th>
                                        <th style="width: 100px;" align="right">
                                            <h5 align="right" class="mb-0 fw-bold text-success" id="Otros_Gerente_t">
                                                0.00</h5>
                                        </th>
                                        <th style="width: 100px;" align="right">
                                            <div align="right" style="font-size:12px;" id="">
                                                Diferencia</div>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-size:12px;">Yappy</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input id="yappyGerente" name="yappyGerente" type="number"
                                                        class="form-control" step="0.01" style="width: 100px;"
                                                        placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()" value="{{ $dataday->yappyGerente }}">
                                                @endforeach
                                            @else
                                                <input name="yappyGerente" type="number" class="form-control"
                                                    step="0.01" style="width: 100px;" placeholder="0.00"
                                                    onchange="cal();colores()" onkeyup="cal();colores()"
                                                    value="">
                                            @endif
                                        </td>
                                        <th>
                                            <div style="visibility: hidden;" class="col borde text-success"
                                                id="yappyGerente_t">0.0</div>
                                        </th>
                                        <td align="right">
                                            <div class="col borde text-success" id="yappyGerente_r">0.0</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Otros</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input name="otrosGerente" type="number" class="form-control"
                                                        step="0.01" style="width: 100px;" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="{{ $dataday->otrosGerente }}">
                                                @endforeach
                                            @else
                                                <input name="otrosGerente" type="number" class="form-control"
                                                    step="0.01" style="width: 100px;" placeholder="0.00"
                                                    onchange="cal();colores()" onkeyup="cal();colores()"
                                                    value="">
                                            @endif
                                        </td>
                                        <th>
                                            <div style="visibility: hidden;" class="col borde text-success"
                                                id="otrosGerente_t">0.0</div>
                                        </th>
                                        <td align="right">
                                            <div class="col borde text-success" id="otrosGerente_r">0.0</div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="font-size:12px;">Primera parte</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input name="otrosprimeroGerente" type="number"
                                                        class="form-control" step="0.01" style="width: 100px;"
                                                        placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()"
                                                        value="{{ $dataday->otrosprimeroGerente }}">
                                                @endforeach
                                            @else
                                                <input name="otrosprimeroGerente" type="number" class="form-control"
                                                    step="0.01" style="width: 100px;" placeholder="0.00"
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
                                    </tr>

                                    <tr>
                                        <td style="font-size:12px;">Vales pagoda </td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input name="valespagodaGerente" type="number"
                                                        class="form-control" step="0.01" style="width: 100px;"
                                                        placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()"
                                                        value="{{ $dataday->valespagodaGerente }}">
                                                @endforeach
                                            @else
                                                <input name="valespagodaGerente" type="number" class="form-control"
                                                    step="0.01" style="width: 100px;" placeholder="0.00"
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
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;"> Monto cheques</td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input name="CheckAmtGerente" type="number" class="form-control"
                                                        step="0.01" style="width: 100px;" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="{{ $dataday->CheckAmtGerente }}">
                                                @endforeach
                                            @else
                                                <input name="CheckAmtGerente" type="number" class="form-control"
                                                    step="0.01" style="width: 100px;" placeholder="0.00"
                                                    onchange="cal();colores()" onkeyup="cal();colores()"
                                                    value="">
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
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;"> Loteria</td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input name="LotoAmtGerente" type="number" class="form-control"
                                                        step="0.01" style="width: 100px;" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="{{ $dataday->LotoAmtGerente }}">
                                                @endforeach
                                            @else
                                                <input name="LotoAmtGerente" type="number" class="form-control"
                                                    step="0.01" style="width: 100px;" placeholder="0.00"
                                                    onchange="cal();colores()" onkeyup="cal();colores()"
                                                    value="">
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
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Vale</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input name="valeAmtGerente" type="number" class="form-control"
                                                        step="0.01" style="width: 100px;" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="{{ $dataday->valeAmtGerente }}">
                                                @endforeach
                                            @else
                                                <input name="valeAmtGerente" type="number" class="form-control"
                                                    step="0.01" style="width: 100px;" placeholder="0.00"
                                                    onchange="cal();colores()" onkeyup="cal();colores()"
                                                    value="">
                                            @endif
                                        </td>
                                        <th>
                                            <div style="visibility: hidden;" class="col borde" id="valeAmtGerente_t">
                                                0.0
                                            </div>
                                        </th>
                                        <td align="right">
                                            <div class="col borde text-success" id="valeAmtGerente_r">0.0
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Tarjeta clave</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input name="CardClaveGerente" type="number" class="form-control"
                                                        step="0.01" style="width: 100px;" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="{{ $dataday->CardClaveGerente }}">
                                                @endforeach
                                            @else
                                                <input name="CardClaveGerente" type="number" class="form-control"
                                                    step="0.01" style="width: 100px;" placeholder="0.00"
                                                    onchange="cal();colores()" onkeyup="cal();colores()"
                                                    value="">
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
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Tarjeta vale</td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input name="CardValeGerente" type="number" class="form-control"
                                                        step="0.01" style="width: 100px;" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="{{ $dataday->CardValeGerente }}">
                                                @endforeach
                                            @else
                                                <input name="CardValeGerente" type="number" class="form-control"
                                                    step="0.01" style="width: 100px;" placeholder="0.00"
                                                    onchange="cal();colores()" onkeyup="cal();colores()"
                                                    value="">
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
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Tarjeta visa</td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input name="CardVisaGerente" type="number" class="form-control"
                                                        step="0.01" style="width: 100px;" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="{{ $dataday->CardVisaGerente }}">
                                                @endforeach
                                            @else
                                                <input name="CardVisaGerente" type="number" class="form-control"
                                                    step="0.01" style="width: 100px;" placeholder="0.00"
                                                    onchange="cal();colores()" onkeyup="cal();colores()"
                                                    value="">
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
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Tarjeta master</td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input name="CardMasterGerente" type="number"
                                                        class="form-control" step="0.01" style="width: 100px;"
                                                        placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()"
                                                        value="{{ $dataday->CardMasterGerente }}">
                                                @endforeach
                                            @else
                                                <input name="CardMasterGerente" type="number" class="form-control"
                                                    step="0.01" style="width: 100px;" placeholder="0.00"
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
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Tarjeta american</td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input name="CardAEGerente" type="number" class="form-control"
                                                        step="0.01" style="width: 100px;" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="{{ $dataday->CardAEGerente }}">
                                                @endforeach
                                            @else
                                                <input name="CardAEGerente" type="number" class="form-control"
                                                    step="0.01" style="width: 100px;" placeholder="0.00"
                                                    onchange="cal();colores()" onkeyup="cal();colores()"
                                                    value="">
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
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Tarjeta bac</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input name="CardBACGerente" type="number" class="form-control"
                                                        step="0.01" style="width: 100px;" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="{{ $dataday->CardBACGerente }}">
                                                @endforeach
                                            @else
                                                <input name="CardBACGerente" type="number" class="form-control"
                                                    step="0.01" style="width: 100px;" placeholder="0.00"
                                                    onchange="cal();colores()" onkeyup="cal();colores()"
                                                    value="">
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
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Sencillo</td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input name="CashAmtGerente" type="number" class="form-control"
                                                        step="0.01" style="width: 100px;" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="{{ $dataday->CashAmtGerente }}">
                                                @endforeach
                                            @else
                                                <input name="CashAmtGerente" type="number" class="form-control"
                                                    step="0.01" style="width: 100px;" placeholder="0.00"
                                                    onchange="cal();colores()" onkeyup="cal();colores()"
                                                    value="">
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
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Rollos </td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input name="CoinRollGerente" type="number" class="form-control"
                                                        step="0.01" style="width: 100px;" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="{{ $dataday->CoinRollGerente }}">
                                                @endforeach
                                            @else
                                                <input name="CoinRollGerente" type="number" class="form-control"
                                                    step="0.01" style="width: 100px;" placeholder="0.00"
                                                    onchange="cal();colores()" onkeyup="cal();colores()"
                                                    value="">
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
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Facturas </td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input name="InvoiceAmtGerente" type="number"
                                                        class="form-control" step="0.01" style="width: 100px;"
                                                        placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()"
                                                        value="{{ $dataday->InvoiceAmtGerente }}">
                                                @endforeach
                                            @else
                                                <input name="InvoiceAmtGerente" type="number" class="form-control"
                                                    step="0.01" style="width: 100px;" placeholder="0.00"
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
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Facturas propias</td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input name="InvoiceAmtPropiasGerente" type="number"
                                                        class="form-control" step="0.01" style="width: 100px;"
                                                        placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()"
                                                        value="{{ $dataday->InvoiceAmtPropiasGerente }}">
                                                @endforeach
                                            @else
                                                <input name="InvoiceAmtPropiasGerente" type="number"
                                                    class="form-control" step="0.01" style="width: 100px;"
                                                    placeholder="0.00" onchange="cal();colores()"
                                                    onkeyup="cal();colores()" value="">
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
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Vale digital </td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input name="VoucherAmtGerente" type="number"
                                                        class="form-control" step="0.01" style="width: 100px;"
                                                        placeholder="0.00" onchange="cal();colores()"
                                                        onkeyup="cal();colores()"
                                                        value="{{ $dataday->VoucherAmtGerente }}">
                                                @endforeach
                                            @else
                                                <input name="VoucherAmtGerente" type="number" class="form-control"
                                                    step="0.01" style="width: 100px;" placeholder="0.00"
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
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Beca digital </td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input name="GrantAmtGerente" type="number" class="form-control"
                                                        step="0.01" style="width: 100px;" placeholder="0.00"
                                                        onchange="cal();colores()" onkeyup="cal();colores()"
                                                        value="{{ $dataday->GrantAmtGerente }}">
                                                @endforeach
                                            @else
                                                <input name="GrantAmtGerente" type="number" class="form-control"
                                                    step="0.01" style="width: 100px;" placeholder="0.00"
                                                    onchange="cal();colores()" onkeyup="cal();colores()"
                                                    value="">
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
                                    </tr>
                                    <tr>
                                        <td>Subtotal super</td>
                                        <td></td>
                                        <td align="right">
                                            <h6 class="mb-0 text-success" id="Monto_Gerente_t"></h6>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br><br>


                            <table class="table table-borderless">
                                <thead>
                                    <th style="width: 100px;">
                                    </th>
                                    <th style="width: 100px;">
                                    </th>
                                    <th style="width: 100px;">
                                    </th>
                                    <th style="width: 100px;">
                                    </th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-size:12px;">Total panaderia</td>
                                        <td><input name="totalPanaderiaGerente"
                                                @if ($list->isNotEmpty()) @foreach ($list as $dataday)
                                                value="{{ $dataday->totalPanaderiaGerente }}"
                                                @endforeach
                                                @else
                                                value="" @endif
                                                style="width: 100px;" type="number" class="form-control"
                                                step="0.01" placeholder="0.00"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Total pagatodo</td>
                                        <td><input name="totalPagatodoGerente"
                                                @if ($list->isNotEmpty()) @foreach ($list as $dataday)
                                                value="{{ $dataday->totalsuperGerente }}"
                                                @endforeach
                                                @else
                                                value="" @endif
                                                style="width: 100px;" type="number" class="form-control"
                                                step="0.01" placeholder="0.00"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Total super</td>
                                        <td> <input name="totalsuperGerente"
                                                @if ($list->isNotEmpty()) @foreach ($list as $dataday)
                                                value="{{ $dataday->totalsuperGerente }}"
                                                @endforeach
                                                @else
                                                value="" @endif
                                                style="width: 100px;" type="number" class="form-control"
                                                step="0.01" placeholder="0.00"> </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Dinero de taxi</td>
                                        <td><input name="dineroTaxiGerente"
                                                @if ($list->isNotEmpty()) @foreach ($list as $dataday)
                                                value="{{ $dataday->dineroTaxiGerente }}"
                                                @endforeach
                                                @else
                                                value="" @endif
                                                style="width: 100px;" type="number" class="form-control"
                                                step="0.01" placeholder="0.00"> </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;"> Vuelto de mercado</td>
                                        <td>
                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <input name="vueltoMercadoGerente"
                                                        value="{{ $dataday->vueltoMercadoGerente }}"style="width: 100px;"
                                                        type="number" class="form-control" step="0.01"
                                                        placeholder="0.00">
                                                @endforeach
                                            @else
                                                <input name="vueltoMercadoGerente" value=""
                                                    style="width: 100px;" type="number" class="form-control"
                                                    step="0.01" placeholder="0.00">
                                            @endif
                                        </td>

                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">Comentarios</td>
                                        <td>

                                            @if ($list->isNotEmpty())
                                                @foreach ($list as $dataday)
                                                    <textarea name="comentariosGerente" value="" style="width: 100px;" placeholder="Comentarios"
                                                        class="form-control"> {{ $dataday->comentariosGerente }}</textarea>
                                                @endforeach
                                            @else
                                                <textarea name="comentariosGerente" value="" style="width: 100px;" placeholder="Comentarios"
                                                    class="form-control"></textarea>
                                            @endif
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th style="width: 200px;">
                                            <h4 class="mb-0">Monto contado</h4>
                                        </th>
                                        <th style="width: 0px;">

                                        </th>
                                        <th style="width: 100px;">
                                            <h5 class="mb-0 fw-bold text-success" id="Monto_contado_Gerente"
                                                align="right">
                                            </h5>
                                        </th>
                                        <th style="width: 100px;">
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
                                <label for="formFileMultiple" class="form-label">Por favor adjunte los
                                    reportes</label>
                                {{-- <input class="form-control" type="file" id="Fileclosecash" name="Fileclosecash"
                                    value="0"> --}}
                                {{--  --}}
                                <input class=" subirimagen form-control" type="file" id="filePicker"
                                    placeholder="Recibo" name="FileCedula" value="0" onchange="imgsize()"
                                    onkeyup="imgsize()" accept=".png, .jpg, .jpeg">
                                <textarea style="display:none;" name="Fileclosecash" id="base64textarea" placeholder="Base64 will appear here"
                                    cols="50" rows="15"></textarea>

                                <center><img id="img1" src="data:image/png;base64," border="1">
                                </center>
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
            const formulario = document.getElementById('loans_store_new');
            const boton = document.getElementById('Nuevo');

            boton.addEventListener('click', () => {
                if (formulario.style.display === 'none') {
                    formulario.style.display = 'block';
                    /* boton.textContent = 'Ocultar formulario'; */
                } else {
                    formulario.style.display = 'none';
                    /* boton.textContent = 'Mostrar formulario'; */
                }
            });
        </script>
    @endif
@endsection
