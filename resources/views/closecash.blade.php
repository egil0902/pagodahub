@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,0,200" />

<form name="closecash_import" id="closecash_import" method="post" action="{{ route('closecash.import') }}" enctype="multipart/form-data">
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
                        @foreach($orgs->records as $org)
                        <option {{ (isset($request->AD_Org_ID))?($request->AD_Org_ID==$org->id)? __('selected') : __('') : __('') }} value="{{$org->id}}">{{$org->Name}}</option>
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
                            <input name="DateTrx" type="date" value={{ (isset($request->DateTrx))?date("Y-m-d",strtotime($request->DateTrx)):date("Y-m-d") }} class="form-control" placeholder="0.00">
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

@php
$opcion = 0;
@endphp
@if (isset($closecashsumlist))
@foreach($list as $dataday)
<form name="closecash_edit" id="closecash_edit" method="POST" action="{{ route('closecash.edit') }}" enctype="multipart/form-data">
    @csrf
    @if ($closecashsumlist->{'records-size'} > 0)
    @foreach($closecashsumlist->records as $data)
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

                    <span class="material-symbols-outlined">
                        edit_square
                    </span>
                </div>
            </div>
            <div class="col">
                <div class="card-body">
                    <label><b> Inicio caja: {{ $data->BeginningBalance }} </b></label>
                </div>
            </div>

        </div>
    </div>
    <div class="card text-center m-2">
        <div class="row border m-1">
            @if (isset($closecashlist))
            <table class="table table-borderless">

                <tr>
                    <td style="width: 100px;">
                        <h5><b>Identificador</b></h5>
                    </td>
                    <td style="width: 100px;">
                        <h5><b>Nombre Responsable</b></h5>
                    </td>
                    <td style="width: 100px;" align="right">
                        <h5><b>SubTotal</b></h5>
                    </td>
                    <td style="width: 100px;" align="right">
                        <h5><b>Neto</b></h5>
                    </td>
                    <td style="width: 100px;" align="right">
                        <h5><b>Inicio caja</b></h5>
                    </td>
                </tr>
                @if ($closecashlist->{'records-size'} > 0)
                @foreach($closecashlist->records as $closecashl)
                <tbody>

                    <tr>
                        <td style="width: 100px;"><label>
                                @php
                                echo ($closecashl->ba_name);
                                @endphp
                            </label></td>
                        <td style="width: 100px;"><label>{{$closecashl->u_name;}}</label></td>
                        <td style="width: 100px;" align="right"><label>
                                @php
                                echo number_format($closecashl->SubTotal, 2, ',', ' ');
                                @endphp
                            </label></td>
                        <td style="width: 100px;" align="right"><label>
                                @php
                                echo number_format($closecashl->NetTotal, 2, ',', ' ');
                                @endphp
                            </label></td>
                        <td style="width: 100px;" align="right"><label>
                                @php
                                echo number_format($closecashl->BeginningBalance, 2, ',', ' ');
                                @endphp
                            </label></td>
                    </tr>
                </tbody>
                @endforeach
                @endif
            </table>
            @endif
        </div>
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


    <div class="col-2 col-sm-2 col-md-2 col-lg-2" name="id">
        <input hidden name="id" value="{{ $dataday-> id}}">
    </div>



    <div class="card-group m-2">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><b> Monto Sistema </b></h5>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th style="font-size:12px; width: 100px;">
                                <p class="card-text">Efectivo</p>
                            </th>
                            <th></th>
                            <th align="right">
                                <h5 class="mb-0 fw-bold" id="Montosistema_t">{{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100 }}</h5>
                            </th>
                            <th>
                                <div class="col borde text-white"></div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size:12px; width: 100px;">$1x</td>
                            <td> <input name="x_oneamtSistema" value="{{ $data->x_oneamt }}" type="number" style="width: 100px;" readonly class="text-left" placeholder="0.00"></td>
                            <td align="right">{{ $data->x_oneamt*1 }}</td>
                            <td>
                                <div class="col borde text-white"></div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">$5x</td>
                            <td><input name="x_fiveamtSistema" value="{{ $data->x_fiveamt }}" type="number" style="width: 100px;" readonly class="text-left" placeholder="0.00"></td>
                            <td align="right">{{ $data->x_fiveamt*5 }}</td>
                            <td>
                                <div class="col borde text-white"></div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">$10x</td>
                            <td><input name="x_tenamtSistema" value="{{ $data->x_tenamt }}" type="number" style="width: 100px;" readonly class="text-left" placeholder="0.00"></td>
                            <td align="right">{{ $data->x_tenamt*10 }}</td>
                            <td>
                                <div class="col borde text-white"></div>
                            </td>

                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">$20x</td>
                            <td><input name="x_twentyamtSistema" value="{{ $data->x_twentyamt }}" type="number" style="width: 100px;" readonly class="text-left" placeholder="0.00"></td>
                            <td align="right">{{ $data->x_twentyamt*20 }}</td>
                            <td>
                                <div class="col borde text-white"></div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">$50x</td>
                            <td><input name="x_fiftyamtSistema" value="{{ $data->x_fiftyamt }}" type="number" style="width: 100px;" readonly class="text-left" placeholder=""></td>
                            <td align="right">{{ $data->x_fiftyamt*50 }}</td>
                            <td>
                                <div class="col borde text-white"></div>
                            </td>

                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">$100x</td>
                            <td><input name="x_hundredamtSistema" value="{{ $data->x_hundredamt }}" type="number" style="width: 100px;" readonly class="text-left" placeholder="0.00"></td>
                            <td align="right">{{ $data->x_hundredamt*100 }}</td>
                            <td>
                                <div class="col borde text-white"></div>
                            </td>
                        </tr>
                    </tbody>

                </table>

                <div class="card-body">
                    <br><br>
                    <h5 class="card-title"></h5>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th style=" width: 100px;">Otros</th>
                                <th>
                                    <h5 class="mb-0 fw-bold" id="Otros">{{ $data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+ $data->CreditAmt +$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</h5>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-size:12px;">Yappy</td>
                                <td> <input name="yappySistema" value="{{ $data->yappy }}" type="number" step="0.01" readonly placeholder="0.00"></td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;">Otros</td>
                                <td><input name="otrosSistema" value="{{ $data->otros }}" type="number" step="0.01" readonly placeholder="0.00"></td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;">Vales Pagoda </td>
                                <td><input name="valespagodaSistema" value="{{ $data->valespagoda }}" type="number" step="0.01" readonly placeholder="0.00"></td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;"> Monto cheques</td>
                                <td> <input name="CheckAmtSistema" value="{{ $data->CheckAmt }}" type="number" step="0.01" readonly placeholder="0.00"></td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;"> Loteria</td>
                                <td> <input name="LotoAmtSistema" value="{{ $data->LotoAmt }}" type="number" step="0.01" readonly placeholder="0.00"></td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;">Vale</td>
                                <td> <input name="valeAmt" value="{{ $data->CreditAmt }}" type="number" step="0.01" readonly placeholder="0.00"></td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;">Tarjetas </td>
                                <td> <input name="CardAmtSistema" value="{{ $data->CardAmt }}" type="number" step="0.01" readonly placeholder="0.00"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input disabled></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input disabled></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input disabled></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input disabled></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input disabled></td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;"> Sencillo </td>
                                <td><input name="CashAmtSistema" value="{{ $data->CashAmt }}" type="number" step="0.01" readonly placeholder="0.00"></td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;">Rollos </td>
                                <td> <input name="CoinRollSistema" value="{{ $data->CoinRoll }}" type="number" step="0.01" readonly placeholder="0.00"></td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;">Facturas </td>
                                <td> <input name="InvoiceAmtSistema" value="{{ $data->InvoiceAmt }}" type="number" step="0.01" readonly placeholder="0.00"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input disabled step="0.01"></td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;">Vale digital </td>
                                <td> <input name="VoucherAmtSistema" value="{{ $data->VoucherAmt }}" type="number" step="0.01" readonly placeholder="0.00"></td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;">Beca Digital </td>
                                <td> <input name="GrantAmtSistema" value="{{ $data->GrantAmt }}" type="number" step="0.01" readonly placeholder="0.00">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card bg-light">
                <div class="card-body p-1">
                    <div class="row m-0 p-0">
                        <div class="m-0 p-0 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h4 class="mb-0">Monto contado</h4>
                        </div>
                        <div class="text-right m-0 p-0 col-6 col-sm-6 col-md-6 col-lg-6">
                            <!-- {{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100+$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }} -->
                            <!-- <h5 class="mb-0 fw-bold text-success" id="Monto_Gerente_t"> </h5> -->
                            <h5 class="mb-0 fw-bold ">{{ $data->NetTotal }}</h5>
                        </div>
                    </div>
                    <h6 class="mb-0 text-right">Subtotal &nbsp;&nbsp;&nbsp;= {{ $data->SubTotal }}</b></h6>
                    <h6 class="mb-0 text-right">Monto X &nbsp;&nbsp;&nbsp;= <b>{{ $data->XAmt }}</b></h6>
                    <h6 class="mb-0 text-right">Diferencia = <b>{{ $data->DifferenceAmt }}</b></h6>
                </div>
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
                                <h5 class="mb-0 fw-bold text-success" id="Fiscalizadora_t">{{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100 }}</h5>
                            </th>
                            <th align="right">
                                <div align="right" style="font-size:12px;">Diferencia</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>$1x</td>
                            <td><input value="{{ $dataday-> x_oneamtFiscalizadora}}" name="x_oneamtFiscalizadora" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()">
                            </td>
                            <td align="right">
                                <div class="col borde" id="x_oneamtFiscalizadora_t">{{ $data->x_oneamt*1 }}</div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_oneamtFiscalizadora_r" style="padding-left: 10px;">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$5x</td>
                            <td><input value="{{ $dataday-> x_fiveamtFiscalizadora}}" name="x_fiveamtFiscalizadora" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()">

                            </td>
                            <td align="right">
                                <div class="col borde" id="x_fiveamtFiscalizadora_t"> {{ $data->x_fiveamt*5}}</div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_fiveamtFiscalizadora_r" style="padding-left: 10px;">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$10x</td>
                            <td><input value="{{ $dataday-> x_tenamtFiscalizadora}}" name="x_tenamtFiscalizadora" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()">

                            </td>
                            <td align="right">
                                <div class="col borde" id="x_tenamtFiscalizadora_t">{{ $data->x_tenamt*10 }}</div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_tenamtFiscalizadora_r" style="padding-left: 10px;">0.00</div>
                            </td>

                        </tr>
                        <tr>
                            <td>$20x</td>
                            <td><input value="{{ $dataday-> x_twentyamtFiscalizadora}}" name="x_twentyamtFiscalizadora" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()">

                            </td>
                            <td align="right">
                                <div class="col borde" id="x_twentyamtFiscalizadora_t">{{ $data->x_twentyamt*20 }}</div>

                            <td align="right">
                                <div class="col borde text-success" id="x_twentyamtFiscalizadora_r" style="padding-left: 10px;">0.00</div>
                            </td>
                            </td>

                        </tr>
                        <tr>
                            <td>$50x</td>
                            <td> <input value="{{ $dataday-> x_fiftyamtFiscalizadora}}" name="x_fiftyamtFiscalizadora" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()">
                            </td>
                            <td align="right">
                                <div class="col borde" id="x_fiftyamtFiscalizadora_t">{{ $data->x_fiftyamt*50 }} </div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_fiftyamtFiscalizadora_r" style="padding-left: 10px;">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$100x</td>
                            <td> <input value="{{ $dataday-> x_hundredamtFiscalizadora}}" name="x_hundredamtFiscalizadora" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()">

                            <td align="right">
                                <div class="col borde" id="x_hundredamtFiscalizadora_t"> {{ $data->x_hundredamt*100 }} </div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_hundredamtFiscalizadora_r" style="padding-left: 10px;">0.00</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Otros</th>
                            <th>
                                <h5 class="mb-0 fw-bold text-success" id="Otros_Fiscalizadora_t">{{ $data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</h5>
                            </th>
                            <th align="right">
                                <div align="right" style="font-size:12px;">Diferencia</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size:12px; width: 100px;">Yappy</td>
                            <td><input value="{{ $dataday-> yappyFiscalizadora}}" id="yappyFiscalizadora" name="yappyFiscalizadora" value="" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()">
                            </td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="yappyFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">Otros</td>
                            <td><input value="{{ $dataday-> otrosFiscalizadora}}" name="otrosFiscalizadora" value="" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()"></td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="otrosFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">Vales Pagoda </td>
                            <td><input value="{{ $dataday-> valespagodaFiscalizadora}}" name="valespagodaFiscalizadora" value="" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()"></td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="valespagodaFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;"> Monto cheques</td>
                            <td> <input value="{{ $dataday->CheckAmtFiscalizadora}}" name="CheckAmtFiscalizadora" value="" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()"></td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="CheckAmtFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">Loteria</td>
                            <td> <input value="{{ $dataday->LotoAmtFiscalizadora }}" name="LotoAmtFiscalizadora" value="" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()"></td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="LotoAmtFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width:100px;">Vale</td>
                            <td><input value="{{ $dataday-> valeAmtFiscalizadora }}" name="valeAmtFiscalizadora" value="" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()"></td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="valeAmtFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">Tarjeta Clave</td>
                            <td><input value="{{ $dataday-> CardClaveFiscalizadora }}" name="CardClaveFiscalizadora" value="" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()"></td>
                            <td align="right" style="font-size:12px;">
                                <div style="visibility: hidden;" class="col borde text-success" id="CardClaveFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">Tarjeta Vale</td>
                            <td><input value="{{ $dataday-> CardValeFiscalizadora }}" name="CardValeFiscalizadora" value="" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()"></td>
                            <td align="right" style="font-size:12px;">
                                <div style="visibility: hidden;" class="col borde text-success" id="CardValeFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">Tarjeta Visa</td>
                            <td><input value="{{ $dataday-> CardVisaFiscalizadora }}" name="CardVisaFiscalizadora" value="" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()"></td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="CardVisaFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">Tarjeta Master</td>
                            <td><input value="{{ $dataday-> CardMasterFiscalizadora }}" name="CardMasterFiscalizadora" value="" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()"></td>
                            <td align="right" style="font-size:12px;">
                                <div style="visibility: hidden;" class="col borde text-success" id="CardMasterFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">Tarjeta American</td>
                            <td><input value="{{ $dataday-> CardAEFiscalizadora }}" name="CardAEFiscalizadora" value="" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()"></td>
                            <td align="right" style="font-size:12px;">
                                <div style="visibility: hidden;" class="col borde text-success" id="CardAEFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">Tarjeta BAC</td>
                            <td><input value="{{ $dataday-> CardBACFiscalizadora }}" name="CardBACFiscalizadora" value="" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()"></td>
                            <td align="right" style="font-size:12px;">
                                <div style="visibility: hidden;" class="col borde text-success" id="CardBACFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">Sencillo</td>
                            <td><input value="{{ $dataday-> CashAmtFiscalizadora }}" name="CashAmtFiscalizadora" value="" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()"></td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="CashAmtFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">Rollos </td>
                            <td><input value="{{ $dataday-> CoinRollFiscalizadora}}" name="CoinRollFiscalizadora" value="" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()"> </td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="CoinRollFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">Facturas </td>
                            <td><input value="{{ $dataday-> InvoiceAmtFiscalizadora }}" name="InvoiceAmtFiscalizadora" value="" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()"> </td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="InvoiceAmtFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">Facturas Propias</td>
                            <td><input value="{{ $dataday-> InvoiceAmtPropiasFiscalizadora }}" name="InvoiceAmtPropiasFiscalizadora" value="" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()"> </td>
                            <td align="right" style="font-size:12px;">
                                <div style="visibility: hidden;" class="col borde text-success" id="InvoiceAmtPropiasFiscalizadora_r"></div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">Vale digital </td>
                            <td><input value="{{ $dataday-> VoucherAmtFiscalizadora }}" name="VoucherAmtFiscalizadora" value="" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()"> </td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="VoucherAmtFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">Beca Digital </td>
                            <td><input value="{{ $dataday-> GrantAmtFiscalizadora}}" name="GrantAmtFiscalizadora" value="" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal();clon();cal()" onkeyup="cal();clon();cal()"> </td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="GrantAmtFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card bg-light">
                <div class="card-body p-1">
                    <div class="row m-0 p-0">
                        <div class="m-0 p-0 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h4 class="mb-0">Monto contado</h4>
                        </div>
                        <div class="text-right m-0 p-0 col-6 col-sm-6 col-md-6 col-lg-6">
                            <!-- {{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100+$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}     -->
                            <h5 class="mb-0 fw-bold ">{{ $data->NetTotal }}</h5>
                        </div>
                    </div>
                    <!-- Subtotal = {{ $data->BeginningBalance+$data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100+$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }} -->
                    <h6 class="mb-0 text-right">Subtotal=</h6>
                    <h6 class="mb-0 text-success" id="Monto_Fiscalizadora_t"></h6>
                    <h6 class="mb-0 text-right">Monto X = <b>{{ $data->XAmt }}</b></h6>
                    <h6 class="mb-0 text-right">Diferencia = <b>{{ $data->DifferenceAmt }}</b></h6>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Total Panaderia</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h5 class="mb-0"> <input name="totalPanaderiaFiscalizadora" value="{{ $dataday-> totalPanaderiaFiscalizadora}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00"> </h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Total Pagatodo</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h5 class="mb-0"> <input name="totalPagatodoFiscalizadora" value="{{ $dataday->totalPagatodoFiscalizadora}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00"> </h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Total Super</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h5 class="mb-0"> <input name="totalsuperFiscalizadora" value="{{ $dataday->totalsuperFiscalizadora}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00"> </h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Dinero de Taxi</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h5 class="mb-0"> <input name="dineroTaxiFiscalizadora" value="{{ $dataday->dineroTaxiFiscalizadora}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00"> </h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Vuelto de mercado</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h5 class="mb-0"> <input name="vueltoMercadoFiscalizadora" value="{{ $dataday->vueltoMercadoFiscalizadora}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00"> </h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Comentarios</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h5 class="mb-0"> <textarea name="comentariosFiscalizadora" value="" class="w-100 text-right" placeholder="Comentarios">{{$dataday->comentariosFiscalizadora}}</textarea></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><b>Gerente</b></h5>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>
                                <p class="card-text">Efectivo</p>
                            </th>
                            <th> </th>
                            <th>
                                <h5 class="mb-0 fw-bold text-success" id="Gerente_t">{{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100 }}</h5>
                            </th>
                            <th align="right">
                                <div align="right" style="font-size:12px;">Diferencia</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>$1x</td>
                            <td>
                                <input name="x_oneamtGerente" value="{{ $dataday->x_oneamtGerente}}" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal()" onkeyup="cal()" />
                            </td>
                            <td align="right">
                                <div class="col borde" id="x_oneamtGerente_t">{{ $data->x_oneamt*1 }}</div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_oneamtGerente_r" style="padding-left: 10px;">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$5x</td>
                            <td> <input name="x_fiveamtGerente" value="{{ $dataday->x_fiveamtGerente}}" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td align="right">
                                <div class="col borde" id="x_fiveamtGerente_t">{{ $data->x_fiveamt*5}}</div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_fiveamtGerente_r" style="padding-left: 10px;">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$10x</td>
                            <td> <input name="x_tenamtGerente" value="{{ $dataday->x_tenamtGerente}}" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td align="right">
                                <div class="col borde" id="x_tenamtGerente_t">{{ $data->x_tenamt*10 }}</div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_tenamtGerente_r" style="padding-left: 10px;">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$20x</td>
                            <td> <input name="x_twentyamtGerente" value="{{ $dataday->x_twentyamtGerente}}" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td align="right">
                                <div class="col borde" id="x_twentyamtGerente_t">{{ $data->x_twentyamt*20 }}</div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_twentyamtGerente_r" style="padding-left: 10px;">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$50x</td>
                            <td> <input name="x_fiftyamtGerente" value="{{ $dataday->x_fiftyamtGerente}}" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td align="right">
                                <div class="col borde" id="x_fiftyamtGerente_t">{{ $data->x_fiftyamt*50 }}</div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_fiftyamtGerente_r" style="padding-left: 10px;">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$100x</td>
                            <td><input name="x_hundredamtGerente" value="{{ $dataday->x_hundredamtGerente}}" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td align="right">
                                <div class="col borde" id="x_hundredamtGerente_t">{{ $data->x_hundredamt*100 }}</div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_hundredamtGerente_r" style="padding-left: 10px;">0.00</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <table class="table ">

                    <thead>
                        <tr>
                            <th>Otros</th>
                            <th>
                                <!-- {{ $data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }} -->
                                <h5 class="mb-0 fw-bold text-success" id="Otros_Gerente_total"> </h5>
                            </th>
                            <th align="right">
                                <div align="right" style="font-size:12px;" id="Otros_Gerente_t">0.00</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size:12px; width: 100px;" class="text-justify">Yappy</td>
                            <td><input name="yappyGerente" value="{{ $dataday->yappyGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="yappyGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; width: 100px;">Otros</td>
                            <td>
                                <input name="otrosGerente" value="{{ $dataday->otrosGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()">

                            </td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="otrosGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;width: 100px;">Vales Pagoda </td>
                            <td>
                                <input name="valespagodaGerente" value="{{ $dataday->valespagodaGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()">

                            </td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="valespagodaGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;width: 100px;"> Monto cheques</td>
                            <td>
                                <input name="CheckAmtGerente" value="{{ $dataday->CheckAmtGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()">

                            </td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="CheckAmtGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;width: 100px;"> Loteria</td>
                            <td>
                                <input name="LotoAmtGerente" value="{{ $dataday->LotoAmtGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()">

                            </td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="LotoAmtGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;width: 100px;">Vale</td>
                            <td><input name="valeAmtGerente" value="{{ $dataday->valeAmtGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde" id="valeAmtGerente_r">0.00</div>
                            </td>
                        </tr>

                        <tr>
                            <td style="font-size:12px;width: 100px;">Tarjeta Clave</td>
                            <td><input name="CardClaveGerente" value="{{ $dataday->CardClaveGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></td>
                            <td align="right" style="font-size:12px;">
                                <div style="visibility: hidde;" class="col borde text-success" id="CardClaveGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;width: 100px;">Tarjeta Vale</td>
                            <td>
                                <input name="CardValeGerente" value="{{ $dataday->CardValeGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td align="right" style="font-size:12px;">
                                <div style="visibility: hidde;" class="col borde text-success" id="CardValeGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;width: 100px;">Tarjeta Visa</td>
                            <td>
                                <input name="CardVisaGerente" value="{{ $dataday->CardVisaGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="CardVisaGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;width: 100px;">Tarjeta Master</td>
                            <td>
                                <input name="CardMasterGerente" value="{{ $dataday->CardMasterGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td align="right" style="font-size:12px;">
                                <div style="visibility: hidde;" class="col borde text-success" id="CardMasterGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;width: 100px;">Tarjeta American</td>
                            <td>
                                <input name="CardAEGerente" value="{{ $dataday->CardAEGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td align="right" style="font-size:12px;">
                                <div style="visibility: hidde;" class="col borde text-success" id="CardAEGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;width: 100px;">Tarjeta BAC</td>
                            <td>
                                <input name="CardBACGerente" value="{{ $dataday->CardBACGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td align="right" style="font-size:12px;">
                                <div style="visibility: hidde;" class="col borde text-success" id="CardBACGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;width: 100px;">Sencillo</td>
                            <td>
                                <input name="CashAmtGerente" value="{{ $dataday-> CashAmtGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="CashAmtGerente_r">0.0</div>
                            </td>
                        </tr>

                        <tr>
                            <td style="font-size:12px;width: 100px;">Rollos </td>
                            <td>
                                <input name="CoinRollGerente" value="{{ $dataday->CoinRollGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="CoinRollGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;width: 100px;">Facturas </td>
                            <td>
                                <input name="InvoiceAmtGerente" value="{{ $dataday->InvoiceAmtGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="InvoiceAmtGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;width: 100px;">Facturas Propias</td>
                            <td>
                                <input name="InvoiceAmtPropiasGerente" value="{{ $dataday->InvoiceAmtPropiasGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="InvoiceAmtPropiasGerente_r">0.0</div>
                            </td>
                        </tr>

                        <tr>
                            <td style="font-size:12px;width: 100px;">Vale digital </td>
                            <td>
                                <input name="VoucherAmtGerente" value="{{ $dataday->VoucherAmtGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="VoucherAmtGerente_r">0.0</div>
                            </td>

                        </tr>
                        <tr>
                            <td style="font-size:12px;width: 100px;">Beca Digital </td>
                            <td>
                                <input name="GrantAmtGerente" value="{{ $dataday->GrantAmtGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td align="right" style="font-size:12px;">
                                <div class="col borde text-success" id="GrantAmtGerente_r">0.0</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card bg-light">
                <div class="card-body p-1">
                    <div class="row m-0 p-0">
                        <div class="m-0 p-0 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h4 class="mb-0">Monto contado</h4>
                        </div>
                        <div class="text-right m-0 p-0 col-6 col-sm-6 col-md-6 col-lg-6">
                            <!-- {{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100+$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }} -->
                            <!-- <h5 class="mb-0 fw-bold text-success" id="Monto_Gerente_t"> </h5> -->
                            <h5 class="mb-0 fw-bold ">{{ $data->NetTotal }}</h5>
                        </div>
                    </div>
                    <h6 class="mb-0 text-right" id="Monto_Gerente_t">Subtotal = {{ $data->BeginningBalance+$data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100+$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</b></h6>
                    <h6 class="mb-0 text-right">Monto X = <b>{{ $data->XAmt }}</b></h6>
                    <h6 class="mb-0 text-right">Diferencia = <b>{{ $data->DifferenceAmt }}</b></h6>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Total Panaderia</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <input name="totalPanaderiaGerente" value="{{ $dataday->totalPanaderiaGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00"> </h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Total Pagatodo</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <input name="totalPagatodoGerente" value="{{ $dataday->totalsuperGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00"> </h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Total Super</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <input name="totalsuperGerente" value="{{ $dataday->totalsuperGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00"> </h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Dinero de Taxi</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <input name="dineroTaxiGerente" value="{{ $dataday->dineroTaxiGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00"> </h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Vuelto de mercado</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <input name="vueltoMercadoGerente" value="{{ $dataday->vueltoMercadoGerente}}" type="number" step="0.01" class="w-100 text-right" placeholder="0.00"> </h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Comentarios</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <textarea name="comentariosGerente" value="" class="w-100 text-right" placeholder="Comentarios">{{ $dataday->comentariosGerente}}</textarea></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card text-center m-2">
        <div class="row border m-1">
            <div class="col">
                <div class="card-body">
                    <label for="formFileMultiple" class="form-label">Por favor adjunte los reportes</label>
                    <input class="form-control" type="file" id="Fileclosecash" name="Fileclosecash" value="0">
                </div>
            </div>
        </div>
    </div>
    <div class="card text-center m-2">
        <div class="row border m-1">
            <div class="col">
                <div class="card-body">

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" type="button" onclick="zero()">Guardar</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>


@php
$opcion = 1;
@endphp
@endforeach
@endif
@endforeach
@endif
@if (isset($closecashsumlist))
@if ($opcion==0)
<form name="closecash_store" id="closecash_store" method="POST" action="{{ route('closecash.store') }}" enctype="multipart/form-data">
    @csrf
    @if ($closecashsumlist->{'records-size'} > 0)
    @foreach($closecashsumlist->records as $data)
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
                    <span class="material-symbols-outlined">
                        note_add
                    </span>
                </div>
            </div>
            <div class="col">
                <div class="card-body">
                    <label>Inicio caja:<b id="InicioCaja"> {{ $data->BeginningBalance }} </b></label>
                </div>
            </div>
        </div>
    </div>
    <div class="card text-center m-2">
        <div class="row border m-1">
            @if (isset($closecashlist))
            <table class="table table-borderless">
                <tr>
                    <td style="width: 100px;">
                        <h5><b>Identificador</b></h5>
                    </td>
                    <td style="width: 100px;">
                        <h5><b>Cajera</b></h5>
                    </td>
                    <td style="width: 100px;" align="right">
                        <h5><b>Inicio caja</b></h5>
                    </td>
                    <td style="width: 100px;" align="right">
                        <h5><b>Subtotal</b></h5>
                    </td>
                    <td style="width: 100px;" align="right">
                        <h5><b>Monto Contado</b></h5>
                    </td>
                    <td style="width: 100px;" align="right">
                        <h5><b>Monto X</b></h5>
                    </td>
                    <td style="width: 100px;" align="right">
                        <h5><b>Diferencia</b></h5>
                    </td>
                </tr>
                @if ($closecashlist->{'records-size'} > 0)
                @foreach($closecashlist->records as $closecashl)
                <tbody>
                    <tr>
                        <td style="width: 100px;"><label>
                                @php
                                echo ($closecashl->ba_name);
                                @endphp
                            </label></td>
                        <td style="width: 100px;"><label>{{$closecashl->u_name;}}</label></td>
                        <td style="width: 100px;" align="right"><label>
                                @php
                                echo number_format($closecashl->BeginningBalance, 2, ',', ' ');
                                @endphp
                            </label></td>
                        <td style="width: 100px;" align="right"><label>
                                @php
                                echo number_format($closecashl->SubTotal, 2, ',', ' ');
                                @endphp
                            </label></td>
                        <td style="width: 100px;" align="right"><label>
                                @php
                                echo number_format($closecashl->NetTotal, 2, ',', ' ');
                                @endphp
                            </label></td>

                        <td style="width: 100px;" align="right"><label>
                                @php
                                echo number_format($closecashl->XAmt, 2, ',', ' ');
                                @endphp
                            </label></td>
                        <td style="width: 100px;" align="right"><label>
                                @php
                                echo number_format($closecashl-> DifferenceAmt, 2, ',', ' ');
                                @endphp
                            </label></td>


                    </tr>
                </tbody>
                @endforeach
                @endif
            </table>
            @endif
        </div>
    </div>
    <style>
        .table>:not(caption)>*>* {
            padding: 0rem;
        }

        .card {
            --bs-card-spacer-y: 0.2rem;
            --bs-card-spacer-x: 0.2rem;
        }
    </style>
    <div class="card-group m-2">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><b>Monto Sistema</b></h5>
                <table class="table table-borderless ">
                    <thead>
                        <tr>
                            <th style="width: 100px;">
                                <p class="card-text">Efectivo</p>
                            </th>
                            <th style="width: 100px;"></th>
                            <th style="width: 100px;">
                                <h5 align="right" class="mb-0 fw-bold" id="Montosistema_t">{{$data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100, 2}}</h5>
                            </th>
                            <th style="width: 100px;">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>$1x</td>
                            <td> <input style="width: 100px;" name="x_oneamtSistema" value="{{ $data->x_oneamt }}" type="number" readonly class="text-left" placeholder="0.00"></td>
                            <td align="right">
                                @php
                                echo number_format($data->x_oneamt*1, 2, ',', ' ');
                                @endphp
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>$5x</td>
                            <td><input style="width: 100px;" name="x_fiveamtSistema" value="{{ $data->x_fiveamt }}" type="number" readonly class="text-left" placeholder="0.00"></td>
                            <td align="right">
                                @php
                                echo number_format($data->x_fiveamt*5, 2, ',', ' ');
                                @endphp
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>$10x</td>
                            <td><input style="width: 100px;" name="x_tenamtSistema" value="{{ $data->x_tenamt }}" type="number" readonly class="text-left" placeholder="0.00"></td>
                            <td align="right">
                                @php
                                echo number_format($data->x_tenamt*10, 2, ',', ' ');
                                @endphp
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>$20x</td>
                            <td><input style="width: 100px;" name="x_twentyamtSistema" value="{{ $data->x_twentyamt }}" type="number" readonly class="text-left" placeholder="0.00"></td>
                            <td align="right">
                                @php
                                echo number_format($data->x_twentyamt*20, 2, ',', ' ');
                                @endphp
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>$50x</td>
                            <td><input style="width: 100px;" name="x_fiftyamtSistema" value="{{ $data->x_fiftyamt }}" type="number" readonly class="text-left" placeholder="0.0"></td>
                            <td align="right">
                                @php
                                echo number_format($data->x_fiftyamt*50, 2, ',', ' ');
                                @endphp
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>$100x</td>
                            <td><input style="width: 100px;" name="x_hundredamtSistema" value="{{ $data->x_hundredamt }}" type="number" readonly class="text-left" placeholder="0.00"></td>
                            <td align="right">
                                @php
                                echo number_format($data->x_hundredamt*100, 2, ',', ' ');
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
                                <h5 align="right" class="mb-0 fw-bold" id="Otros">{{$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+ $data->CreditAmt +$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt}}</h5>
                            </th>
                            <th style="width: 100px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size:12px;">Yappy</td>
                            <td> <input style="width: 100px;" name="yappySistema" value="{{ $data->yappy }}" type="number" step="0.01" readonly placeholder="0.00"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Otros</td>
                            <td><input style="width: 100px;" name="otrosSistema" value="{{ $data->otros }}" type="number" step="0.01" readonly placeholder="0.00"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Vales Pagoda </td>
                            <td><input style="width: 100px;" name="valespagodaSistema" value="{{ $data->valespagoda }}" type="number" step="0.01" readonly placeholder="0.00"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;"> Monto cheques</td>
                            <td> <input style="width: 100px;" name="CheckAmtSistema" value="{{ $data->CheckAmt }}" type="number" step="0.01" readonly placeholder="0.00">
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;"> Loteria</td>
                            <td> <input style="width: 100px;" name="LotoAmtSistema" value="{{ $data->LotoAmt }}" type="number" step="0.01" readonly placeholder="0.00">
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Vale</td>
                            <td> <input style="width: 100px;" name="valeAmt" value="{{ $data->CreditAmt }}" type="number" step="0.01" readonly placeholder="0.00">
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Tarjetas </td>
                            <td> <input style="width: 100px;" name="CardAmtSistema" value="{{ $data->CardAmt }}" type="number" step="0.01" readonly placeholder="0.00">
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input style="width: 100px;" disabled sstep="0.01"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input style="width: 100px;" disabled sstep="0.01"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input style="width: 100px;" disabled sstep="0.01"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input style="width: 100px;" disabled sstep="0.01"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input style="width: 100px;" disabled step="0.01"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;"> Sencillo </td>
                            <td><input style="width: 100px;" name="CashAmtSistema" value="{{ $data->CashAmt }}" type="number" step="0.01" readonly placeholder="0.00">
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Rollos </td>
                            <td> <input style="width: 100px;" name="CoinRollSistema" value="{{ $data->CoinRoll }}" type="number" step="0.01" readonly placeholder="0.00">
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Facturas </td>
                            <td> <input style="width: 100px;" name="InvoiceAmtSistema" value="{{ $data->InvoiceAmt }}" type="number" step="0.01" readonly placeholder="0.00">
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input style="width: 100px;" disabled step="0.01"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; ">Vale digital </td>
                            <td> <input style="width: 100px;" name="VoucherAmtSistema" value="{{ $data->VoucherAmt }}" type="number" step="0.01" readonly placeholder="0.00">
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Beca Digital </td>
                            <td> <input style="width: 100px;" name="GrantAmtSistema" value="{{ $data->GrantAmt }}" type="number" step="0.01" readonly placeholder="0.00">
                            </td>
                            <td></td>
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
                                <h5 class="mb-0 fw-bold" id="Monto_contado_Sistema" align="right">{{$data->NetTotal}}</h5>
                            </th>
                            <th style="width: 100px;">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Subtotal</td>
                            <td></td>
                            <td align="right">
                                <h6 id="Monto_Subtotal_Sistema">{{$data->SubTotal}}</h6>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Monto X </td>
                            <td></td>
                            <td align="right">@php
                                echo number_format($data->XAmt, 2, ',', ' ');
                                @endphp
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
                                <h5 align="right" class="mb-0 fw-bold text-success" id="Fiscalizadora_t"></h5>
                            </th>
                            <th align="right">
                                <div align="right" style="font-size:12px;">Diferencia</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 100px;">$1x</td>
                            <td style="width: 100px;"><input style="width: 100px;" value="" name="x_oneamtFiscalizadora" type="number" class="text-left" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()">
                            </td>
                            <td style="width: 100px;" align="right">
                                <div class="col borde" id="x_oneamtFiscalizadora_t">{{ $data->x_oneamt*1 }}</div>
                            </td>
                            <td style="width: 100px;" align="right">
                                <div class="col borde text-success" id="x_oneamtFiscalizadora_r" style="padding-left: 10px;">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$5x</td>
                            <td><input style="width: 100px;" value="" name="x_fiveamtFiscalizadora" type="number" class="text-left" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()">
                            </td>
                            <td align="right">
                                <div class="col borde" id="x_fiveamtFiscalizadora_t"> {{ $data->x_fiveamt*5}}</div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_fiveamtFiscalizadora_r" style="padding-left: 10px;">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$10x</td>
                            <td><input style="width: 100px;" value="" name="x_tenamtFiscalizadora" type="number" class="text-left" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()">
                            </td>
                            <td align="right">
                                <div class="col borde" id="x_tenamtFiscalizadora_t">{{ $data->x_tenamt*10 }}</div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_tenamtFiscalizadora_r" style="padding-left: 10px;">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$20x</td>
                            <td><input style="width: 100px;" value="" name="x_twentyamtFiscalizadora" type="number" class="text-left" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()">
                            </td>
                            <td align="right">
                                <div class="col borde" id="x_twentyamtFiscalizadora_t">{{ $data->x_twentyamt*20 }}</div>
                            <td align="right">
                                <div class="col borde text-success" id="x_twentyamtFiscalizadora_r" style="padding-left: 10px;">0.00</div>
                            </td>
                            </td>
                        </tr>
                        <tr>
                            <td>$50x</td>
                            <td> <input style="width: 100px;" value="" name="x_fiftyamtFiscalizadora" type="number" class="text-left" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()">
                            </td>
                            <td align="right">
                                <div class="col borde" id="x_fiftyamtFiscalizadora_t">{{ $data->x_fiftyamt*50 }} </div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_fiftyamtFiscalizadora_r" style="padding-left: 10px;">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$100x</td>
                            <td> <input style="width: 100px;" value="" name="x_hundredamtFiscalizadora" type="number" class="text-left" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()">
                            <td align="right">
                                <div class="col borde" id="x_hundredamtFiscalizadora_t"> {{ $data->x_hundredamt*100 }} </div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_hundredamtFiscalizadora_r" style="padding-left: 10px;">0.00</p>
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
                                <h5 align="right" class="mb-0 fw-bold text-success" id="Otros_Fiscalizadora_t">0.00</h5>
                            </th>
                            <th style="width: 100px;" align="right">
                                <div align="right" style="font-size:12px;">Diferencia</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size:12px;">Yappy</td>
                            <td><input style="width: 100px;" value="" id="yappyFiscalizadora" name="yappyFiscalizadora" value="" type="number" step="0.01" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()">
                            </td>
                            <td></td>
                            <td align="right">
                                <div class="col borde text-success" id="yappyFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Otros</td>
                            <td><input style="width: 100px;" value="" name="otrosFiscalizadora" value="" type="number" step="0.01" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()"></td>
                            <td></td>
                            <td align="right">
                                <div class="col borde text-success" id="otrosFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Vales Pagoda </td>
                            <td><input style="width: 100px;" value="" name="valespagodaFiscalizadora" value="" type="number" step="0.01" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()"></td>
                            <td></td>
                            <td align="right">
                                <div class="col borde text-success" id="valespagodaFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;"> Monto cheques</td>
                            <td> <input style="width: 100px;" value="" name="CheckAmtFiscalizadora" value="" type="number" step="0.01" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()"></td>
                            <td></td>
                            <td align="right">
                                <div class="col borde text-success" id="CheckAmtFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Loteria</td>
                            <td> <input style="width: 100px;" value="" name="LotoAmtFiscalizadora" value="" type="number" step="0.01" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()"></td>
                            <td></td>
                            <td align="right">
                                <div class="col borde text-success" id="LotoAmtFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Vale</td>
                            <td><input style="width: 100px;" value="" name="valeAmtFiscalizadora" value="" type="number" step="0.01" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()"></td>
                            <td></td>
                            <td align="right">
                                <div class="col borde text-success" id="valeAmtFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Tarjeta Clave</td>
                            <td><input style="width: 100px;" value="" name="CardClaveFiscalizadora" value="" type="number" step="0.01" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()"></td>
                            <td></td>
                            <td align="right">
                                <div style="visibility: hidden;" class="col borde text-success" id="CardClaveFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Tarjeta Vale</td>
                            <td><input style="width: 100px;" value="" name="CardValeFiscalizadora" value="" type="number" step="0.01" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()"></td>
                            <td></td>
                            <td align="right">
                                <div style="visibility: hidden;" class="col borde text-success" id="CardValeFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Tarjeta Visa</td>
                            <td><input style="width: 100px;" value="" name="CardVisaFiscalizadora" value="" type="number" step="0.01" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()"></td>
                            <td></td>
                            <td align="right">
                                <div class="col borde text-success" id="CardVisaFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Tarjeta Master</td>
                            <td><input style="width: 100px;" value="" name="CardMasterFiscalizadora" value="" type="number" step="0.01" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()"></td>
                            <td></td>
                            <td align="right">
                                <div style="visibility: hidden;" class="col borde text-success" id="CardMasterFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Tarjeta American</td>
                            <td><input style="width: 100px;" value="" name="CardAEFiscalizadora" value="" type="number" step="0.01" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()"></td>
                            <td></td>
                            <td align="right">
                                <div style="visibility: hidden;" class="col borde text-success" id="CardAEFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Tarjeta BAC</td>
                            <td><input style="width: 100px;" value="" name="CardBACFiscalizadora" value="" type="number" step="0.01" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()"></td>
                            <td></td>
                            <td align="right">
                                <div style="visibility: hidden;" class="col borde text-success" id="CardBACFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Sencillo</td>
                            <td><input style="width: 100px;" value="" name="CashAmtFiscalizadora" value="" type="number" step="0.01" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()"></td>
                            <td></td>
                            <td align="right">
                                <div class="col borde text-success" id="CashAmtFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Rollos </td>
                            <td><input style="width: 100px;" value="" name="CoinRollFiscalizadora" value="" type="number" step="0.01" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()"> </td>
                            <td></td>
                            <td align="right">
                                <div class="col borde text-success" id="CoinRollFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Facturas</td>
                            <td><input style="width: 100px;" value="" name="InvoiceAmtFiscalizadora" value="" type="number" step="0.01" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()"> </td>
                            <td></td>
                            <td align="right">
                                <div class="col borde text-success" id="InvoiceAmtFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Facturas Propias</td>
                            <td><input style="width: 100px;" value="" name="InvoiceAmtPropiasFiscalizadora" value="" type="number" step="0.01" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()"> </td>
                            <td></td>
                            <td align="right">
                                <div style="visibility: hidden;" class="col borde text-success" id="InvoiceAmtPropiasFiscalizadora_r"></div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Vale digital </td>
                            <td><input style="width: 100px;" value="" name="VoucherAmtFiscalizadora" value="" type="number" step="0.01" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()"> </td>
                            <td></td>
                            <td align="right">
                                <div class="col borde text-success" id="VoucherAmtFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Beca Digital </td>
                            <td><input style="width: 100px;" value="" name="GrantAmtFiscalizadora" value="" type="number" step="0.01" placeholder="0.00" onchange="cal();clon();cal();colores()" onkeyup="cal();clon();cal();colores()"> </td>
                            <td></td>
                            <td align="right">
                                <div class="col borde text-success" id="GrantAmtFiscalizadora_r">0.0</div>
                            </td>
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
                                <h5 class="mb-0 fw-bold text-success" id="Monto_contado_Fiscalizadora" align="right">

                                </h5>
                            </th>
                            <th style="width: 100px;">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Subtotal</td>
                            <td></td>
                            <td align="right">
                                <h6 class="mb-0 text-success" id="Monto_Fiscalizadora_t"></h6>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Monto X</td>
                            <td></td>
                            <td align="right">@php
                                echo number_format($data->XAmt, 2, ',', ' ');
                                @endphp
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
                            <td style="font-size:12px;">Total Panaderia</td>
                            <td><input name="totalPanaderiaFiscalizadora" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Total Pagatodo</td>
                            <td><input name="totalPagatodoFiscalizadora" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Total Super</td>
                            <td> <input name="totalsuperFiscalizadora" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00"> </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Dinero de Taxi</td>
                            <td><input name="dineroTaxiFiscalizadora" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00"> </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;"> Vuelto de mercado</td>
                            <td><input name="vueltoMercadoFiscalizadora" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Comentarios</td>
                            <td><textarea name="comentariosFiscalizadora" value="" style="width: 100px;" placeholder="Comentarios"></textarea></td>
                            <td></td>
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
                                <h5 align="right" class="mb-0 fw-bold text-success" id="Gerente_t">{{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100 }}</h5>
                            </th>
                            <th style="width: 100px;" align="right">
                                <div align="right" style="font-size:12px;">Diferencia</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>$1x</td>
                            <td>
                                <input style="width: 100px;" name="x_oneamtGerente" value="" type="number" class="text-left" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()" />
                            </td>
                            <td align="right">
                                <div class="col borde" id="x_oneamtGerente_t">{{ $data->x_oneamt*1 }}</div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_oneamtGerente_r" style="padding-left: 10px;">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$5x</td>
                            <td> <input style="width: 100px;" name="x_fiveamtGerente" value="" type="number" class="text-left" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()">
                            </td>
                            <td align="right">
                                <div class="col borde" id="x_fiveamtGerente_t">{{ $data->x_fiveamt*5}}</div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_fiveamtGerente_r" style="padding-left: 10px;">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$10x</td>
                            <td> <input style="width: 100px;" name="x_tenamtGerente" value="" type="number" class="text-left" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()">
                            </td>
                            <td align="right">
                                <div class="col borde" id="x_tenamtGerente_t">{{ $data->x_tenamt*10 }}</div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_tenamtGerente_r" style="padding-left: 10px;">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$20x</td>
                            <td> <input style="width: 100px;" name="x_twentyamtGerente" value="" type="number" class="text-left" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()">
                            </td>
                            <td align="right">
                                <div class="col borde" id="x_twentyamtGerente_t">{{ $data->x_twentyamt*20 }}</div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_twentyamtGerente_r" style="padding-left: 10px;">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$50x</td>
                            <td> <input style="width: 100px;" name="x_fiftyamtGerente" value="" type="number" class="text-left" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()">
                            </td>
                            <td align="right">
                                <div class="col borde" id="x_fiftyamtGerente_t">{{ $data->x_fiftyamt*50 }}</div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_fiftyamtGerente_r" style="padding-left: 10px;">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$100x</td>
                            <td><input style="width: 100px;" name="x_hundredamtGerente" value="" type="number" class="text-left" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()">
                            </td>
                            <td align="right">
                                <div class="col borde" id="x_hundredamtGerente_t">{{ $data->x_hundredamt*100 }}</div>
                            </td>
                            <td align="right">
                                <div class="col borde text-success" id="x_hundredamtGerente_r" style="padding-left: 10px;">0.00</div>
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
                                <h5 align="right" class="mb-0 fw-bold text-success" id="Otros_Gerente_t">0.00</h5>
                            </th>
                            <th style="width: 100px;" align="right">
                                <div align="right" style="font-size:12px;" id="">Diferencia</div>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size:12px;">Yappy</td>
                            <td><input name="yappyGerente" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()"></td>
                            <th>
                                <div style="visibility: hidden;" class="col borde text-success" id="yappyGerente_t">0.0</div>
                            </th>
                            <td align="right">
                                <div class="col borde text-success" id="yappyGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Otros</td>
                            <td>
                                <input name="otrosGerente" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()">
                            </td>
                            <th>
                                <div style="visibility: hidden;" class="col borde text-success" id="otrosGerente_t">0.0</div>
                            </th>
                            <td align="right">
                                <div class="col borde text-success" id="otrosGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Vales Pagoda </td>
                            <td>
                                <input name="valespagodaGerente" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()">
                            </td>
                            <th>
                                <div style="visibility: hidden;" class="col borde text-success" id="valespagodaGerente_t">0.0</div>
                            </th>
                            <td align="right">
                                <div class="col borde text-success" id="valespagodaGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;"> Monto cheques</td>
                            <td>
                                <input name="CheckAmtGerente" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()">
                            </td>
                            <th>
                                <div style="visibility: hidden;" class="col borde text-success" id="CheckAmtGerente_t">0.0</div>
                            </th>
                            <td align="right">
                                <div class="col borde text-success" id="CheckAmtGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;"> Loteria</td>
                            <td>
                                <input name="LotoAmtGerente" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()">
                            </td>
                            <th>
                                <div style="visibility: hidden;" class="col borde text-success" id="LotoAmtGerente_t">0.0</div>
                            </th>
                            <td align="right">
                                <div class="col borde text-success" id="LotoAmtGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Vale</td>
                            <td><input name="valeAmtGerente" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()"></td>
                            <th>
                                <div style="visibility: hidden;" class="col borde" id="valeAmtGerente_t">0.0</div>
                            </th>
                            <td align="right">
                                <div class="col borde text-success" id="valeAmtGerente_r">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Tarjeta Clave</td>
                            <td><input name="CardClaveGerente" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()"></td>
                            <th>
                                <div style="visibility: hidden;" class="col borde text-success" id="CardClaveGerente_t">0.00</div>
                            </th>
                            <td align="right">
                                <div style="visibility: hidde;" class="col borde text-success" id="CardClaveGerente_r">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Tarjeta Vale</td>
                            <td>
                                <input name="CardValeGerente" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()">
                            </td>
                            <th>
                                <div style="visibility: hidden;" style="visibility: hidde;" class="col borde text-success" id="CardValeGerente_t">0.0</div>
                            </th>
                            <td align="right">
                                <div style="visibility: hidde;" class="col borde text-success" id="CardValeGerente_r">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Tarjeta Visa</td>
                            <td>
                                <input name="CardVisaGerente" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()">
                            </td>
                            <th>
                                <div style="visibility: hidden;" class="col borde text-success" id="CardVisaGerente_t">0.00</div>
                            </th>
                            <td align="right">
                                <div class="col borde text-success" id="CardVisaGerente_r">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Tarjeta Master</td>
                            <td>
                                <input name="CardMasterGerente" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()">
                            </td>
                            <th>
                                <div style="visibility: hidden;" style="visibility: hidde;" class="col borde text-success" id="CardMasterGerente_t">0.00</div>
                            </th>
                            <td align="right">
                                <div style="visibility: hidde;" class="col borde text-success" id="CardMasterGerente_r">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Tarjeta American</td>
                            <td>
                                <input name="CardAEGerente" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()">
                            </td>
                            <th>
                                <div style="visibility: hidden;" style="visibility: hidde;" class="col borde text-success" id="CardAEGerente_t">0.00</div>
                            </th>
                            <td align="right">
                                <div style="visibility: hidde;" class="col borde text-success" id="CardAEGerente_r">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Tarjeta BAC</td>
                            <td><input name="CardBACGerente" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()"></td>
                            <th>
                                <div style="visibility: hidden;" style="visibility: hidde;" class="col borde text-success" id="CardBACGerente_t">0.00</div>
                            </th>
                            <td align="right">
                                <div style="visibility: hidde;" class="col borde text-success" id="CardBACGerente_r">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Sencillo</td>
                            <td>
                                <input name="CashAmtGerente" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()">
                            </td>
                            <th>
                                <div style="visibility: hidden;" class="col borde text-success" id="CashAmtGerente_t">0.00</div>
                            </th>
                            <td align="right">
                                <div class="col borde text-success" id="CashAmtGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Rollos </td>
                            <td>
                                <input name="CoinRollGerente" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()">
                            </td>
                            <th>
                                <div style="visibility: hidden;" class="col borde text-success" id="CoinRollGerente_t">0.00</div>
                            </th>
                            <td align="right">
                                <div class="col borde text-success" id="CoinRollGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Facturas </td>
                            <td>
                                <input name="InvoiceAmtGerente" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()">
                            </td>
                            <th>
                                <div style="visibility: hidden;" class="col borde text-success" id="InvoiceAmtGerente_t">0.00</div>
                            </th>
                            <td align="right">
                                <div class="col borde text-success" id="InvoiceAmtGerente_r">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Facturas Propias</td>
                            <td>
                                <input name="InvoiceAmtPropiasGerente" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()">
                            </td>
                            <th>
                                <div style="visibility: hidden;" class="col borde text-success" id="InvoiceAmtPropiasGerente_t">0.0</div>
                            </th>
                            <td align="right">
                                <div class="col borde text-success" id="InvoiceAmtPropiasGerente_r">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Vale digital </td>
                            <td>
                                <input name="VoucherAmtGerente" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()">
                            </td>
                            <th>
                                <div style="visibility: hidden;" class="col borde text-success" id="VoucherAmtGerente_t">0.0</div>
                            </th>
                            <td align="right">
                                <div class="col borde text-success" id="VoucherAmtGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Beca Digital </td>
                            <td>
                                <input name="GrantAmtGerente" value="" type="number" step="0.01" style="width: 100px;" placeholder="0.00" onchange="cal();colores()" onkeyup="cal();colores()">
                            </td>
                            <th>
                                <div style="visibility: hidden;" class="col borde text-success" id="GrantAmtGerente_t">0.0</div>
                            </th>
                            <td align="right">
                                <div class="col borde text-success" id="GrantAmtGerente_r">0.0</div>
                            </td>
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
                                <h5 class="mb-0 fw-bold text-success" id="Monto_contado_Gerente" align="right">
                                </h5>
                            </th>
                            <th style="width: 100px;">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Subtotal</td>
                            <td></td>
                            <td align="right">
                                <h6 class="mb-0 text-success" id="Monto_Gerente_t"></h6>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Monto X</td>
                            <td></td>
                            <td align="right">@php
                                echo number_format($data->XAmt, 2, ',', ' ');
                                @endphp
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
                            <td style="font-size:12px;">Total Panaderia</td>
                            <td><input name="totalPanaderiaGerente" value="" style="width: 100px;" type="number" step="0.01" placeholder="0.00"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Total Pagatodo</td>
                            <td><input name="totalPagatodoGerente" value="" style="width: 100px;" type="number" step="0.01" placeholder="0.00"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Total Super</td>
                            <td> <input name="totalsuperGerente" value="" style="width: 100px;" type="number" step="0.01" placeholder="0.00"> </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Dinero de Taxi</td>
                            <td><input name="dineroTaxiGerente" value="" style="width: 100px;" type="number" step="0.01" placeholder="0.00"> </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;"> Vuelto de mercado</td>
                            <td><input name="vueltoMercadoGerente" value="" style="width: 100px;" type="number" step="0.01" placeholder="0.00"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">Comentarios</td>
                            <td><textarea name="comentariosGerente" value="" style="width: 100px;" placeholder="Comentarios"></textarea></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card text-center m-2">
        <div class="row border m-1">
            <div class="col">
                <div class="card-body">
                    <label for="formFileMultiple" class="form-label">Por favor adjunte los reportes</label>
                    <input class="form-control" type="file" id="Fileclosecash" name="Fileclosecash" value="0">
                </div>
            </div>
        </div>
    </div>
    <div class="card text-center m-2">
        <div class="row border m-1">
            <div class="col">
                <div class="card-body">

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" type="button" onclick="zero()">Guardar</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>
@endforeach
@endif
@endif
@endif
@endsection


<script>
    window.onload = function() {
        cal();
    }

    function cal() {
        try {
            /////  Calculo de diferencia Fiscalizadora /////
            document.getElementById("x_oneamtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.x_oneamtFiscalizadora.value) - (document.closecash_store.x_oneamtSistema.value)).toFixed(2);
            document.getElementById("x_oneamtFiscalizadora_t").innerHTML = parseFloat((document.closecash_store.x_oneamtFiscalizadora.value) * 1).toFixed(2);
            document.getElementById("x_fiveamtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.x_fiveamtFiscalizadora.value) - (document.closecash_store.x_fiveamtSistema.value)).toFixed(2);
            document.getElementById("x_fiveamtFiscalizadora_t").innerHTML = parseFloat((document.closecash_store.x_fiveamtFiscalizadora.value) * 5).toFixed(2);
            document.getElementById("x_tenamtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.x_tenamtFiscalizadora.value) - (document.closecash_store.x_tenamtSistema.value)).toFixed(2);
            document.getElementById("x_tenamtFiscalizadora_t").innerHTML = parseFloat((document.closecash_store.x_tenamtFiscalizadora.value) * 10).toFixed(2);
            document.getElementById("x_twentyamtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.x_twentyamtFiscalizadora.value) - (document.closecash_store.x_twentyamtSistema.value)).toFixed(2);
            document.getElementById("x_twentyamtFiscalizadora_t").innerHTML = parseFloat((document.closecash_store.x_twentyamtFiscalizadora.value) * 20).toFixed(2);
            document.getElementById("x_fiftyamtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.x_fiftyamtFiscalizadora.value) - (document.closecash_store.x_fiftyamtSistema.value)).toFixed(2);
            document.getElementById("x_fiftyamtFiscalizadora_t").innerHTML = parseFloat((document.closecash_store.x_fiftyamtFiscalizadora.value) * 50).toFixed(2);
            document.getElementById("x_hundredamtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.x_hundredamtFiscalizadora.value) - (document.closecash_store.x_hundredamtSistema.value)).toFixed(2);
            document.getElementById("x_hundredamtFiscalizadora_t").innerHTML = parseFloat((document.closecash_store.x_hundredamtFiscalizadora.value) * 100).toFixed(2);
            document.getElementById("Fiscalizadora_t").innerHTML = parseFloat(document.getElementById("x_oneamtFiscalizadora_t").innerHTML) + parseFloat(document.getElementById("x_fiveamtFiscalizadora_t").innerHTML) + parseFloat(document.getElementById("x_tenamtFiscalizadora_t").innerHTML) + parseFloat(document.getElementById("x_twentyamtFiscalizadora_t").innerHTML) + parseFloat(document.getElementById("x_fiftyamtFiscalizadora_t").innerHTML) + parseFloat(document.getElementById("x_hundredamtFiscalizadora_t").innerHTML);
            /////  Calculo de diferencia Fiscalizadora  Fin/////

            /////  Calculo de diferencia Gerente /////
            document.getElementById("x_oneamtGerente_r").innerHTML = parseFloat((document.closecash_store.x_oneamtGerente.value) - (document.closecash_store.x_oneamtFiscalizadora.value)).toFixed(2);
            document.getElementById("x_oneamtGerente_t").innerHTML = parseFloat((document.closecash_store.x_oneamtGerente.value) * 1).toFixed(2);
            document.getElementById("x_fiveamtGerente_r").innerHTML = parseFloat((document.closecash_store.x_fiveamtGerente.value) - (document.closecash_store.x_fiveamtFiscalizadora.value)).toFixed(2);
            document.getElementById("x_fiveamtGerente_t").innerHTML = parseFloat((document.closecash_store.x_fiveamtGerente.value) * 5).toFixed(2);
            document.getElementById("x_tenamtGerente_r").innerHTML = parseFloat((document.closecash_store.x_tenamtGerente.value) - (document.closecash_store.x_tenamtFiscalizadora.value)).toFixed(2);
            document.getElementById("x_tenamtGerente_t").innerHTML = parseFloat((document.closecash_store.x_tenamtGerente.value) * 10).toFixed(2);
            document.getElementById("x_twentyamtGerente_r").innerHTML = parseFloat((document.closecash_store.x_twentyamtGerente.value) - (document.closecash_store.x_twentyamtFiscalizadora.value)).toFixed(2);
            document.getElementById("x_twentyamtGerente_t").innerHTML = parseFloat((document.closecash_store.x_twentyamtGerente.value) * 20).toFixed(2);
            document.getElementById("x_fiftyamtGerente_r").innerHTML = parseFloat((document.closecash_store.x_fiftyamtGerente.value) - (document.closecash_store.x_fiftyamtFiscalizadora.value)).toFixed(2);
            document.getElementById("x_fiftyamtGerente_t").innerHTML = parseFloat((document.closecash_store.x_fiftyamtGerente.value) * 50).toFixed(2);
            document.getElementById("x_hundredamtGerente_r").innerHTML = parseFloat((document.closecash_store.x_hundredamtGerente.value) - (document.closecash_store.x_hundredamtFiscalizadora.value)).toFixed(2);
            document.getElementById("x_hundredamtGerente_t").innerHTML = parseFloat((document.closecash_store.x_hundredamtGerente.value) * 100).toFixed(2);
            document.getElementById("Gerente_t").innerHTML = parseFloat(document.getElementById("x_oneamtGerente_t").innerHTML) + parseFloat(document.getElementById("x_fiveamtGerente_t").innerHTML) + parseFloat(document.getElementById("x_tenamtGerente_t").innerHTML) + parseFloat(document.getElementById("x_twentyamtGerente_t").innerHTML) + parseFloat(document.getElementById("x_fiftyamtGerente_t").innerHTML) + parseFloat(document.getElementById("x_hundredamtGerente_t").innerHTML);
            /////  Calculo de diferencia Fiscalizadora  Fin/////

            /////  Calculo de diferencia  OTROS Fiscalizadora 11c/////
            ////Inicializacion de Facturas
            let InvoiceAmtFiscalizadora_suma = 0;
            let InvoiceAmtPropiasFiscalizadora_suma = 0;
            let CardClaveFiscalizadora_suma = 0;
            let CardValeFiscalizadora_suma = 0;
            let CardVisaFiscalizadora_suma = 0;
            let CardMasterFiscalizadora_suma = 0;
            let CardAEFiscalizadora_suma = 0;
            let CardBACFiscalizadora_suma = 0;
            if (isNaN(parseFloat(document.closecash_store.InvoiceAmtFiscalizadora.value))) {
                InvoiceAmtFiscalizadora_suma = 0;
            } else {
                InvoiceAmtFiscalizadora_suma = parseFloat(document.closecash_store.InvoiceAmtFiscalizadora.value);
            }
            if (isNaN(parseFloat(document.closecash_store.InvoiceAmtPropiasFiscalizadora.value))) {
                InvoiceAmtPropiasFiscalizadora_suma = 0;
            } else {
                InvoiceAmtPropiasFiscalizadora_suma = parseFloat(document.closecash_store.InvoiceAmtPropiasFiscalizadora.value);
            }
            /// Inicializacion de Tarjetas
            if (isNaN(parseFloat(document.closecash_store.CardClaveFiscalizadora.value))) {
                CardClaveFiscalizadora_suma = 0;
            } else {
                CardClaveFiscalizadora_suma = parseFloat(document.closecash_store.CardClaveFiscalizadora.value);
            }
            if (isNaN(parseFloat(document.closecash_store.CardValeFiscalizadora.value))) {
                CardValeFiscalizadora_suma = 0;
            } else {
                CardValeFiscalizadora_suma = parseFloat(document.closecash_store.CardValeFiscalizadora.value)
            }
            if (isNaN(parseFloat(document.closecash_store.CardVisaFiscalizadora.value))) {
                CardVisaFiscalizadora_suma = 0;
            } else {
                CardVisaFiscalizadora_suma = parseFloat(document.closecash_store.CardVisaFiscalizadora.value);
            }
            if (isNaN(parseFloat(document.closecash_store.CardMasterFiscalizadora.value))) {
                CardMasterFiscalizadora_suma = 0;
            } else {
                CardMasterFiscalizadora_suma = parseFloat(document.closecash_store.CardMasterFiscalizadora.value);
            }
            if (isNaN(parseFloat(document.closecash_store.CardAEFiscalizadora.value))) {
                CardAEFiscalizadora_suma = 0;
            } else {
                CardAEFiscalizadora_suma = parseFloat(document.closecash_store.CardAEFiscalizadora.value);
            }
            if (isNaN(parseFloat(document.closecash_store.CardBACFiscalizadora.value))) {
                CardBACFiscalizadora_suma = 0;
            } else {
                CardBACFiscalizadora_suma = parseFloat(document.closecash_store.CardBACFiscalizadora.value);
            }
            const card = parseFloat(CardClaveFiscalizadora_suma + CardValeFiscalizadora_suma + CardVisaFiscalizadora_suma + CardMasterFiscalizadora_suma + CardAEFiscalizadora_suma + CardBACFiscalizadora_suma).toFixed(2);
            document.getElementById("yappyFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.yappyFiscalizadora.value) - (document.closecash_store.yappySistema.value)).toFixed(2);
            document.getElementById("otrosFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.otrosFiscalizadora.value) - (document.closecash_store.otrosSistema.value)).toFixed(2);
            document.getElementById("valespagodaFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.valespagodaFiscalizadora.value) - (document.closecash_store.valespagodaSistema.value)).toFixed(2);
            document.getElementById("CheckAmtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.CheckAmtFiscalizadora.value) - (document.closecash_store.CheckAmtSistema.value)).toFixed(2);
            document.getElementById("LotoAmtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.LotoAmtFiscalizadora.value) - (document.closecash_store.LotoAmtSistema.value)).toFixed(2);
            document.getElementById("CashAmtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.CashAmtFiscalizadora.value) - (document.closecash_store.CashAmtSistema.value)).toFixed(2);
            document.getElementById("CoinRollFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.CoinRollFiscalizadora.value) - (document.closecash_store.CoinRollSistema.value)).toFixed(2);
            document.getElementById("VoucherAmtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.VoucherAmtFiscalizadora.value) - (document.closecash_store.VoucherAmtSistema.value)).toFixed(2);
            document.getElementById("GrantAmtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.GrantAmtFiscalizadora.value) - (document.closecash_store.GrantAmtSistema.value)).toFixed(2);
            document.getElementById("valeAmtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.valeAmtFiscalizadora.value) - (document.closecash_store.valeAmt.value)).toFixed(2);
            document.getElementById("InvoiceAmtFiscalizadora_r").innerHTML = parseFloat((InvoiceAmtFiscalizadora_suma + InvoiceAmtPropiasFiscalizadora_suma) - document.closecash_store.InvoiceAmtSistema.value).toFixed(2);
            document.getElementById("CardClaveFiscalizadora_r").innerHTML = parseFloat(card - document.closecash_store.CardAmtSistema.value).toFixed(2);
            document.getElementById("CardValeFiscalizadora_r").innerHTML = parseFloat(card - document.closecash_store.CardAmtSistema.value).toFixed(2);
            document.getElementById("CardVisaFiscalizadora_r").innerHTML = parseFloat(card - document.closecash_store.CardAmtSistema.value).toFixed(2);
            document.getElementById("CardMasterFiscalizadora_r").innerHTML = parseFloat(card - document.closecash_store.CardAmtSistema.value).toFixed(2);
            document.getElementById("CardAEFiscalizadora_r").innerHTML = parseFloat(card - document.closecash_store.CardAmtSistema.value).toFixed(2);
            document.getElementById("CardBACFiscalizadora_r").innerHTML = parseFloat(card - document.closecash_store.CardBACSistema.value).toFixed(2);
            /////  Calculo de diferencia  OTROS Fiscalizadora Fin/////

            /////  Calculo de diferencia  OTROS Gerente 11c /////

            let CardClaveGerente_suma = 0;
            let CardValeGerente_suma = 0;
            let CardVisaGerente_suma = 0;
            let CardMasterGerente_suma = 0;
            let CardAEGerente_suma = 0;
            let CardBACGerente_suma = 0;
            const cardg = parseFloat(parseFloat(document.closecash_store.CardClaveGerente.value) + parseFloat(document.closecash_store.CardValeGerente.value) + parseFloat(document.closecash_store.CardVisaGerente.value) + parseFloat(document.closecash_store.CardMasterGerente.value) + parseFloat(document.closecash_store.CardAEGerente.value) + parseFloat(document.closecash_store.CardBACGerente.value)).toFixed(2);
            document.getElementById("CardClaveGerente_r").innerHTML = parseFloat(cardg - card).toFixed(2);
            document.getElementById("CardValeGerente_r").innerHTML = parseFloat(cardg - card).toFixed(2);
            document.getElementById("CardVisaGerente_r").innerHTML = parseFloat(cardg - card).toFixed(2);
            document.getElementById("CardMasterGerente_r").innerHTML = parseFloat(cardg - card).toFixed(2);
            document.getElementById("CardAEGerente_r").innerHTML = parseFloat(cardg - card).toFixed(2);
            document.getElementById("CardBACGerente_r").innerHTML = parseFloat(cardg - card).toFixed(2);

            /////  Calculo de diferencia  OTROS Gerente Fin /////
            ///tarjetas
            if (isNaN(document.getElementById("CardClaveFiscalizadora_r").innerHTML)) {
                //cambioCardVisaFiscalizadora.classList.replace("text-success", "text-white");
                document.getElementById("CardClaveFiscalizadora_r").innerHTML = -(document.closecash_store.CardAmtSistema.value);
            }
            if (isNaN(document.getElementById("CardValeFiscalizadora_r").innerHTML)) {
                //cambioCardVisaFiscalizadora.classList.replace("text-success", "text-white");
                document.getElementById("CardValeFiscalizadora_r").innerHTML = -(document.closecash_store.CardAmtSistema.value);
            }
            if (isNaN(document.getElementById("CardVisaFiscalizadora_r").innerHTML)) {
                //cambioCardVisaFiscalizadora.classList.replace("text-success", "text-white");
                document.getElementById("CardVisaFiscalizadora_r").innerHTML = -(document.closecash_store.CardAmtSistema.value);
            }
            if (isNaN(document.getElementById("CardMasterFiscalizadora_r").innerHTML)) {
                //cambioCardVisaFiscalizadora.classList.replace("text-success", "text-white");
                document.getElementById("CardMasterFiscalizadora_r").innerHTML = -(document.closecash_store.CardAmtSistema.value);
            }
            if (isNaN(document.getElementById("CardAEFiscalizadora_r").innerHTML)) {
                //cambioCardVisaFiscalizadora.classList.replace("text-success", "text-white");
                document.getElementById("CardAEFiscalizadora_r").innerHTML = -(document.closecash_store.CardAmtSistema.value);
            }
            /////////////////////////////////////////////////////////////////////////////////

            document.getElementById("CardClaveGerente_r").innerHTML = parseFloat(document.closecash_store.CardClaveGerente.value - document.closecash_store.CardClaveFiscalizadora.value).toFixed(2);
            document.getElementById("CardValeGerente_r").innerHTML = parseFloat(document.closecash_store.CardValeGerente.value - document.closecash_store.CardValeFiscalizadora.value).toFixed(2);
            document.getElementById("CardVisaGerente_r").innerHTML = parseFloat(document.closecash_store.CardVisaGerente.value - document.closecash_store.CardVisaFiscalizadora.value).toFixed(2);
            document.getElementById("CardMasterGerente_r").innerHTML = parseFloat(document.closecash_store.CardMasterGerente.value - document.closecash_store.CardMasterFiscalizadora.value).toFixed(2);
            document.getElementById("CardAEGerente_r").innerHTML = parseFloat(document.closecash_store.CardAEGerente.value - document.closecash_store.CardAEFiscalizadora.value).toFixed(2);

            document.getElementById("Otros_Gerente_t").innerHTML = -1 * (parseFloat(-
                (document.getElementById("yappyGerente_r").innerHTML) -
                (document.getElementById("otrosGerente_r").innerHTML) -
                (document.getElementById("valespagodaGerente_r").innerHTML) -
                (document.getElementById("CheckAmtGerente_r").innerHTML) -
                (document.getElementById("LotoAmtGerente_r").innerHTML) -
                (document.getElementById("CashAmtGerente_r").innerHTML) -
                (document.getElementById("CoinRollGerente_r").innerHTML) -
                (document.getElementById("InvoiceAmtGerente_r").innerHTML) -
                (document.getElementById("VoucherAmtGerente_r").innerHTML) -
                (document.getElementById("GrantAmtGerente_r").innerHTML) -
                (document.getElementById("CardClaveGerente_r").innerHTML) -
                (document.getElementById("CardValeGerente_r").innerHTML) -
                (document.getElementById("CardVisaGerente_r").innerHTML) -
                (document.getElementById("CardMasterGerente_r").innerHTML) -
                (document.getElementById("CardAEGerente_r").innerHTML) -
                (document.getElementById("valeAmtGerente_r").innerHTML)
            ).toFixed(2));

            document.getElementById("Otros_Gerente_total").innerHTML = parseFloat(-1 * (document.getElementById("Otros_Gerente_t").innerHTML - document.getElementById("Otros_Fiscalizadora_t").innerHTML)).toFixed(2);
            document.getElementById("Monto_Gerente_t").innerHTML = parseFloat(parseFloat(document.getElementById("Gerente_t").innerHTML) + parseFloat(document.getElementById("Otros_Gerente_t").innerHTML)).toFixed(2);
            const cambioOtros_Gerente_t = document.getElementById("Otros_Gerente_t");
            const cambioMonto_Gerente_t = document.getElementById("Monto_Gerente_t");
            
            if (document.getElementById("Otros_Gerente_t").innerHTML < document.getElementById("Otros_Fiscalizadora_t").innerHTML) {
                cambioOtros_Gerente_t.classList.replace("text-success", "text-danger");
            } else {
                cambioOtros_Gerente_t.classList.replace("text-success", "text-success");
                cambioOtros_Gerente_t.classList.replace("text-danger", "text-success");
            }

            if (document.getElementById("Monto_Gerente_t").innerHTML < document.getElementById("Monto_Fiscalizadora_t").innerHTML) {
                cambioMonto_Gerente_t.classList.replace("text-success", "text-danger");
            } else {
                cambioMonto_Gerente_t.classList.replace("text-success", "text-success");
                cambioMonto_Gerente_t.classList.replace("text-danger", "text-success");
            }


        } catch (e) {
            document.getElementById("yappyGerente_r").innerHTML = parseFloat(document.closecash_store.yappyGerente.value - document.closecash_store.yappyFiscalizadora.value).toFixed(2);
            document.getElementById("otrosGerente_r").innerHTML = parseFloat(document.closecash_store.otrosGerente.value - document.closecash_store.otrosFiscalizadora.value).toFixed(2);
            document.getElementById("valespagodaGerente_r").innerHTML = parseFloat(document.closecash_store.valespagodaGerente.value - document.closecash_store.valespagodaFiscalizadora.value).toFixed(2);
            document.getElementById("CheckAmtGerente_r").innerHTML = parseFloat(document.closecash_store.CheckAmtGerente.value - document.closecash_store.CheckAmtFiscalizadora.value).toFixed(2);
            document.getElementById("LotoAmtGerente_r").innerHTML = parseFloat(document.closecash_store.LotoAmtGerente.value - document.closecash_store.LotoAmtFiscalizadora.value).toFixed(2);
            document.getElementById("CashAmtGerente_r").innerHTML = parseFloat(document.closecash_store.CashAmtGerente.value - document.closecash_store.CashAmtFiscalizadora.value).toFixed(2);
            document.getElementById("CoinRollGerente_r").innerHTML = parseFloat(document.closecash_store.CoinRollGerente.value - document.closecash_store.CoinRollFiscalizadora.value).toFixed(2);
            document.getElementById("InvoiceAmtGerente_r").innerHTML = parseFloat(document.closecash_store.InvoiceAmtGerente.value - document.closecash_store.InvoiceAmtFiscalizadora.value).toFixed(2);
            document.getElementById("InvoiceAmtPropiasGerente_r").innerHTML = parseFloat(document.closecash_store.InvoiceAmtPropiasGerente.value - document.closecash_store.InvoiceAmtFiscalizadora.value).toFixed(2);
            document.getElementById("VoucherAmtGerente_r").innerHTML = parseFloat(document.closecash_store.VoucherAmtGerente.value - document.closecash_store.VoucherAmtFiscalizadora.value).toFixed(2);
            document.getElementById("GrantAmtGerente_r").innerHTML = parseFloat(document.closecash_store.GrantAmtGerente.value - document.closecash_store.GrantAmtFiscalizadora.value).toFixed(2);
            document.getElementById("valeAmtGerente_r").innerHTML = parseFloat(document.closecash_store.valeAmtGerente.value - document.closecash_store.valeAmtFiscalizadora.value).toFixed(2);

            let yappyGerente_NaN = 0;
            let otrosGerente_NaN = 0;
            let valespagodaGerente_NaN = 0;
            let CheckAmtGerente_NaN = 0;
            let LotoAmtGerente_NaN = 0;
            let valeAmtGerente_NaN = 0;
            let CashAmtGerente_NaN = 0;
            let CoinRollGerente_NaN = 0;
            let InvoiceAmtGerente_NaN = 0;
            let VoucherAmtGerente_NaN = 0;
            let InvoiceAmtPropiasGerente_NaN = 0;
            let GrantAmtGerente_NaN = 0;
            let CardClaveGerente_NaN = 0;
            let CardValeGerente_NaN = 0;
            let CardVisaGerente_NaN = 0;
            let CardMasterGerente_NaN = 0;
            let CardAEGerente_NaN = 0;
            let CardBACGerente_NaN = 0;

            if (isNaN(parseFloat(document.closecash_store.yappyGerente.value))) {
                yappyGerente_NaN = 0;
            } else {
                yappyGerente_NaN = parseFloat(document.closecash_store.yappyGerente.value).toFixed(2);;
            }
            if (isNaN(parseFloat(document.closecash_store.otrosGerente.value))) {
                otrosGerente_NaN = 0;
            } else {
                otrosGerente_NaN = parseFloat(document.closecash_store.otrosGerente.value).toFixed(2);;
            }
            if (isNaN(parseFloat(document.closecash_store.valespagodaGerente.value))) {
                valespagodaGerente_NaN = 0;
            } else {
                valespagodaGerente_NaN = parseFloat(document.closecash_store.valespagodaGerente.value).toFixed(2);;
            }
            if (isNaN(parseFloat(document.closecash_store.CheckAmtGerente.value))) {
                CheckAmtGerente_NaN = 0;
            } else {
                CheckAmtGerente_NaN = parseFloat(document.closecash_store.CheckAmtGerente.value).toFixed(2);;
            }
            if (isNaN(parseFloat(document.closecash_store.LotoAmtGerente.value))) {
                LotoAmtGerente_NaN = 0;
            } else {
                LotoAmtGerente_NaN = parseFloat(document.closecash_store.LotoAmtGerente.value).toFixed(2);
            }
            if (isNaN(parseFloat(document.closecash_store.valeAmtGerente.value))) {
                valeAmtGerente_NaN = 0;
            } else {
                valeAmtGerente_NaN = parseFloat(document.closecash_store.valeAmtGerente.value).toFixed(2);
            }
            if (isNaN(parseFloat(document.closecash_store.CashAmtGerente.value))) {
                CashAmtGerente_NaN = 0;
            } else {
                CashAmtGerente_NaN = parseFloat(document.closecash_store.CashAmtGerente.value).toFixed(2);
            }
            if (isNaN(parseFloat(document.closecash_store.CoinRollGerente.value))) {
                CoinRollGerente_NaN = 0;
            } else {
                CoinRollGerente_NaN = parseFloat(document.closecash_store.CoinRollGerente.value).toFixed(2);
            }

            if (isNaN(parseFloat(document.closecash_store.InvoiceAmtGerente.value))) {
                InvoiceAmtGerente_NaN = 0;
            } else {
                InvoiceAmtGerente_NaN = parseFloat(document.closecash_store.InvoiceAmtGerente.value).toFixed(2);
            }

            if (isNaN(parseFloat(document.closecash_store.VoucherAmtGerente.value))) {
                VoucherAmtGerente_NaN = 0;
            } else {
                VoucherAmtGerente_NaN = parseFloat(document.closecash_store.VoucherAmtGerente.value).toFixed(2);
            }
            if (isNaN(parseFloat(document.closecash_store.InvoiceAmtPropiasGerente.value))) {
                InvoiceAmtPropiasGerente_NaN = 0;
            } else {
                InvoiceAmtPropiasGerente_NaN = parseFloat(document.closecash_store.InvoiceAmtPropiasGerente.value).toFixed(2);
            }
            if (isNaN(parseFloat(document.closecash_store.GrantAmtGerente.value))) {
                GrantAmtGerente_NaN = 0;
            } else {
                GrantAmtGerente_NaN = parseFloat(document.closecash_store.GrantAmtGerente.value).toFixed(2);
            }
            ///clave
            if (isNaN(parseFloat(document.closecash_store.CardClaveGerente.value))) {
                CardClaveGerente_NaN = 0;
            } else {
                CardClaveGerente_NaN = parseFloat(document.closecash_store.CardClaveGerente.value).toFixed(2);
            }
            ///
            if (isNaN(parseFloat(document.closecash_store.CardValeGerente.value))) {
                CardValeGerente_NaN = 0;
            } else {
                CardValeGerente_NaN = parseFloat(document.closecash_store.CardValeGerente.value).toFixed(2);
            }

            if (isNaN(parseFloat(document.closecash_store.CardVisaGerente.value))) {
                CardVisaGerente_NaN = 0;
            } else {
                CardVisaGerente_NaN = parseFloat(document.closecash_store.CardVisaGerente.value).toFixed(2);
            }

            if (isNaN(parseFloat(document.closecash_store.CardMasterGerente.value))) {
                CardMasterGerente_NaN = 0;
            } else {
                CardMasterGerente_NaN = parseFloat(document.closecash_store.CardMasterGerente.value).toFixed(2);
            }
            if (isNaN(parseFloat(document.closecash_store.CardAEGerente.value))) {
                CardAEGerente_NaN = 0;
            } else {
                CardAEGerente_NaN = parseFloat(document.closecash_store.CardAEGerente.value).toFixed(2);
            }
            if (isNaN(parseFloat(document.closecash_store.CardBACGerente.value))) {
                CardBACGerente_NaN = 0;
            } else {
                CardBACGerente_NaN = parseFloat(document.closecash_store.CardBACGerente.value).toFixed(2);
            }
            document.getElementById("yappyGerente_t").innerHTML = yappyGerente_NaN;
            document.getElementById("otrosGerente_t").innerHTML = otrosGerente_NaN;
            document.getElementById("valespagodaGerente_t").innerHTML = valespagodaGerente_NaN;
            document.getElementById("CheckAmtGerente_t").innerHTML = CheckAmtGerente_NaN;
            document.getElementById("LotoAmtGerente_t").innerHTML = LotoAmtGerente_NaN;
            document.getElementById("valeAmtGerente_t").innerHTML = valeAmtGerente_NaN;
            document.getElementById("CashAmtGerente_t").innerHTML = CashAmtGerente_NaN;
            document.getElementById("CoinRollGerente_t").innerHTML = CoinRollGerente_NaN;
            document.getElementById("InvoiceAmtGerente_t").innerHTML = InvoiceAmtGerente_NaN;
            document.getElementById("VoucherAmtGerente_t").innerHTML = VoucherAmtGerente_NaN;
            document.getElementById("InvoiceAmtPropiasGerente_t").innerHTML = InvoiceAmtPropiasGerente_NaN;
            document.getElementById("GrantAmtGerente_t").innerHTML = GrantAmtGerente_NaN;
            document.getElementById("CardClaveGerente_t").innerHTML = CardClaveGerente_NaN;
            document.getElementById("CardValeGerente_t").innerHTML = CardValeGerente_NaN;
            document.getElementById("CardVisaGerente_t").innerHTML = CardVisaGerente_NaN;
            document.getElementById("CardMasterGerente_t").innerHTML = CardMasterGerente_NaN;
            document.getElementById("CardAEGerente_t").innerHTML = CardAEGerente_NaN;
            document.getElementById("CardBACGerente_t").innerHTML = CardBACGerente_NaN;

        }

        document.getElementById("Otros_Fiscalizadora_t").innerHTML = -1 * (parseFloat(-
            (document.getElementById("yappyFiscalizadora_r").innerHTML) -
            (document.getElementById("otrosFiscalizadora_r").innerHTML) -
            (document.getElementById("valespagodaFiscalizadora_r").innerHTML) -
            (document.getElementById("CheckAmtFiscalizadora_r").innerHTML) -
            (document.getElementById("LotoAmtFiscalizadora_r").innerHTML) -
            (document.getElementById("CashAmtFiscalizadora_r").innerHTML) -
            (document.getElementById("CoinRollFiscalizadora_r").innerHTML) -
            (document.getElementById("InvoiceAmtFiscalizadora_r").innerHTML) -
            (document.getElementById("VoucherAmtFiscalizadora_r").innerHTML) -
            (document.getElementById("GrantAmtFiscalizadora_r").innerHTML) -
            (document.getElementById("CardClaveFiscalizadora_r").innerHTML) -
            (document.getElementById("valeAmtFiscalizadora_r").innerHTML) -
            (document.getElementById("Otros").innerHTML)
        ).toFixed(2));
        document.getElementById("Monto_Fiscalizadora_t").innerHTML = parseFloat(parseFloat(document.getElementById("Fiscalizadora_t").innerHTML) + parseFloat(document.getElementById("Otros_Fiscalizadora_t").innerHTML)).toFixed(2);
        document.getElementById("Monto_contado_Fiscalizadora").innerHTML = parseFloat(document.getElementById("Monto_Fiscalizadora_t").innerHTML - document.getElementById("InicioCaja").innerHTML).toFixed(2);

        document.getElementById("Otros_Gerente_t").innerHTML = parseFloat(
            parseFloat((document.getElementById("yappyGerente_t").innerHTML)) +
            parseFloat((document.getElementById("otrosGerente_t").innerHTML)) +
            parseFloat((document.getElementById("valespagodaGerente_t").innerHTML)) +
            parseFloat((document.getElementById("CheckAmtGerente_t").innerHTML)) +
            parseFloat((document.getElementById("LotoAmtGerente_t").innerHTML)) +
            parseFloat((document.getElementById("valeAmtGerente_t").innerHTML)) +
            parseFloat((document.getElementById("CashAmtGerente_t").innerHTML)) +
            parseFloat((document.getElementById("CoinRollGerente_t").innerHTML)) +
            parseFloat((document.getElementById("InvoiceAmtGerente_t").innerHTML)) +
            parseFloat((document.getElementById("VoucherAmtGerente_t").innerHTML)) +
            parseFloat((document.getElementById("InvoiceAmtPropiasGerente_t").innerHTML)) +
            parseFloat((document.getElementById("GrantAmtGerente_t").innerHTML)) +
            parseFloat((document.getElementById("CardClaveGerente_t").innerHTML)) +
            parseFloat((document.getElementById("CardValeGerente_t").innerHTML)) +
            parseFloat((document.getElementById("CardVisaGerente_t").innerHTML)) +
            parseFloat((document.getElementById("CardMasterGerente_t").innerHTML)) +
            parseFloat((document.getElementById("CardAEGerente_t").innerHTML)) +
            parseFloat((document.getElementById("CardBACGerente_t").innerHTML))).toFixed(2);;
        document.getElementById("Monto_Gerente_t").innerHTML = parseFloat(parseFloat(document.getElementById("Gerente_t").innerHTML) + parseFloat(document.getElementById("Otros_Gerente_t").innerHTML)).toFixed(2);
        document.getElementById("Monto_contado_Gerente").innerHTML = parseFloat(document.getElementById("Monto_Gerente_t").innerHTML - document.getElementById("InicioCaja").innerHTML).toFixed(2);
    }

    function colores() {
        const cambio1 = document.getElementById("x_oneamtFiscalizadora_r");
        const cambio5 = document.getElementById("x_fiveamtFiscalizadora_r");
        const cambio10 = document.getElementById("x_tenamtFiscalizadora_r");
        const cambio20 = document.getElementById("x_twentyamtFiscalizadora_r");
        const cambio50 = document.getElementById("x_fiftyamtFiscalizadora_r");
        const cambio100 = document.getElementById("x_hundredamtFiscalizadora_r");
        const cambiototalfis = document.getElementById("Fiscalizadora_t");
        if (document.getElementById("x_oneamtFiscalizadora_r").innerHTML <= -0.01) {
            cambio1.classList.replace("text-success", "text-danger");
        } else {
            cambio1.classList.replace("text-success", "text-success");
            cambio1.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("x_fiveamtFiscalizadora_r").innerHTML <= -0.01) {
            cambio5.classList.replace("text-success", "text-danger");
        } else {
            cambio5.classList.replace("text-success", "text-success");
            cambio5.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("x_tenamtFiscalizadora_r").innerHTML <= -0.01) {
            cambio10.classList.replace("text-success", "text-danger");
        } else {
            cambio10.classList.replace("text-success", "text-success");
            cambio10.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("x_twentyamtFiscalizadora_r").innerHTML <= -0.01) {
            cambio20.classList.replace("text-success", "text-danger");
        } else {
            cambio20.classList.replace("text-success", "text-success");
            cambio20.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("x_fiftyamtFiscalizadora_r").innerHTML <= -0.01) {
            cambio50.classList.replace("text-success", "text-danger");
        } else {
            cambio50.classList.replace("text-success", "text-success");
            cambio50.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("x_hundredamtFiscalizadora_r").innerHTML <= -0.01) {
            cambio100.classList.replace("text-success", "text-danger");
        } else {
            cambio100.classList.replace("text-success", "text-success");
            cambio100.classList.replace("text-danger", "text-success");
        }
        if (parseFloat(document.getElementById("Fiscalizadora_t").innerHTML) < parseFloat(document.getElementById("Montosistema_t").innerHTML)) {
            cambiototalfis.classList.replace("text-success", "text-danger");
        } else {
            cambiototalfis.classList.replace("text-success", "text-success");
            cambiototalfis.classList.replace("text-danger", "text-success");
        }

        const cambio1g = document.getElementById("x_oneamtGerente_r");
        const cambio5g = document.getElementById("x_fiveamtGerente_r");
        const cambio10g = document.getElementById("x_tenamtGerente_r");
        const cambio20g = document.getElementById("x_twentyamtGerente_r");
        const cambio50g = document.getElementById("x_fiftyamtGerente_r");
        const cambio100g = document.getElementById("x_hundredamtGerente_r");
        const cambiototalger = document.getElementById("Gerente_t");
        if (document.getElementById("x_oneamtGerente_r").innerHTML <= -0.01) {
            cambio1g.classList.replace("text-success", "text-danger");
        } else {
            cambio1g.classList.replace("text-success", "text-success");
            cambio1g.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("x_fiveamtGerente_r").innerHTML <= -0.01) {
            cambio5g.classList.replace("text-success", "text-danger");
        } else {
            cambio5g.classList.replace("text-success", "text-success");
            cambio5g.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("x_tenamtGerente_r").innerHTML <= -0.01) {
            cambio10g.classList.replace("text-success", "text-danger");
        } else {
            cambio10g.classList.replace("text-success", "text-success");
            cambio10g.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("x_twentyamtGerente_r").innerHTML <= -0.01) {
            cambio20g.classList.replace("text-success", "text-danger");
        } else {
            cambio20g.classList.replace("text-success", "text-success");
            cambio20g.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("x_fiftyamtGerente_r").innerHTML <= -0.01) {
            cambio50g.classList.replace("text-success", "text-danger");
        } else {
            cambio50g.classList.replace("text-success", "text-success");
            cambio50g.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("x_hundredamtGerente_r").innerHTML <= -0.01) {
            cambio100g.classList.replace("text-success", "text-danger");
        } else {
            cambio100g.classList.replace("text-success", "text-success");
            cambio100g.classList.replace("text-danger", "text-success");
        }
        if (parseFloat(document.getElementById("Gerente_t").innerHTML) < parseFloat(document.getElementById("Fiscalizadora_t").innerHTML)) {
            cambiototalger.classList.replace("text-success", "text-danger");
        } else {
            cambiototalger.classList.replace("text-success", "text-success");
            cambiototalger.classList.replace("text-danger", "text-success");
        }
        const cambioyappyFiscalizadora = document.getElementById("yappyFiscalizadora_r");
        const cambiootrosFiscalizadora = document.getElementById("otrosFiscalizadora_r");
        const cambiovalespagodaFiscalizadora = document.getElementById("valespagodaFiscalizadora_r");
        const cambioCheckAmtFiscalizadora = document.getElementById("CheckAmtFiscalizadora_r");
        const cambioLotoAmtFiscalizadora = document.getElementById("LotoAmtFiscalizadora_r");
        const cambiovaleAmtFiscalizadora = document.getElementById("valeAmtFiscalizadora_r");
        const cambioCardClaveFiscalizadora = document.getElementById("CardClaveFiscalizadora_r");
        const cambioCardValeFiscalizadora = document.getElementById("CardValeFiscalizadora_r");
        const cambioCardVisaFiscalizadora = document.getElementById("CardVisaFiscalizadora_r");
        const cambioCardMasterFiscalizadora = document.getElementById("CardMasterFiscalizadora_r");
        const cambioCardAEFiscalizadora = document.getElementById("CardAEFiscalizadora_r");
        const cambioCardBACFiscalizadora = document.getElementById("CardBACFiscalizadora_r");
        const cambioCashAmtFiscalizadora = document.getElementById("CashAmtFiscalizadora_r");
        const cambioCoinRollFiscalizadora = document.getElementById("CoinRollFiscalizadora_r");
        const cambioInvoiceAmtFiscalizadora = document.getElementById("InvoiceAmtFiscalizadora_r");
        const cambioInvoiceAmtPropiasFiscalizadora = document.getElementById("InvoiceAmtPropiasFiscalizadora_r");
        const cambioVoucherAmtFiscalizadora = document.getElementById("VoucherAmtFiscalizadora_r");
        const cambioGrantAmtFiscalizadora = document.getElementById("GrantAmtFiscalizadora_r");
        const cambioOtros_Fiscalizadora_t = document.getElementById("Otros_Fiscalizadora_t");
        const cambioMonto_contado_Fiscalizadora_t = document.getElementById("Monto_contado_Fiscalizadora");
        const cambioMonto_Fiscalizadora_t = document.getElementById("Monto_Fiscalizadora_t");

        if (document.getElementById("yappyFiscalizadora_r").innerHTML <= -0.01) {
            cambioyappyFiscalizadora.classList.replace("text-success", "text-danger");
        } else {
            cambioyappyFiscalizadora.classList.replace("text-success", "text-success");
            cambioyappyFiscalizadora.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("otrosFiscalizadora_r").innerHTML <= -0.01) {
            cambiootrosFiscalizadora.classList.replace("text-success", "text-danger");
        } else {
            cambiootrosFiscalizadora.classList.replace("text-success", "text-success");
            cambiootrosFiscalizadora.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("valespagodaFiscalizadora_r").innerHTML <= -0.01) {
            cambiovalespagodaFiscalizadora.classList.replace("text-success", "text-danger");
        } else {
            cambiovalespagodaFiscalizadora.classList.replace("text-success", "text-success");
            cambiovalespagodaFiscalizadora.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("CheckAmtFiscalizadora_r").innerHTML <= -0.01) {
            cambioCheckAmtFiscalizadora.classList.replace("text-success", "text-danger");
        } else {
            cambioCheckAmtFiscalizadora.classList.replace("text-success", "text-success");
            cambioCheckAmtFiscalizadora.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("LotoAmtFiscalizadora_r").innerHTML <= -0.01) {
            cambioLotoAmtFiscalizadora.classList.replace("text-success", "text-danger");
        } else {
            cambioLotoAmtFiscalizadora.classList.replace("text-success", "text-success");
            cambioLotoAmtFiscalizadora.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("CardClaveFiscalizadora_r").innerHTML <= -0.01) {
            cambioCardClaveFiscalizadora.classList.replace("text-success", "text-danger");
        } else {
            cambioCardClaveFiscalizadora.classList.replace("text-success", "text-success");
            cambioCardClaveFiscalizadora.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("CardValeFiscalizadora_r").innerHTML <= -0.01) {
            cambioCardValeFiscalizadora.classList.replace("text-success", "text-danger");
        } else {
            cambioCardValeFiscalizadora.classList.replace("text-success", "text-success");
            cambioCardValeFiscalizadora.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("CardVisaFiscalizadora_r").innerHTML <= -0.01) {
            cambioCardVisaFiscalizadora.classList.replace("text-white", "text-danger");
            cambioCardVisaFiscalizadora.classList.replace("text-success", "text-danger");
        } else {
            cambioCardVisaFiscalizadora.classList.replace("text-success", "text-success");
            cambioCardVisaFiscalizadora.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("CardMasterFiscalizadora_r").innerHTML <= -0.01) {
            cambioCardMasterFiscalizadora.classList.replace("text-success", "text-danger");
        } else {
            cambioCardMasterFiscalizadora.classList.replace("text-success", "text-success");
            cambioCardMasterFiscalizadora.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("CardAEFiscalizadora_r").innerHTML <= -0.01) {
            cambioCardAEFiscalizadora.classList.replace("text-success", "text-danger");
        } else {
            cambioCardAEFiscalizadora.classList.replace("text-success", "text-success");
            cambioCardAEFiscalizadora.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("CashAmtFiscalizadora_r").innerHTML <= -0.01) {
            cambioCashAmtFiscalizadora.classList.replace("text-success", "text-danger");
        } else {
            cambioCashAmtFiscalizadora.classList.replace("text-success", "text-success");
            cambioCashAmtFiscalizadora.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("CoinRollFiscalizadora_r").innerHTML <= -0.01) {
            cambioCoinRollFiscalizadora.classList.replace("text-success", "text-danger");
        } else {
            cambioCoinRollFiscalizadora.classList.replace("text-success", "text-success");
            cambioCoinRollFiscalizadora.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("InvoiceAmtFiscalizadora_r").innerHTML <= -0.01) {
            cambioInvoiceAmtFiscalizadora.classList.replace("text-success", "text-danger");
        } else {
            cambioInvoiceAmtFiscalizadora.classList.replace("text-success", "text-success");
            cambioInvoiceAmtFiscalizadora.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("VoucherAmtFiscalizadora_r").innerHTML <= -0.01) {
            cambioVoucherAmtFiscalizadora.classList.replace("text-success", "text-danger");
        } else {
            cambioVoucherAmtFiscalizadora.classList.replace("text-success", "text-success");
            cambioVoucherAmtFiscalizadora.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("GrantAmtFiscalizadora_r").innerHTML <= -0.01) {
            cambioGrantAmtFiscalizadora.classList.replace("text-success", "text-danger");
        } else {
            cambioGrantAmtFiscalizadora.classList.replace("text-success", "text-success");
            cambioGrantAmtFiscalizadora.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("valeAmtFiscalizadora_r").innerHTML <= -0.01) {
            cambiovaleAmtFiscalizadora.classList.replace("text-success", "text-danger");
        } else {
            cambiovaleAmtFiscalizadora.classList.replace("text-success", "text-success");
            cambiovaleAmtFiscalizadora.classList.replace("text-danger", "text-success");
        }
        if (parseFloat(document.getElementById("Otros_Fiscalizadora_t").innerHTML) < parseFloat(document.getElementById("Otros").innerHTML)) {
            cambioOtros_Fiscalizadora_t.classList.replace("text-white", "text-danger");
            cambioOtros_Fiscalizadora_t.classList.replace("text-success", "text-danger");
        } else {
            cambioOtros_Fiscalizadora_t.classList.replace("text-success", "text-success");
            cambioOtros_Fiscalizadora_t.classList.replace("text-danger", "text-success");
        }
        if (parseFloat(document.getElementById("Monto_contado_Fiscalizadora").innerHTML) < parseFloat(document.getElementById("Monto_contado_Sistema").innerHTML)) {
            cambioMonto_contado_Fiscalizadora_t.classList.replace("text-white", "text-danger");
            cambioMonto_contado_Fiscalizadora_t.classList.replace("text-success", "text-danger");
        } else {
            cambioMonto_contado_Fiscalizadora_t.classList.replace("text-success", "text-success");
            cambioMonto_contado_Fiscalizadora_t.classList.replace("text-danger", "text-success");
        }
        if (parseFloat(document.getElementById("Monto_Fiscalizadora_t").innerHTML) < parseFloat(document.getElementById("Monto_Subtotal_Sistema").innerHTML)) {
            cambioMonto_Fiscalizadora_t.classList.replace("text-success", "text-danger");
        } else {
            cambioMonto_Fiscalizadora_t.classList.replace("text-success", "text-success");
            cambioMonto_Fiscalizadora_t.classList.replace("text-danger", "text-success");
        }
        const cambioyappyGerente = document.getElementById("yappyGerente_r");
        const cambiootrosGerente = document.getElementById("otrosGerente_r");
        const cambiovalespagodaGerente = document.getElementById("valespagodaGerente_r");
        const cambioCheckAmtGerente = document.getElementById("CheckAmtGerente_r");
        const cambioLotoAmtGerente = document.getElementById("LotoAmtGerente_r");
        const cambiovaleAmtGerente = document.getElementById("valeAmtGerente_r");
        const cambioCardClaveGerente = document.getElementById("CardClaveGerente_r");
        const cambioCardValeGerente = document.getElementById("CardValeGerente_r");
        const cambioCardVisaGerente = document.getElementById("CardVisaGerente_r");
        const cambioCardMasterGerente = document.getElementById("CardMasterGerente_r");
        const cambioCardAEGerente = document.getElementById("CardAEGerente_r");
        const cambioCashAmtGerente = document.getElementById("CashAmtGerente_r");
        const cambioCoinRollGerente = document.getElementById("CoinRollGerente_r");
        const cambioInvoiceAmtGerente = document.getElementById("InvoiceAmtGerente_r");
        const cambioInvoiceAmtPropiasGerente = document.getElementById("InvoiceAmtPropiasGerente_r");
        const cambioVoucherAmtGerente = document.getElementById("VoucherAmtGerente_r");
        const cambioGrantAmtGerente = document.getElementById("GrantAmtGerente_r");
        const cambioMonto_contado_Gerente = document.getElementById("Monto_contado_Gerente");
        const cambioMonto_Gerente_t = document.getElementById("Monto_Gerente_t");


        if (document.getElementById("yappyGerente_r").innerHTML <= -0.01) {
            cambioyappyGerente.classList.replace("text-success", "text-danger");
        } else {
            cambioyappyGerente.classList.replace("text-success", "text-success");
            cambioyappyGerente.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("otrosGerente_r").innerHTML <= -0.01) {
            cambiootrosGerente.classList.replace("text-success", "text-danger");
        } else {
            cambiootrosGerente.classList.replace("text-success", "text-success");
            cambiootrosGerente.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("valespagodaGerente_r").innerHTML <= -0.01) {
            cambiovalespagodaGerente.classList.replace("text-success", "text-danger");
        } else {
            cambiovalespagodaGerente.classList.replace("text-success", "text-success");
            cambiovalespagodaGerente.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("CheckAmtGerente_r").innerHTML <= -0.01) {
            cambioCheckAmtGerente.classList.replace("text-success", "text-danger");
        } else {
            cambioCheckAmtGerente.classList.replace("text-success", "text-success");
            cambioCheckAmtGerente.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("LotoAmtGerente_r").innerHTML <= -0.01) {
            cambioLotoAmtGerente.classList.replace("text-success", "text-danger");
        } else {
            cambioLotoAmtGerente.classList.replace("text-success", "text-success");
            cambioLotoAmtGerente.classList.replace("text-danger", "text-success");
        }
        ///tarjetas
        if (document.getElementById("CardClaveGerente_r").innerHTML <= -0.01) {
            cambioCardClaveGerente.classList.replace("text-success", "text-danger");
        } else {
            cambioCardClaveGerente.classList.replace("text-success", "text-success");
            cambioCardClaveGerente.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("CardValeGerente_r").innerHTML <= -0.01) {
            cambioCardValeGerente.classList.replace("text-success", "text-danger");
        } else {
            cambioCardValeGerente.classList.replace("text-success", "text-success");
            cambioCardValeGerente.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("CardVisaGerente_r").innerHTML <= -0.01) {
            cambioCardVisaGerente.classList.replace("text-success", "text-danger");
        } else {
            cambioCardVisaGerente.classList.replace("text-success", "text-success");
            cambioCardVisaGerente.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("CardMasterGerente_r").innerHTML <= -0.01) {
            cambioCardMasterGerente.classList.replace("text-success", "text-danger");
        } else {
            cambioCardMasterGerente.classList.replace("text-success", "text-success");
            cambioCardMasterGerente.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("CardAEGerente_r").innerHTML <= -0.01) {
            cambioCardAEGerente.classList.replace("text-success", "text-danger");
        } else {
            cambioCardAEGerente.classList.replace("text-success", "text-success");
            cambioCardAEGerente.classList.replace("text-danger", "text-success");
        }
        ///
        if (document.getElementById("CashAmtGerente_r").innerHTML <= -0.01) {
            cambioCashAmtGerente.classList.replace("text-success", "text-danger");
        } else {
            cambioCashAmtGerente.classList.replace("text-success", "text-success");
            cambioCashAmtGerente.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("CoinRollGerente_r").innerHTML <= -0.01) {
            cambioCoinRollGerente.classList.replace("text-success", "text-danger");
        } else {
            cambioCoinRollGerente.classList.replace("text-success", "text-success");
            cambioCoinRollGerente.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("InvoiceAmtGerente_r").innerHTML <= -0.01) {
            cambioInvoiceAmtGerente.classList.replace("text-success", "text-danger");
        } else {
            cambioInvoiceAmtGerente.classList.replace("text-success", "text-success");
            cambioInvoiceAmtGerente.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("VoucherAmtGerente_r").innerHTML <= -0.01) {
            cambioVoucherAmtGerente.classList.replace("text-success", "text-danger");
        } else {
            cambioVoucherAmtGerente.classList.replace("text-success", "text-success");
            cambioVoucherAmtGerente.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("GrantAmtGerente_r").innerHTML <= -0.01) {
            cambioGrantAmtGerente.classList.replace("text-success", "text-danger");
        } else {
            cambioGrantAmtGerente.classList.replace("text-success", "text-success");
            cambioGrantAmtGerente.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("valeAmtGerente_r").innerHTML <= -0.01) {
            cambiovaleAmtGerente.classList.replace("text-success", "text-danger");
        } else {
            cambiovaleAmtGerente.classList.replace("text-success", "text-success");
            cambiovaleAmtGerente.classList.replace("text-danger", "text-success");
        }
        if (document.getElementById("InvoiceAmtPropiasGerente_r").innerHTML <= -0.01) {
            cambioInvoiceAmtPropiasGerente.classList.replace("text-success", "text-danger");
        } else {
            cambioInvoiceAmtPropiasGerente.classList.replace("text-success", "text-success");
            cambioInvoiceAmtPropiasGerente.classList.replace("text-danger", "text-success");
        }
        if (parseFloat(document.getElementById("Monto_contado_Gerente").innerHTML) < parseFloat(document.getElementById("Monto_contado_Fiscalizadora").innerHTML) ) {
            cambioMonto_contado_Gerente.classList.replace("text-success", "text-danger");
        } else {
            cambioMonto_contado_Gerente.classList.replace("text-success", "text-success");
            cambioMonto_contado_Gerente.classList.replace("text-danger", "text-success");
        }
        if (parseFloat(document.getElementById("Monto_Gerente_t").innerHTML) < parseFloat(document.getElementById("Monto_Fiscalizadora_t").innerHTML)) {
            cambioMonto_Gerente_t.classList.replace("text-success", "text-danger");
        } else {
            cambioMonto_Gerente_t.classList.replace("text-success", "text-success");
            cambioMonto_Gerente_t.classList.replace("text-danger", "text-success");
        }
    }

    function clon() {
        document.closecash_store.x_oneamtGerente.value = document.closecash_store.x_oneamtFiscalizadora.value;
        document.closecash_store.x_fiveamtGerente.value = document.closecash_store.x_fiveamtFiscalizadora.value;
        document.closecash_store.x_tenamtGerente.value = document.closecash_store.x_tenamtFiscalizadora.value;
        document.closecash_store.x_twentyamtGerente.value = document.closecash_store.x_twentyamtFiscalizadora.value;
        document.closecash_store.x_fiftyamtGerente.value = document.closecash_store.x_fiftyamtFiscalizadora.value;
        document.closecash_store.x_hundredamtGerente.value = document.closecash_store.x_hundredamtFiscalizadora.value;
        document.closecash_store.yappyGerente.value = document.closecash_store.yappyFiscalizadora.value;
        document.closecash_store.otrosGerente.value = document.closecash_store.otrosFiscalizadora.value;
        document.closecash_store.valespagodaGerente.value = document.closecash_store.valespagodaFiscalizadora.value;
        document.closecash_store.CheckAmtGerente.value = document.closecash_store.CheckAmtFiscalizadora.value;
        document.closecash_store.LotoAmtGerente.value = document.closecash_store.LotoAmtFiscalizadora.value;
        document.closecash_store.valeAmtGerente.value = document.closecash_store.valeAmtFiscalizadora.value;
        document.closecash_store.CardClaveGerente.value = document.closecash_store.CardClaveFiscalizadora.value;
        document.closecash_store.CardValeGerente.value = document.closecash_store.CardValeFiscalizadora.value;
        document.closecash_store.CardVisaGerente.value = document.closecash_store.CardVisaFiscalizadora.value;
        document.closecash_store.CardMasterGerente.value = document.closecash_store.CardMasterFiscalizadora.value;
        document.closecash_store.CardAEGerente.value = document.closecash_store.CardAEFiscalizadora.value;
        document.closecash_store.CardBACGerente.value = document.closecash_store.CardBACFiscalizadora.value;
        document.closecash_store.CashAmtGerente.value = document.closecash_store.CashAmtFiscalizadora.value;
        document.closecash_store.CoinRollGerente.value = document.closecash_store.CoinRollFiscalizadora.value;
        document.closecash_store.InvoiceAmtGerente.value = document.closecash_store.InvoiceAmtFiscalizadora.value;
        document.closecash_store.InvoiceAmtPropiasGerente.value = document.closecash_store.InvoiceAmtPropiasFiscalizadora.value;
        document.closecash_store.VoucherAmtGerente.value = document.closecash_store.VoucherAmtFiscalizadora.value;
        document.closecash_store.GrantAmtGerente.value = document.closecash_store.GrantAmtFiscalizadora.value;
    }

    function zero() {

    }
</script>