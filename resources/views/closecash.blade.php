@extends('layouts.app')

@section('content')
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
                        <option value="{{$org->id}}">{{$org->Name}}</option>
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
                            <input name="DateTrx" type="date" value={{ date("Y-m-d") }} class="form-control" placeholder="0.00">
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
                    <h6>Cantidad de cierres: {{ $data->gh_closecash_id_count }}</h6>
                </div>
            </div>
            <div class="col">
                <div class="card-body">
                    <h6>Inicio caja: {{ $data->BeginningBalance }}</h6>
                </div>
            </div>
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
                <h5 class="card-title">Monto sistema</h5>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>
                                <p class="card-text">Efectivo</p>
                            </th>
                            <th></th>
                            <th>
                                <h5 class="mb-0 fw-bold" id="Montosistema_t">{{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100 }}</h5>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>$1x</td>
                            <td> <input name="x_oneamtSistema" value="{{ $data->x_oneamt }}" type="number" style="width:100%;" readonly class="text-left" placeholder="0.00"></td>
                            <td>{{ $data->x_oneamt*1 }}</td>
                            <td>
                                <div class="col borde text-white">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$5x</td>
                            <td><input name="x_fiveamtSistema" value="{{ $data->x_fiveamt }}" type="number" style="width:100%;" readonly class="text-left" placeholder="0.00" ></td>
                            <td>{{ $data->x_fiveamt*5 }}</td>
                            <td>
                                <div class="col borde text-white">0.00</div>
                            </td>

                        </tr>
                        <tr>
                            <td>$10x</td>
                            <td><input name="x_tenamtSistema" value="{{ $data->x_tenamt }}" type="number" style="width:100%;" readonly class="text-left" placeholder="0.00" ></td>
                            <td>{{ $data->x_tenamt*10 }}</td>
                            <td>
                                <div class="col borde text-white">0.00</div>
                            </td>

                        </tr>
                        <tr>
                            <td>$20x</td>
                            <td><input name="x_twentyamtSistema" value="{{ $data->x_twentyamt }}" type="number" style="width:100%;" readonly class="text-left" placeholder="0.00" ></td>
                            <td>{{ $data->x_twentyamt*20 }}</td>
                            <td>
                                <div class="col borde text-white">0.00</div>
                            </td>

                        </tr>
                        <tr>
                            <td>$50x</td>
                            <td><input name="x_fiftyamtSistema" value="{{ $data->x_fiftyamt }}" type="number" style="width:100%;" readonly class="text-left" placeholder="0.00" ></td>
                            <td>{{ $data->x_fiftyamt*50 }}</td>
                            <td>
                                <div class="col borde text-white">0.00</div>
                            </td>

                        </tr>
                        <tr>
                            <td>$100x</td>
                            <td><input name="x_hundredamtSistema" value="{{ $data->x_hundredamt }}" type="number" style="width:100%;" readonly class="text-left" placeholder="0.00" ></td>
                            <td>{{ $data->x_hundredamt*100 }}</td>
                            <td>
                                <div class="col borde text-white">0.00</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Otros Sis</th>
                                <th>
                                    <h5 class="mb-0 fw-bold" id="Otros">{{ $data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</h5>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Yappy</td>
                                <td> <input name="yappySistema" value="{{ $data->yappy }}" type="number" step="0.01" readonly class="w-100 text-right" placeholder="0.00" ></td>

                            </tr>
                            <tr>
                                <td>Otros</td>
                                <td><input name="otrosSistema" value="{{ $data->otros }}" type="number" step="0.01" readonly class="w-100 text-right" placeholder="0.00" ></td>

                            </tr>
                            <tr>
                                <td>Vales Pagoda </td>
                                <td><input name="valespagodaSistema" value="{{ $data->valespagoda }}" type="number" step="0.01" readonly class="w-100 text-right" placeholder="0.00" ></td>

                            </tr>
                            <tr>
                                <td> Monto cheques</td>
                                <td> <input name="CheckAmtSistema" value="{{ $data->CheckAmt }}" type="number" step="0.01" readonly class="w-100 text-right" placeholder="0.00" >
                                </td>

                            </tr>
                            <tr>
                                <td> Loteria</td>
                                <td> <input name="LotoAmtSistema" value="{{ $data->LotoAmt }}" type="number" step="0.01" readonly class="w-100 text-right" placeholder="0.00" >
                                </td>

                            </tr>
                            <tr>
                                <td>Tarjetas </td>
                                <td> <input name="CardAmtSistema" value="{{ $data->CardAmt }}" type="number" step="0.01" readonly class="w-100 text-right" placeholder="0.00" >
                                </td>
                            </tr>
                            <tr>
                                <td>-<input type="hidden" step="0.01" readonly class="w-100 text-right" placeholder="0.00"></td>
                                <td>-<input type="hidden" step="0.01" readonly class="w-100 text-right" placeholder="0.00"></td>
                            </tr>
                            <tr>
                                <td>-<input type="hidden" step="0.01" readonly class="w-100 text-right" placeholder="0.00"></td>
                                <td>-<input type="hidden" step="0.01" readonly class="w-100 text-right" placeholder="0.00"></td>
                            </tr>
                            <tr>
                                <td>-<input type="hidden" step="0.01" readonly class="w-100 text-right" placeholder="0.00"></td>
                                <td>-<input type="hidden" step="0.01" readonly class="w-100 text-right" placeholder="0.00"></td>
                            </tr>

                            <tr>
                                <td>Sencillo </td>
                                <td><input name="CashAmtSistema" value="{{ $data->CashAmt }}" type="number" step="0.01" readonly class="w-100 text-right" placeholder="0.00" >
                                </td>

                            </tr>
                            <tr>
                                <td>Rollos </td>
                                <td> <input name="CoinRollSistema" value="{{ $data->CoinRoll }}" type="number" step="0.01" readonly class="w-100 text-right" placeholder="0.00" >
                                </td>

                            </tr>
                            <tr>
                                <td>Facturas </td>
                                <td> <input name="InvoiceAmtSistema" value="{{ $data->InvoiceAmt }}" type="number" step="0.01" readonly class="w-100 text-right" placeholder="0.00" >
                                </td>

                            </tr>
                            <tr>
                                <td>Vale digital </td>
                                <td> <input name="VoucherAmtSistema" value="{{ $data->VoucherAmt }}" type="number" step="0.01" readonly class="w-100 text-right" placeholder="0.00" >
                                </td>

                            </tr>
                            <tr>
                                <td>Beca Digital </td>
                                <td> <input name="GrantAmtSistema" value="{{ $data->GrantAmt }}" type="number" step="0.01" readonly class="w-100 text-right" placeholder="0.00" >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="card bg-light">
                        <div class="card-body p-1">
                            <div class="row m-0 p-0">
                                <div class="m-0 p-0 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Monto contado</h4>
                                </div>
                                <div class="text-right m-0 p-0 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0" id="Monto_contado_Sistema">{{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100+$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</h5>
                                </div>
                            </div>
                            <h6 class="mb-0 text-right">Subtotal &nbsp;&nbsp;&nbsp;= {{ $data->BeginningBalance+$data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100+$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</b></h6>
                            <h6 class="mb-0 text-right">Monto X &nbsp;&nbsp;&nbsp;= <b>{{ $data->XAmt }}</b></h6>
                            <h6 class="mb-0 text-right">Diferencia = <b>{{ $data->DifferenceAmt }}</b></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Fiscalizadora</h5>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>
                                <p class="card-text">Efectivo</p>
                            </th>
                            <th> </th>
                            <th>
                                <h5 class="mb-0 fw-bold text-success" id="Fiscalizadora_t">{{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100 }}</h5>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>$1x</td>
                            <td><input name="x_oneamtFiscalizadora" value="0.00" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal()" onkeyup="cal()" >
                                <input type="hidden" name="fis1" value="{{ $data->x_oneamt }}" onchange="cal()" onkeyup="cal()" />
                            </td>
                            <td>
                                <div class="col borde" id="x_oneamtFiscalizadora_t">{{ $data->x_oneamt*1 }}</div>
                            </td>
                            <td>
                                <div class="col borde text-success" id="x_oneamtFiscalizadora_r">0.00</div>
                            </td>

                        </tr>
                        <tr>
                            <td>$5x</td>
                            <td><input name="x_fiveamtFiscalizadora" value="0.00" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                                <input type="hidden" name="fis5" value="{{ $data->x_fiveamt}}" onchange="cal()" onkeyup="cal()" />
                            </td>
                            <td>
                                <div class="col borde" id="x_fiveamtFiscalizadora_t"> {{ $data->x_fiveamt*5}}</div>
                            </td>
                            <td>
                                <div class="col borde text-success" id="x_fiveamtFiscalizadora_r">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$10x</td>
                            <td><input name="x_tenamtFiscalizadora" value="0.00" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                                <input type="hidden" name="fis10" value="{{ $data->x_tenamt }}" onchange="cal()" onkeyup="cal()" />
                            </td>
                            <td>
                                <div class="col borde" id="x_tenamtFiscalizadora_t">{{ $data->x_tenamt*10 }}</div>
                            </td>
                            <td>
                                <div class="col borde text-success" id="x_tenamtFiscalizadora_r">0.00</div>
                            </td>

                        </tr>
                        <tr>
                            <td>$20x</td>
                            <td><input name="x_twentyamtFiscalizadora" value="0.00" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                                <input type="hidden" name="fis20" value="{{ $data->x_twentyamt }}" onchange="cal()" onkeyup="cal()" />
                            </td>
                            <td>
                                <div class="col borde" id="x_twentyamtFiscalizadora_t">{{ $data->x_twentyamt*20 }}</div>

                            <td>
                                <div class="col borde text-success" id="x_twentyamtFiscalizadora_r">0.00</div>
                            </td>
                            </td>

                        </tr>
                        <tr>
                            <td>$50x</td>
                            <td> <input name="x_fiftyamtFiscalizadora" value="0.00" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                                <input type="hidden" name="fis50" value="{{ $data->x_fiftyamt }}" onchange="cal()" onkeyup="cal()" />
                            </td>
                            <td>
                                <div class="col borde" id="x_fiftyamtFiscalizadora_t">{{ $data->x_fiftyamt*50 }} </div>
                            </td>
                            <td>
                                <div class="col borde text-success" id="x_fiftyamtFiscalizadora_r">0.00</div>
                            </td>

                        </tr>
                        <tr>
                            <td>$100x</td>
                            <td> <input name="x_hundredamtFiscalizadora" value="0.00" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                                <input type="hidden" name="fis100" value="{{ $data->x_hundredamt }}" onchange="cal()" onkeyup="cal()" />
                            </td>
                            <td>
                                <div class="col borde" id="x_hundredamtFiscalizadora_t"> {{ $data->x_hundredamt*100 }} </div>
                            </td>
                            <td>
                                <div class="col borde text-success" id="x_hundredamtFiscalizadora_r">0.00</p>
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
                            <th>Otros Fis</th>
                            <th>
                                <h5 class="mb-0 fw-bold text-success" id="Otros_Fiscalizadora_t">{{ $data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</h5>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Yappy</td>
                            <td><input name="yappyFiscalizadora" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td>
                                <div class="col borde text-success" id="yappyFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Otros</td>
                            <td><input name="otrosFiscalizadora" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></td>
                            <td>
                                <div class="col borde text-success" id="otrosFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Vales Pagoda </td>
                            <td><input name="valespagodaFiscalizadora" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></td>
                            <td>
                                <div class="col borde text-success" id="valespagodaFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td> Monto cheques</td>
                            <td> <input name="CheckAmtFiscalizadora" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></td>
                            <td>
                                <div class="col borde text-success" id="CheckAmtFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Loteria</td>
                            <td> <input name="LotoAmtFiscalizadora" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></td>
                            <td>
                                <div class="col borde text-success" id="LotoAmtFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Clave</td>
                            <td><input name="CardClaveFiscalizadora" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></td>
                            <td>
                                <div style="visibility: hidden;" class="col borde text-success" id="CardClaveFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Vale</td>
                            <td><input name="CardValeFiscalizadora" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></td>
                            <td>
                                <div style="visibility: hidden;" class="col borde text-success" id="CardValeFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Visa</td>
                            <td><input name="CardVisaFiscalizadora" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></td>
                            <td>
                                <div class="col borde text-success" id="CardVisaFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Master</td>
                            <td><input name="CardMasterFiscalizadora" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></td>
                            <td>
                                <div style="visibility: hidden;" class="col borde text-success" id="CardMasterFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>American</td>
                            <td><input name="CardAEFiscalizadora" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></td>
                            <td>
                                <div style="visibility: hidden;" class="col borde text-success" id="CardAEFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Sencillo</td>
                            <td><input name="CashAmtFiscalizadora" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></td>
                            <td>
                                <div class="col borde text-success" id="CashAmtFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Rollos </td>
                            <td><input name="CoinRollFiscalizadora" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"> </td>
                            <td>
                                <div class="col borde text-success" id="CoinRollFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Facturas </td>
                            <td><input name="InvoiceAmtFiscalizadora" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"> </td>
                            <td>
                                <div class="col borde text-success" id="InvoiceAmtFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Vale digital </td>
                            <td><input name="VoucherAmtFiscalizadora" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"> </td>
                            <td>
                                <div class="col borde text-success" id="VoucherAmtFiscalizadora_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Beca Digital </td>
                            <td><input name="GrantAmtFiscalizadora" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"> </td>
                            <td>
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
                            <h5 class="mb-0 fw-bold text-success" id="Monto_Fiscalizadora_t"> {{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100+$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</h5>
                        </div>
                    </div>
                    <h6 class="mb-0 text-right">Subtotal = {{ $data->BeginningBalance+$data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100+$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</b></h6>
                    <h6 class="mb-0 text-right">Monto X = <b>{{ $data->XAmt }}</b></h6>
                    <h6 class="mb-0 text-right">Diferencia = <b>{{ $data->DifferenceAmt }}</b></h6>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Total Panaderia</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h5 class="mb-0"> <input name="totalPanaderiaFiscalizadora" value="0" type="number" step="0.01" class="w-100 text-right" placeholder="0.00"> </h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Total Pagatodo</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h5 class="mb-0"> <input name="totalPagatodoFiscalizadora" value="0" type="number" step="0.01" class="w-100 text-right" placeholder="0.00"> </h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Total Super</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h5 class="mb-0"> <input name="totalsuperFiscalizadora" value="0" type="number" step="0.01" class="w-100 text-right" placeholder="0.00"> </h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Dinero de Taxi</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h5 class="mb-0"> <input name="dineroTaxiFiscalizadora" value="0" type="number" step="0.01" class="w-100 text-right" placeholder="0.00"> </h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Vuelto de mercado</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h5 class="mb-0"> <input name="vueltoMercadoFiscalizadora" value="0" type="number" step="0.01" class="w-100 text-right" placeholder="0.00"> </h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Comentarios</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h5 class="mb-0"> <textarea name="comentariosFiscalizadora" value="0" class="w-100 text-right" placeholder="Comentarios"></textarea></h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Gerente</h5>
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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>$1x</td>
                            <td>
                                <input name="x_oneamtGerente" value="0.00" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal()" onkeyup="cal()" />
                            </td>
                            <td>
                                <div class="col borde" id="x_oneamtGerente_t">{{ $data->x_oneamt*1 }}</div>
                            </td>
                            <td>
                                <div class="col borde text-success" id="x_oneamtGerente_r">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$5x</td>
                            <td> <input name="x_fiveamtGerente" value="0.00" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td>
                                <div class="col borde" id="x_fiveamtGerente_t">{{ $data->x_fiveamt*5}}</div>
                            </td>
                            <td>
                                <div class="col borde text-success" id="x_fiveamtGerente_r">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$10x</td>
                            <td> <input name="x_tenamtGerente" value="0.00" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td>
                                <div class="col borde" id="x_tenamtGerente_t">{{ $data->x_tenamt*10 }}</div>
                            </td>
                            <td>
                                <div class="col borde text-success" id="x_tenamtGerente_r">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$20x</td>
                            <td> <input name="x_twentyamtGerente" value="0.00" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td>
                                <div class="col borde" id="x_twentyamtGerente_t">{{ $data->x_twentyamt*20 }}</div>
                            </td>
                            <td>
                                <div class="col borde text-success" id="x_twentyamtGerente_r">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$50x</td>
                            <td> <input name="x_fiftyamtGerente" value="0.00" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td>
                                <div class="col borde" id="x_fiftyamtGerente_t">{{ $data->x_fiftyamt*50 }}</div>
                            </td>
                            <td>
                                <div class="col borde text-success" id="x_fiftyamtGerente_r">0.00</div>
                            </td>
                        </tr>
                        <tr>
                            <td>$100x</td>
                            <td><input name="x_hundredamtGerente" value="0.00" type="number" style="width:100%;" class="text-left" placeholder="0.00" onchange="cal()" onkeyup="cal()">
                            </td>
                            <td>
                                <div class="col borde" id="x_hundredamtGerente_t">{{ $data->x_hundredamt*100 }}</div>
                            </td>
                            <td>
                                <div class="col borde text-success" id="x_hundredamtGerente_r">0.00</div>
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
                            <th>Otros Ger</th>
                            <th>
                                <h5 class="mb-0 fw-bold text-success" id="Otros_Gerente_t">{{ $data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }} </h5>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Yappy</td>
                            <td><input name="yappyGerente" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></td>
                            <td>
                                <div class="col borde text-success" id="yappyGerente_r">0.0</div>
                        </tr>
                        <tr>
                            <td>Otros</td>
                            <td>
                                <div class="col borde"><input name="otrosGerente" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></div>
                            </td>
                            <td>
                                <div class="col borde text-success" id="otrosGerente_r">0.0</div>
                            </td>

                        </tr>
                        <tr>
                            <td>Vales Pagoda </td>
                            <td>
                                <div class="col borde"><input name="valespagodaGerente" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></div>
                            </td>
                            <td>
                                <div class="col borde text-success" id="valespagodaGerente_r">0.0</div>
                            </td>

                        </tr>
                        <tr>
                            <td> Monto cheques</td>
                            <td>
                                <div class="col borde"><input name="CheckAmtGerente" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></div>
                            </td>
                            <td>
                                <div class="col borde text-success" id="CheckAmtGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td> Loteria</td>
                            <td>
                                <div class="col borde"><input name="LotoAmtGerente" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></div>
                            </td>
                            <td>
                                <div class="col borde text-success" id="LotoAmtGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Clave</td>
                            <td><input name="CardClaveGerente" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></td>
                            <td>
                                <div style="visibility: hidden;" class="col borde text-success" id="CardClaveGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Vale</td>
                            <td>
                                <div class="col borde"><input name="CardValeGerente" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></div>
                            </td>
                            <td>
                                <div style="visibility: hidden;" class="col borde text-success" id="CardValeGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Visa</td>
                            <td>
                                <div class="col borde"><input name="CardVisaGerente" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></div>
                            </td>
                            <td>
                                <div class="col borde text-success" id="CardVisaGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Master</td>
                            <td>
                                <div class="col borde"><input name="CardMasterGerente" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></div>
                            </td>
                            <td>
                                <div style="visibility: hidden;" class="col borde text-success" id="CardMasterGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>American</td>
                            <td>
                                <div class="col borde"><input name="CardAEGerente" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></div>
                            </td>
                            <td>
                                <div style="visibility: hidden;" class="col borde text-success" id="CardAEGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Sencillo</td>
                            <td>
                                <div class="col borde"><input name="CashAmtGerente" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></div>
                            </td>
                            <td>
                                <div class="col borde text-success" id="CashAmtGerente_r">0.0</div>
                            </td>
                        </tr>

                        <tr>
                            <td>Rollos </td>
                            <td>
                                <div class="col borde"><input name="CoinRollGerente" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></div>
                            </td>
                            <td>
                                <div class="col borde text-success" id="CoinRollGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Facturas </td>
                            <td>
                                <div class="col borde"><input name="InvoiceAmtGerente" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></div>
                            </td>
                            <td>
                                <div class="col borde text-success" id="InvoiceAmtGerente_r">0.0</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Vale digital </td>
                            <td>
                                <div class="col borde"><input name="VoucherAmtGerente" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></div>
                            </td>
                            <td>
                                <div class="col borde text-success" id="VoucherAmtGerente_r">0.0</div>
                            </td>

                        </tr>
                        <tr>
                            <td>Beca Digital </td>
                            <td>
                                <div class="col borde"><input name="GrantAmtGerente" value="0.00" type="number" step="0.01" class="w-100 text-right" placeholder="0.00" onchange="cal()" onkeyup="cal()"></div>
                            </td>
                            <td>
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
                            <h5 class="mb-0 fw-bold text-success" id="Monto_Gerente_t">{{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100+$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</h5>
                        </div>
                    </div>
                    <h6 class="mb-0 text-right">Subtotal = {{ $data->BeginningBalance+$data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100+$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</b></h6>
                    <h6 class="mb-0 text-right">Monto X = <b>{{ $data->XAmt }}</b></h6>
                    <h6 class="mb-0 text-right">Diferencia = <b>{{ $data->DifferenceAmt }}</b></h6>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Total Panaderia</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h5 class="mb-0"> <input name="totalPanaderiaGerente" value="0" type="number" step="0.01" class="w-100 text-right" placeholder="0.00"> </h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Total Pagatodo</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h5 class="mb-0"> <input name="totalPagatodoGerente" value="0" type="number" step="0.01" class="w-100 text-right" placeholder="0.00"> </h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Total Super</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h5 class="mb-0"> <input name="totalsuperGerente" value="0" type="number" step="0.01" class="w-100 text-right" placeholder="0.00"> </h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Dinero de Taxi</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h5 class="mb-0"> <input name="dineroTaxiGerente" value="0" type="number" step="0.01" class="w-100 text-right" placeholder="0.00"> </h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Vuelto de mercado</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h5 class="mb-0"> <input name="vueltoMercadoGerente" value="0" type="number" step="0.01" class="w-100 text-right" placeholder="0.00"> </h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <p class="mb-0">Comentarios</p>
                        </div>
                        <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                            <h5 class="mb-0"> <textarea name="comentariosGerente" value="0" class="w-100 text-right" placeholder="Comentarios"></textarea></h5>
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
@endforeach
@endif

@endif
@endsection
<script>
    window.onload = function() {
        cal();
        zero();
    }

    function zero() {
        if (isNaN(parseInt(document.closecash_store.x_oneamtFiscalizadora.value))) {
            document.closecash_store.x_oneamtFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.x_fiveamtFiscalizadora.value))) {
            document.closecash_store.x_fiveamtFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.x_tenamtFiscalizadora.value))) {
            document.closecash_store.x_tenamtFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.x_twentyamtFiscalizadora.value))) {
            document.closecash_store.x_twentyamtFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.x_fiftyamtFiscalizadora.value))) {
            document.closecash_store.x_fiftyamtFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.x_hundredamtFiscalizadora.value))) {
            document.closecash_store.x_hundredamtFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.x_oneamtGerente.value))) {
            document.closecash_store.x_oneamtGerente.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.x_fiveamtGerente.value))) {
            document.closecash_store.x_fiveamtGerente.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.x_tenamtGerente.value))) {
            document.closecash_store.x_tenamtGerente.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.x_twentyamtGerente.value))) {
            document.closecash_store.x_twentyamtGerente.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.x_fiftyamtGerente.value))) {
            document.closecash_store.x_fiftyamtGerente.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.x_hundredamtGerente.value))) {
            document.closecash_store.x_hundredamtGerente.value = 0;
        }
        ////
        if (isNaN(parseInt(document.closecash_store.yappyFiscalizadora.value))) {
            document.closecash_store.yappyFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.otrosFiscalizadora.value))) {
            document.closecash_store.otrosFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.valespagodaFiscalizadora.value))) {
            document.closecash_store.valespagodaFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.CheckAmtFiscalizadora.value))) {
            document.closecash_store.CheckAmtFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.LotoAmtFiscalizadora.value))) {
            document.closecash_store.LotoAmtFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.CardClaveFiscalizadora.value))) {
            document.closecash_store.CardClaveFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.CardValeFiscalizadora.value))) {
            document.closecash_store.CardValeFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.CardVisaFiscalizadora.value))) {
            document.closecash_store.CardVisaFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.CardMasterFiscalizadora.value))) {
            document.closecash_store.CardMasterFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.CardAEFiscalizadora.value))) {
            document.closecash_store.CardAEFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.CashAmtFiscalizadora.value))) {
            document.closecash_store.CashAmtFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.CoinRollFiscalizadora.value))) {
            document.closecash_store.CoinRollFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.InvoiceAmtFiscalizadora.value))) {
            document.closecash_store.InvoiceAmtFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.VoucherAmtFiscalizadora.value))) {
            document.closecash_store.VoucherAmtFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.GrantAmtFiscalizadora.value))) {
            document.closecash_store.GrantAmtFiscalizadora.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.yappyGerente.value))) {
            document.closecash_store.yappyGerente.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.otrosGerente.value))) {
            document.closecash_store.otrosGerente.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.valespagodaGerente.value))) {
            document.closecash_store.valespagodaGerente.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.CheckAmtGerente.value))) {
            document.closecash_store.CheckAmtGerente.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.LotoAmtGerente.value))) {
            document.closecash_store.LotoAmtGerente.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.CardClaveGerente.value))) {
            document.closecash_store.CardClaveGerente.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.CardValeGerente.value))) {
            document.closecash_store.CardValeGerente.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.CardVisaGerente.value))) {
            document.closecash_store.CardVisaGerente.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.CardMasterGerente.value))) {
            document.closecash_store.CardMasterGerente.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.CardAEGerente.value))) {
            document.closecash_store.CardAEGerente.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.CashAmtGerente.value))) {
            document.closecash_store.CashAmtGerente.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.CoinRollGerente.value))) {
            document.closecash_store.CoinRollGerente.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.InvoiceAmtGerente.value))) {
            document.closecash_store.InvoiceAmtGerente.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.VoucherAmtGerente.value))) {
            document.closecash_store.VoucherAmtGerente.value = 0;
        }
        if (isNaN(parseInt(document.closecash_store.GrantAmtGerente.value))) {
            document.closecash_store.GrantAmtGerente.value = 0;
        }
    }

    function cal() {
        try {

            if (isNaN(parseInt(document.closecash_store.x_oneamtFiscalizadora.value))) {
                document.closecash_store.x_oneamtFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.x_fiveamtFiscalizadora.value))) {
                document.closecash_store.x_fiveamtFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.x_tenamtFiscalizadora.value))) {
                document.closecash_store.x_tenamtFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.x_twentyamtFiscalizadora.value))) {
                document.closecash_store.x_twentyamtFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.x_fiftyamtFiscalizadora.value))) {
                document.closecash_store.x_fiftyamtFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.x_hundredamtFiscalizadora.value))) {
                document.closecash_store.x_hundredamtFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.x_oneamtGerente.value))) {
                document.closecash_store.x_oneamtGerente.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.x_fiveamtGerente.value))) {
                document.closecash_store.x_fiveamtGerente.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.x_tenamtGerente.value))) {
                document.closecash_store.x_tenamtGerente.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.x_twentyamtGerente.value))) {
                document.closecash_store.x_twentyamtGerente.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.x_fiftyamtGerente.value))) {
                document.closecash_store.x_fiftyamtGerente.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.x_hundredamtGerente.value))) {
                document.closecash_store.x_hundredamtGerente.value = "";
            }
            ////
            if (isNaN(parseInt(document.closecash_store.yappyFiscalizadora.value))) {
                document.closecash_store.yappyFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.otrosFiscalizadora.value))) {
                document.closecash_store.otrosFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.valespagodaFiscalizadora.value))) {
                document.closecash_store.valespagodaFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.CheckAmtFiscalizadora.value))) {
                document.closecash_store.CheckAmtFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.LotoAmtFiscalizadora.value))) {
                document.closecash_store.LotoAmtFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.CardClaveFiscalizadora.value))) {
                document.closecash_store.CardClaveFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.CardValeFiscalizadora.value))) {
                document.closecash_store.CardValeFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.CardVisaFiscalizadora.value))) {
                document.closecash_store.CardVisaFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.CardMasterFiscalizadora.value))) {
                document.closecash_store.CardMasterFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.CardAEFiscalizadora.value))) {
                document.closecash_store.CardAEFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.CashAmtFiscalizadora.value))) {
                document.closecash_store.CashAmtFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.CoinRollFiscalizadora.value))) {
                document.closecash_store.CoinRollFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.InvoiceAmtFiscalizadora.value))) {
                document.closecash_store.InvoiceAmtFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.VoucherAmtFiscalizadora.value))) {
                document.closecash_store.VoucherAmtFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.GrantAmtFiscalizadora.value))) {
                document.closecash_store.GrantAmtFiscalizadora.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.yappyGerente.value))) {
                document.closecash_store.yappyGerente.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.otrosGerente.value))) {
                document.closecash_store.otrosGerente.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.valespagodaGerente.value))) {
                document.closecash_store.valespagodaGerente.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.CheckAmtGerente.value))) {
                document.closecash_store.CheckAmtGerente.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.LotoAmtGerente.value))) {
                document.closecash_store.LotoAmtGerente.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.CardClaveGerente.value))) {
                document.closecash_store.CardClaveGerente.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.CardValeGerente.value))) {
                document.closecash_store.CardValeGerente.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.CardVisaGerente.value))) {
                document.closecash_store.CardVisaGerente.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.CardMasterGerente.value))) {
                document.closecash_store.CardMasterGerente.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.CardAEGerente.value))) {
                document.closecash_store.CardAEGerente.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.CashAmtGerente.value))) {
                document.closecash_store.CashAmtGerente.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.CoinRollGerente.value))) {
                document.closecash_store.CoinRollGerente.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.InvoiceAmtGerente.value))) {
                document.closecash_store.InvoiceAmtGerente.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.VoucherAmtGerente.value))) {
                document.closecash_store.VoucherAmtGerente.value = "";
            }
            if (isNaN(parseInt(document.closecash_store.GrantAmtGerente.value))) {
                document.closecash_store.GrantAmtGerente.value = "";
            }
            ////
            document.getElementById("x_oneamtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.x_oneamtFiscalizadora.value) - (document.closecash_store.fis1.value)).toFixed(2);
            document.getElementById("x_oneamtFiscalizadora_t").innerHTML = (document.closecash_store.x_oneamtFiscalizadora.value) * 1;
            document.getElementById("x_oneamtGerente_r").innerHTML = parseFloat((document.closecash_store.x_oneamtGerente.value) - (document.closecash_store.x_oneamtFiscalizadora.value)).toFixed(2);
            document.getElementById("x_oneamtGerente_t").innerHTML = (document.closecash_store.x_oneamtGerente.value) * 1;

            document.getElementById("x_fiveamtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.x_fiveamtFiscalizadora.value) - (document.closecash_store.fis5.value)).toFixed(2);
            document.getElementById("x_fiveamtFiscalizadora_t").innerHTML = (document.closecash_store.x_fiveamtFiscalizadora.value) * 5;
            document.getElementById("x_fiveamtGerente_r").innerHTML = parseFloat((document.closecash_store.x_fiveamtGerente.value) - (document.closecash_store.x_fiveamtFiscalizadora.value)).toFixed(2);
            document.getElementById("x_fiveamtGerente_t").innerHTML = (document.closecash_store.x_fiveamtGerente.value) * 5;

            document.getElementById("x_tenamtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.x_tenamtFiscalizadora.value) - (document.closecash_store.fis10.value)).toFixed(2);
            document.getElementById("x_tenamtFiscalizadora_t").innerHTML = (document.closecash_store.x_tenamtFiscalizadora.value) * 10;
            document.getElementById("x_tenamtGerente_r").innerHTML = parseFloat((document.closecash_store.x_tenamtGerente.value) - (document.closecash_store.x_tenamtFiscalizadora.value)).toFixed(2);
            document.getElementById("x_tenamtGerente_t").innerHTML = (document.closecash_store.x_tenamtGerente.value) * 10;

            document.getElementById("x_twentyamtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.x_twentyamtFiscalizadora.value) - (document.closecash_store.fis20.value)).toFixed(2);
            document.getElementById("x_twentyamtFiscalizadora_t").innerHTML = (document.closecash_store.x_twentyamtFiscalizadora.value) * 20;
            document.getElementById("x_twentyamtGerente_r").innerHTML = parseFloat((document.closecash_store.x_twentyamtGerente.value) - (document.closecash_store.x_twentyamtFiscalizadora.value)).toFixed(2);
            document.getElementById("x_twentyamtGerente_t").innerHTML = (document.closecash_store.x_twentyamtGerente.value) * 20;

            document.getElementById("x_fiftyamtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.x_fiftyamtFiscalizadora.value) - (document.closecash_store.fis50.value)).toFixed(2);
            document.getElementById("x_fiftyamtFiscalizadora_t").innerHTML = (document.closecash_store.x_fiftyamtFiscalizadora.value) * 50;
            document.getElementById("x_fiftyamtGerente_r").innerHTML = parseFloat((document.closecash_store.x_fiftyamtGerente.value) - (document.closecash_store.x_fiftyamtFiscalizadora.value)).toFixed(2);
            document.getElementById("x_fiftyamtGerente_t").innerHTML = (document.closecash_store.x_fiftyamtGerente.value) * 50;

            document.getElementById("x_hundredamtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.x_hundredamtFiscalizadora.value) - (document.closecash_store.fis100.value)).toFixed(2);
            document.getElementById("x_hundredamtFiscalizadora_t").innerHTML = (document.closecash_store.x_hundredamtFiscalizadora.value) * 100;
            document.getElementById("x_hundredamtGerente_r").innerHTML = parseFloat((document.closecash_store.x_hundredamtGerente.value) - (document.closecash_store.x_hundredamtFiscalizadora.value)).toFixed(2);
            document.getElementById("x_hundredamtGerente_t").innerHTML = (document.closecash_store.x_hundredamtGerente.value) * 100;

            // Otros Fiscalizadora
            document.getElementById("yappyFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.yappyFiscalizadora.value) - (document.closecash_store.yappySistema.value)).toFixed(2);
            document.getElementById("otrosFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.otrosFiscalizadora.value) - (document.closecash_store.otrosSistema.value)).toFixed(2);
            document.getElementById("valespagodaFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.valespagodaFiscalizadora.value) - (document.closecash_store.valespagodaSistema.value)).toFixed(2);
            document.getElementById("CheckAmtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.CheckAmtFiscalizadora.value) - (document.closecash_store.CheckAmtSistema.value)).toFixed(2);
            document.getElementById("LotoAmtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.LotoAmtFiscalizadora.value) - (document.closecash_store.LotoAmtSistema.value)).toFixed(2);
            document.getElementById("CardClaveFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.CardClaveFiscalizadora.value) - (document.closecash_store.CardAmtSistema.value)).toFixed(2);
            document.getElementById("CardValeFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.CardValeFiscalizadora.value) - (document.closecash_store.CardAmtSistema.value)).toFixed(2);
            document.getElementById("CardVisaFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.CardVisaFiscalizadora.value) - (document.closecash_store.CardAmtSistema.value)).toFixed(2);
            document.getElementById("CardMasterFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.CardMasterFiscalizadora.value) - (document.closecash_store.CardAmtSistema.value)).toFixed(2);
            document.getElementById("CardAEFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.CardAEFiscalizadora.value) - (document.closecash_store.CardAmtSistema.value)).toFixed(2);
            document.getElementById("CashAmtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.CashAmtFiscalizadora.value) - (document.closecash_store.CashAmtSistema.value)).toFixed(2);
            document.getElementById("CoinRollFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.CoinRollFiscalizadora.value) - (document.closecash_store.CoinRollSistema.value)).toFixed(2);
            document.getElementById("InvoiceAmtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.InvoiceAmtFiscalizadora.value) - (document.closecash_store.InvoiceAmtSistema.value)).toFixed(2);
            document.getElementById("VoucherAmtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.VoucherAmtFiscalizadora.value) - (document.closecash_store.VoucherAmtSistema.value)).toFixed(2);
            document.getElementById("GrantAmtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.GrantAmtFiscalizadora.value) - (document.closecash_store.GrantAmtSistema.value)).toFixed(2);

            // Otros Gerente
            document.getElementById("yappyGerente_r").innerHTML = parseFloat((document.closecash_store.yappyGerente.value) - (document.closecash_store.yappyFiscalizadora.value)).toFixed(2);
            document.getElementById("otrosGerente_r").innerHTML = parseFloat((document.closecash_store.otrosGerente.value) - (document.closecash_store.otrosFiscalizadora.value)).toFixed(2);
            document.getElementById("valespagodaGerente_r").innerHTML = parseFloat((document.closecash_store.valespagodaGerente.value) - (document.closecash_store.valespagodaFiscalizadora.value)).toFixed(2);
            document.getElementById("CheckAmtGerente_r").innerHTML = parseFloat((document.closecash_store.CheckAmtGerente.value) - (document.closecash_store.CheckAmtFiscalizadora.value)).toFixed(2);
            document.getElementById("LotoAmtGerente_r").innerHTML = parseFloat((document.closecash_store.LotoAmtGerente.value) - (document.closecash_store.LotoAmtFiscalizadora.value)).toFixed(2);
            document.getElementById("CardClaveGerente_r").innerHTML = parseFloat((document.closecash_store.CardClaveGerente.value) - (document.closecash_store.CardClaveFiscalizadora.value)).toFixed(2);
            document.getElementById("CardValeGerente_r").innerHTML = parseFloat((document.closecash_store.CardValeGerente.value) - (document.closecash_store.CardValeFiscalizadora.value)).toFixed(2);
            document.getElementById("CardVisaGerente_r").innerHTML = parseFloat((document.closecash_store.CardVisaGerente.value) - (document.closecash_store.CardVisaFiscalizadora.value)).toFixed(2);
            document.getElementById("CardMasterGerente_r").innerHTML = parseFloat((document.closecash_store.CardMasterGerente.value) - (document.closecash_store.CardMasterFiscalizadora.value)).toFixed(2);
            document.getElementById("CardAEGerente_r").innerHTML = parseFloat((document.closecash_store.CardAEGerente.value) - (document.closecash_store.CardAEFiscalizadora.value)).toFixed(2);
            document.getElementById("CashAmtGerente_r").innerHTML = parseFloat((document.closecash_store.CashAmtGerente.value) - (document.closecash_store.CashAmtFiscalizadora.value)).toFixed(2);
            document.getElementById("CoinRollGerente_r").innerHTML = parseFloat((document.closecash_store.CoinRollGerente.value) - (document.closecash_store.CoinRollFiscalizadora.value)).toFixed(2);
            document.getElementById("InvoiceAmtGerente_r").innerHTML = parseFloat((document.closecash_store.InvoiceAmtGerente.value) - (document.closecash_store.InvoiceAmtFiscalizadora.value)).toFixed(2);
            document.getElementById("VoucherAmtGerente_r").innerHTML = parseFloat((document.closecash_store.VoucherAmtGerente.value) - (document.closecash_store.VoucherAmtFiscalizadora.value)).toFixed(2);
            document.getElementById("GrantAmtGerente_r").innerHTML = parseFloat((document.closecash_store.GrantAmtGerente.value) - (document.closecash_store.GrantAmtFiscalizadora.value)).toFixed(2);


            const card = parseFloat(parseFloat(document.closecash_store.CardClaveFiscalizadora.value) + parseFloat(document.closecash_store.CardValeFiscalizadora.value) + parseFloat(document.closecash_store.CardVisaFiscalizadora.value) + parseFloat(document.closecash_store.CardMasterFiscalizadora.value) + parseFloat(document.closecash_store.CardAEFiscalizadora.value)).toFixed(2);
            const cardg = parseFloat(parseFloat(document.closecash_store.CardClaveGerente.value) + parseFloat(document.closecash_store.CardValeGerente.value) + parseFloat(document.closecash_store.CardVisaGerente.value) + parseFloat(document.closecash_store.CardMasterGerente.value) + parseFloat(document.closecash_store.CardAEGerente.value)).toFixed(2);

            document.getElementById("CardClaveFiscalizadora_r").innerHTML = parseFloat(card - document.closecash_store.CardAmtSistema.value).toFixed(2);
            document.getElementById("CardValeFiscalizadora_r").innerHTML = parseFloat(card - document.closecash_store.CardAmtSistema.value).toFixed(2);
            document.getElementById("CardVisaFiscalizadora_r").innerHTML = parseFloat(card - document.closecash_store.CardAmtSistema.value).toFixed(2);
            document.getElementById("CardMasterFiscalizadora_r").innerHTML = parseFloat(card - document.closecash_store.CardAmtSistema.value).toFixed(2);
            document.getElementById("CardAEFiscalizadora_r").innerHTML = parseFloat(card - document.closecash_store.CardAmtSistema.value).toFixed(2);

            document.getElementById("CardClaveGerente_r").innerHTML = parseFloat(cardg - card).toFixed(2);
            document.getElementById("CardValeGerente_r").innerHTML = parseFloat(cardg - card).toFixed(2);
            document.getElementById("CardVisaGerente_r").innerHTML = parseFloat(cardg - card).toFixed(2);
            document.getElementById("CardMasterGerente_r").innerHTML = parseFloat(cardg - card).toFixed(2);
            document.getElementById("CardAEGerente_r").innerHTML = parseFloat(cardg - card).toFixed(2);

            const cambio1 = document.getElementById("x_oneamtFiscalizadora_r");
            const cambio5 = document.getElementById("x_fiveamtFiscalizadora_r");
            const cambio10 = document.getElementById("x_tenamtFiscalizadora_r");
            const cambio20 = document.getElementById("x_twentyamtFiscalizadora_r");
            const cambio50 = document.getElementById("x_fiftyamtFiscalizadora_r");
            const cambio100 = document.getElementById("x_hundredamtFiscalizadora_r");

            const cambio1g = document.getElementById("x_oneamtGerente_r");
            const cambio5g = document.getElementById("x_fiveamtGerente_r");
            const cambio10g = document.getElementById("x_tenamtGerente_r");
            const cambio20g = document.getElementById("x_twentyamtGerente_r");
            const cambio50g = document.getElementById("x_fiftyamtGerente_r");
            const cambio100g = document.getElementById("x_hundredamtGerente_r");

            const cambioyappyFiscalizadora = document.getElementById("yappyFiscalizadora_r");
            const cambiootrosFiscalizadora = document.getElementById("otrosFiscalizadora_r");
            const cambiovalespagodaFiscalizadora = document.getElementById("valespagodaFiscalizadora_r");
            const cambioCheckAmtFiscalizadora = document.getElementById("CheckAmtFiscalizadora_r");
            const cambioLotoAmtFiscalizadora = document.getElementById("LotoAmtFiscalizadora_r");
            const cambioCardClaveFiscalizadora = document.getElementById("CardClaveFiscalizadora_r");
            const cambioCardValeFiscalizadora = document.getElementById("CardValeFiscalizadora_r");
            const cambioCardVisaFiscalizadora = document.getElementById("CardVisaFiscalizadora_r");
            const cambioCardMasterFiscalizadora = document.getElementById("CardMasterFiscalizadora_r");
            const cambioCardAEFiscalizadora = document.getElementById("CardAEFiscalizadora_r");
            const cambioCashAmtFiscalizadora = document.getElementById("CashAmtFiscalizadora_r");
            const cambioCoinRollFiscalizadora = document.getElementById("CoinRollFiscalizadora_r");
            const cambioInvoiceAmtFiscalizadora = document.getElementById("InvoiceAmtFiscalizadora_r");
            const cambioVoucherAmtFiscalizadora = document.getElementById("VoucherAmtFiscalizadora_r");
            const cambioGrantAmtFiscalizadora = document.getElementById("GrantAmtFiscalizadora_r");

            const cambioyappyGerente = document.getElementById("yappyGerente_r");
            const cambiootrosGerente = document.getElementById("otrosGerente_r");
            const cambiovalespagodaGerente = document.getElementById("valespagodaGerente_r");
            const cambioCheckAmtGerente = document.getElementById("CheckAmtGerente_r");
            const cambioLotoAmtGerente = document.getElementById("LotoAmtGerente_r");
            const cambioCardClaveGerente = document.getElementById("CardClaveGerente_r");
            const cambioCardValeGerente = document.getElementById("CardValeGerente_r");
            const cambioCardVisaGerente = document.getElementById("CardVisaGerente_r");
            const cambioCardMasterGerente = document.getElementById("CardMasterGerente_r");
            const cambioCardAEGerente = document.getElementById("CardAEGerente_r");
            const cambioCashAmtGerente = document.getElementById("CashAmtGerente_r");
            const cambioCoinRollGerente = document.getElementById("CoinRollGerente_r");
            const cambioInvoiceAmtGerente = document.getElementById("InvoiceAmtGerente_r");
            const cambioVoucherAmtGerente = document.getElementById("VoucherAmtGerente_r");
            const cambioGrantAmtGerente = document.getElementById("GrantAmtGerente_r");


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

            document.getElementById("Fiscalizadora_t").innerHTML = parseFloat(document.getElementById("x_oneamtFiscalizadora_t").innerHTML) + parseFloat(document.getElementById("x_fiveamtFiscalizadora_t").innerHTML) + parseFloat(document.getElementById("x_tenamtFiscalizadora_t").innerHTML) + parseFloat(document.getElementById("x_twentyamtFiscalizadora_t").innerHTML) + parseFloat(document.getElementById("x_fiftyamtFiscalizadora_t").innerHTML) + parseFloat(document.getElementById("x_hundredamtFiscalizadora_t").innerHTML);
            document.getElementById("Gerente_t").innerHTML = parseFloat(document.getElementById("x_oneamtGerente_t").innerHTML) + parseFloat(document.getElementById("x_fiveamtGerente_t").innerHTML) + parseFloat(document.getElementById("x_tenamtGerente_t").innerHTML) + parseFloat(document.getElementById("x_twentyamtGerente_t").innerHTML) + parseFloat(document.getElementById("x_fiftyamtGerente_t").innerHTML) + parseFloat(document.getElementById("x_hundredamtGerente_t").innerHTML);
            document.getElementById("Otros_Fiscalizadora_t").innerHTML = parseFloat(parseFloat(document.closecash_store.yappyFiscalizadora.value) + parseFloat(document.closecash_store.otrosFiscalizadora.value) + parseFloat(document.closecash_store.valespagodaFiscalizadora.value) + parseFloat(document.closecash_store.CheckAmtFiscalizadora.value) + parseFloat(document.closecash_store.LotoAmtFiscalizadora.value) + parseFloat(document.closecash_store.CashAmtFiscalizadora.value) + parseFloat(document.closecash_store.CoinRollFiscalizadora.value) + parseFloat(document.closecash_store.InvoiceAmtFiscalizadora.value) + parseFloat(document.closecash_store.VoucherAmtFiscalizadora.value) + parseFloat(document.closecash_store.GrantAmtFiscalizadora.value) + parseFloat(document.closecash_store.CardClaveFiscalizadora.value) + parseFloat(document.closecash_store.CardValeFiscalizadora.value) + parseFloat(document.closecash_store.CardVisaFiscalizadora.value) + parseFloat(document.closecash_store.CardMasterFiscalizadora.value) + parseFloat(document.closecash_store.CardAEFiscalizadora.value)).toFixed(2);
            document.getElementById("Otros_Gerente_t").innerHTML = parseFloat(parseFloat(document.closecash_store.yappyGerente.value) + parseFloat(document.closecash_store.otrosGerente.value) + parseFloat(document.closecash_store.valespagodaGerente.value) + parseFloat(document.closecash_store.CheckAmtGerente.value) + parseFloat(document.closecash_store.LotoAmtGerente.value) + parseFloat(document.closecash_store.CashAmtGerente.value) + parseFloat(document.closecash_store.CoinRollGerente.value) + parseFloat(document.closecash_store.InvoiceAmtGerente.value) + parseFloat(document.closecash_store.VoucherAmtGerente.value) + parseFloat(document.closecash_store.GrantAmtGerente.value) + parseFloat(document.closecash_store.CardValeGerente.value) + parseFloat(document.closecash_store.CardClaveGerente.value) + parseFloat(document.closecash_store.CardVisaGerente.value) + parseFloat(document.closecash_store.CardMasterGerente.value) + parseFloat(document.closecash_store.CardAEGerente.value)).toFixed(2);
            document.getElementById("Monto_Fiscalizadora_t").innerHTML = parseFloat(parseFloat(document.getElementById("Fiscalizadora_t").innerHTML) + parseFloat(document.getElementById("Otros_Fiscalizadora_t").innerHTML)).toFixed(2);
            document.getElementById("Monto_Gerente_t").innerHTML = parseFloat(parseFloat(document.getElementById("Gerente_t").innerHTML) + parseFloat(document.getElementById("Otros_Gerente_t").innerHTML)).toFixed(2);
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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

            ///tarjetas
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
            ///
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
            /////////////////////////////////////////////////////////////////////////////////
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
            ////////////////////////////////////////////////////////////////////////////////////////
            const cambioFiscalizadora_t = document.getElementById("Fiscalizadora_t");
            const cambioGerente_t = document.getElementById("Gerente_t");
            const cambioOtros_Fiscalizadora_t = document.getElementById("Otros_Fiscalizadora_t");
            const cambioOtros_Gerente_t = document.getElementById("Otros_Gerente_t");
            const cambioMonto_Fiscalizadora_t = document.getElementById("Monto_Fiscalizadora_t");
            const cambioMonto_Gerente_t = document.getElementById("Monto_Gerente_t");

            if (document.getElementById("Fiscalizadora_t").innerHTML < document.getElementById("Montosistema_t").innerHTML) {
                cambioFiscalizadora_t.classList.replace("text-success", "text-danger");
            } else {
                cambioFiscalizadora_t.classList.replace("text-success", "text-success");
                cambioFiscalizadora_t.classList.replace("text-danger", "text-success");
            }
            if (document.getElementById("Gerente_t").innerHTML < document.getElementById("Fiscalizadora_t").innerHTML || document.getElementById("Gerente_t").innerHTML < document.getElementById("Montosistema_t").innerHTML) {
                cambioGerente_t.classList.replace("text-success", "text-danger");
            } else {
                cambioGerente_t.classList.replace("text-success", "text-success");
                cambioGerente_t.classList.replace("text-danger", "text-success");
            }
            if (document.getElementById("Otros_Fiscalizadora_t").innerHTML < document.getElementById("Otros").innerHTML) {
                cambioOtros_Fiscalizadora_t.classList.replace("text-success", "text-danger");
            } else {
                cambioOtros_Fiscalizadora_t.classList.replace("text-success", "text-success");
                cambioOtros_Fiscalizadora_t.classList.replace("text-danger", "text-success");
            }
            if (document.getElementById("Otros_Gerente_t").innerHTML < document.getElementById("Otros_Fiscalizadora_t").innerHTML) {
                cambioOtros_Gerente_t.classList.replace("text-success", "text-danger");
            } else {
                cambioOtros_Gerente_t.classList.replace("text-success", "text-success");
                cambioOtros_Gerente_t.classList.replace("text-danger", "text-success");
            }
            if (document.getElementById("Monto_Fiscalizadora_t").innerHTML < document.getElementById("Monto_contado_Sistema").innerHTML) {
                cambioMonto_Fiscalizadora_t.classList.replace("text-success", "text-danger");
            } else {
                cambioMonto_Fiscalizadora_t.classList.replace("text-success", "text-success");
                cambioMonto_Fiscalizadora_t.classList.replace("text-danger", "text-success");
            }
            if (document.getElementById("Monto_Gerente_t").innerHTML < document.getElementById("Monto_Fiscalizadora_t").innerHTML) {
                cambioMonto_Gerente_t.classList.replace("text-success", "text-danger");
            } else {
                cambioMonto_Gerente_t.classList.replace("text-success", "text-success");
                cambioMonto_Gerente_t.classList.replace("text-danger", "text-success");
            }
        } catch (e) {}
    }
</script>