@extends('layouts.app')

@section('content')
<form name="closecash_import" id="closecash_import" method="post" action="{{ route('closecash.import') }}" enctype="multipart/form-data">
    @csrf

    <div class="card m-5">
        <div class="card-header">
            <div class="container">

                <div class="row my-1">
                    <div class="text-center col-md-3">
                        <label for="cars">Seleccione una sucursal</label>
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

                    <div class="text-center col-md-3">

                    </div>
                    <div class="text-center col-md-3">
                        <div class="form-group row"><label class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0">Fecha</label>
                            <div class="col-md-7 offset-md-3 col-7 col-sm-7 col-lg-7 m-0 p-0"><input name="DateTrx" type="date" value={{ date("Y-m-d") }} class="form-control text-left w-100 m-0 p-0" placeholder=""></div>
                        </div>
                    </div>
                    <div class="text-center col-md-3">
                        <button type="submit" class="btn btn-primary m-0" href="#">Importar</button>
                    </div>

                </div>

            </div>
        </div>
</form>
@if (isset($closecashsumlist))
<form name="closecash_store" id="closecash_store" method="POST" action="{{ route('closecash.store') }}">

    @csrf
    @if ($closecashsumlist->{'records-size'} > 0)
    @foreach($closecashsumlist->records as $data)

    <div class="card-body ">
        <div class="container">
            <div class="row my-1">
                <div class="text-center col-md-3">
                    <h6>Cantidad de cierres: {{ $data->gh_closecash_id_count }}</h6>
                </div>
                <div class="text-center col-md-3"></div>

                <div class="text-center col-md-3">

                </div>

                <div class="text-center col-md-3">
                    <h6>Inicio caja: {{ $data->BeginningBalance }}</h6>
                </div>
            </div>
            <div class="row">
                <div class="text-center col-md-12">
                </div>
            </div>
            <div class="row p-0 m-0">
                <div class="p-0 col-4 col-sm-4 col-md-4 col-lg-4 m-0" style="">
                    <div class="card bg-light w-100">
                        <div class="card-header">Monto sistema</div>
                        <div class="card-body p-1">
                            <div class="row m-0 p-0">
                                <div class="col-8 col-md-6 m-0 p-0" style="">
                                    <h4 class="mb-0">Efectivo</h4>
                                </div>
                                <div class="col-4 text-right col-md-5 m-0 p-0" style="">
                                    <h5 class="mb-0"> <b>{{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100 }}</b> </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1">$1x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" value="{{ $data->x_oneamt }}" type="number" class="text-left  w-25 " placeholder="" readonly="">&nbsp;={{ $data->x_oneamt*1 }}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1" style="">$5x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" value="{{ $data->x_fiveamt }}" type="number" class="text-left  w-25 " placeholder="">&nbsp;={{ $data->x_fiveamt*5 }}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1">$10x&nbsp;&nbsp;&nbsp;<input name="" value="{{ $data->x_tenamt }}" type="number" class="text-left  w-25 " placeholder="">&nbsp;={{ $data->x_tenamt*10 }}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1 col-md-12">$20x&nbsp;&nbsp;&nbsp;<input name="" value="{{ $data->x_twentyamt }}" type="number" class="text-left  w-25 " placeholder="">&nbsp;={{ $data->x_twentyamt*20 }}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1 col-md-12">$50x&nbsp;&nbsp;&nbsp;<input name="" value="{{ $data->x_fiftyamt }}" type="number" class="text-left  w-25 " placeholder="">&nbsp;={{ $data->x_fiftyamt*50 }}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1 col-md-12">$100x&nbsp;<input name="" value="{{ $data->x_hundredamt }}" type="number" class="text-left  w-25 " placeholder="">&nbsp;={{ $data->x_hundredamt*100 }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-light">
                        <div class="card-body p-1">
                            <div class="row m-0 p-0">
                                <div class="col-6 m-0 p-0">
                                    <h4 class="mb-0">Otros</h4>
                                </div>
                                <div class="col-6 text-right m-0 p-0">
                                    <h5 class="mb-0"> <b>{{ $data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</b> </h5>
                                </div>
                            </div>
                            <div class="row p-0 my-1 m-0">
                                <div class="p-0 col-sm-5 col-md-5 col-lg-5 col-5 m-0" style="">Yappy&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="m-0 p-0 col-sm-7 col-md-7 col-lg-7 col-7" style=""><input name="yappySistema" value="{{ $data->yappy }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Otros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="otrosSistema" value="{{ $data->otros }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Vales Pagoda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="valespagodaSistema" value="{{ $data->valespagoda }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Monto cheques&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="CheckAmtSistema" value="{{ $data->CheckAmt }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Loteria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="LotoAmtSistema" value="{{ $data->LotoAmt }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Tarjetas&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="m-0 col-7 col-sm-7 col-md-7 col-lg-7 p-0" style=""><input name="CardAmtSistema" value="{{ $data->CardAmt }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Sencillo&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-sm-7 col-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="CashAmtSistema" value="{{ $data->CashAmt }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Rollos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="m-0 p-0 col-7 col-sm-7 col-md-7 col-lg-7" style=""><input name="CoinRollSistema" value="{{ $data->CoinRoll }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Facturas&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-md-7 col-sm-7 col-lg-7 m-0 p-0" style=""><input name="InvoiceAmtSistema" value="{{ $data->InvoiceAmt }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vale digital&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="VoucherAmtSistema" value="{{ $data->VoucherAmt }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Beca Digital&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="GrantAmtSistema" value="{{ $data->GrantAmt }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-light">
                        <div class="card-body p-1">
                            <div class="row m-0 p-0">
                                <div class="m-0 p-0 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Monto contado</h4>
                                </div>
                                <div class="text-right m-0 p-0 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <b>{{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100+$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</b> </h5>
                                </div>
                            </div>
                            <h6 class="mb-0 text-right">Subtotal = {{ $data->BeginningBalance+$data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100+$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</b></h6>
                            <h6 class="mb-0 text-right">Monto X = <b>{{ $data->XAmt }}</b></h6>
                            <h6 class="mb-0 text-right">Diferencia = <b>{{ $data->DifferenceAmt }}</b></h6>
                        </div>
                    </div>
                </div>
                <div class="p-0 col-4 col-sm-4 col-md-4 col-lg-4 m-0" style="">
                    <div class="card bg-light w-100">
                        <div class="card-header">Fiscalizadora</div>
                        <div class="card-body p-1">
                            <div class="row m-0 p-0">
                                <div class="col-8 col-md-6 m-0 p-0" style="">
                                    <h4 class="mb-0">Efectivo</h4>
                                </div>
                                <div class="col-4 text-right col-md-5 m-0 p-0" style="">
                                    <h5 class="mb-0"> <b>{{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100 }}</b> </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9 my-1">$1x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input name="num1" value="{{ $data->x_oneamt }}" type="number" class="text-left w-25 " placeholder="" onchange="cal()" onkeyup="cal()" />
                                    &nbsp;={{ $data->x_oneamt*1 }}&nbsp;
                                    <input type="hidden" name="num11" value="{{ $data->x_oneamt }}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col-3 my-1" style="">
                                    <input type="hidden" name="res1" value="0" readonly="readonly" />
                                    <p id="demo1" class="text-success">0</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9 my-1" style="">$5x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input name="num5" value="{{ $data->x_fiveamt}}" type="number" class="text-left w-25 " placeholder="" onchange="cal()" onkeyup="cal()">
                                    &nbsp;={{ $data->x_fiveamt*5}}&nbsp;
                                    <input type="hidden" name="num55" value="{{ $data->x_fiveamt}}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col-3 my-1" style="">
                                    <input type="hidden" name="res5" value="0" readonly="readonly" />
                                    <p id="demo5" class="text-success">0</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9 my-1">$10x&nbsp;&nbsp;&nbsp;
                                    <input name="num10" value="{{ $data->x_tenamt }}" type="number" class="text-left  w-25 " placeholder="" onchange="cal()" onkeyup="cal()">
                                    &nbsp;={{ $data->x_tenamt*10 }}
                                    <input type="hidden" name="num1010" value="{{ $data->x_tenamt }}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col-3 my-1" style="">
                                    <input type="hidden" name="res10" value="0" readonly="readonly" />
                                    <p id="demo10" class="text-success">0</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9 my-1">$20x&nbsp;&nbsp;&nbsp;
                                    <input name="num20" value="{{ $data->x_twentyamt }}" type="number" class="text-left  w-25 " placeholder="" onchange="cal()" onkeyup="cal()">
                                    &nbsp;={{ $data->x_twentyamt*20 }}
                                    <input type="hidden" name="num2020" value="{{ $data->x_twentyamt }}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col-3 my-1" style="">
                                    <input type="hidden" name="res20" value="0" readonly="readonly" />
                                    <p id="demo20" class="text-success">0</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-9 my-1">$50x&nbsp;&nbsp;&nbsp;
                                    <input name="num50" value="{{ $data->x_fiftyamt }}" type="number" class="text-left  w-25 " placeholder="" onchange="cal()" onkeyup="cal()">
                                    &nbsp;={{ $data->x_fiftyamt*50 }}
                                    <input type="hidden" name="num5050" value="{{ $data->x_fiftyamt }}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col-3 my-1" style="">
                                    <input type="hidden" name="res50" value="0" readonly="readonly" />
                                    <p id="demo50" class="text-success">0</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9 my-1">$100x&nbsp;
                                    <input name="num100" value="{{ $data->x_hundredamt }}" type="number" class="text-left  w-25 " placeholder="" onchange="cal()" onkeyup="cal()">
                                    &nbsp;={{ $data->x_hundredamt*100 }}
                                    <input type="hidden" name="num100100" value="{{ $data->x_hundredamt }}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col-3 my-1" style="">
                                    <input type="hidden" name="res100" value="0" readonly="readonly" />
                                    <p id="demo100" class="text-success">0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-light">
                        <div class="card-body p-1">
                            <div class="row m-0 p-0">
                                <div class="col-6 m-0 p-0">
                                    <h4 class="mb-0">Otros</h4>
                                </div>
                                <div class="col-6 text-right m-0 p-0">
                                    <h5 class="mb-0"> <b>{{ $data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</b> </h5>
                                </div>
                            </div>
                            <div class="row p-0 my-1 m-0">
                                <div class="p-0 col-sm-5 col-md-5 col-lg-5 col-5 m-0" style="">Yappy&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="m-0 p-0 col-sm-7 col-md-7 col-lg-7 col-7" style=""><input name="yappyFiscalizadora" value="{{ $data->yappy }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Otros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="otrosFiscalizadora" value="{{ $data->otros }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Vales Pagoda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="valespagodaFiscalizadora" value="{{ $data->valespagoda }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Monto cheques&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="CheckAmtFiscalizadora" value="{{ $data->CheckAmt }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Loteria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="LotoAmtFiscalizadora" value="{{ $data->LotoAmt }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Tarjeta Vale&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="CardValeFiscalizadora" value="" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Visa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="CardVisaFiscalizadora" value="" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Master&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="CardMasterFiscalizadora" value="" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">American Express&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="CardAEFiscalizadora" value="" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Sencillo&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-sm-7 col-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="CashAmtFiscalizadora" value="{{ $data->CashAmt }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Rollos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="m-0 p-0 col-7 col-sm-7 col-md-7 col-lg-7" style=""><input name="CoinRollFiscalizadora" value="{{ $data->CoinRoll }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Facturas&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-md-7 col-sm-7 col-lg-7 m-0 p-0" style=""><input name="InvoiceAmtFiscalizadora" value="{{ $data->InvoiceAmt }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vale digital&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="VoucherAmtFiscalizadora" value="{{ $data->VoucherAmt }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Beca Digital&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="GrantAmtFiscalizadora" value="{{ $data->GrantAmt }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-light">
                        <div class="card-body p-1">
                            <div class="row m-0 p-0">
                                <div class="m-0 p-0 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Monto contado</h4>
                                </div>
                                <div class="text-right m-0 p-0 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <b>{{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100+$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</b> </h5>
                                </div>
                            </div>
                            <h6 class="mb-0 text-right">Subtotal = {{ $data->BeginningBalance+$data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100+$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</b></h6>
                            <h6 class="mb-0 text-right">Monto X = <b>{{ $data->XAmt }}</b></h6>
                            <h6 class="mb-0 text-right">Diferencia = <b>{{ $data->DifferenceAmt }}</b></h6>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Total Panaderia</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <input name="totalPanaderiaFiscalizadora" value="" type="number" class="w-100 text-right" placeholder=""> </h5>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Total Pagatodo</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <input name="totalPagatodoFiscalizadora" value="" type="number" class="w-100 text-right" placeholder=""> </h5>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Total Super</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <input name="totalsuperFiscalizadora" value="" type="number" class="w-100 text-right" placeholder=""> </h5>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Dinero de Taxi</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <input name="dineroTaxiFiscalizadora" value="" type="number" class="w-100 text-right" placeholder=""> </h5>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Vuelto de mercado</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <input name="vueltoMercadoFiscalizadora" value="" type="number" class="w-100 text-right" placeholder=""> </h5>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Comentarios</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <textarea name="comentariosFiscalizadora"  class="w-100 text-right" placeholder=""> </textarea></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-0 col-4 col-sm-4 col-md-4 col-lg-4 m-0" style="">
                    <div class="card bg-light w-100">
                        <div class="card-header">Gerente</div>
                        <div class="card-body p-1">
                            <div class="row m-0 p-0">
                                <div class="col-8 col-md-6 m-0 p-0" style="">
                                    <h4 class="mb-0">Efectivo</h4>
                                </div>
                                <div class="col-4 text-right col-md-5 m-0 p-0" style="">
                                    <h5 class="mb-0"> <b>{{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100 }}</b> </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9 my-1">$1x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input name="num1g" value="{{ $data->x_oneamt }}" type="number" class="text-left w-25 " placeholder="" onchange="cal()" onkeyup="cal()" />
                                    &nbsp;={{ $data->x_oneamt*1 }}&nbsp;
                                    <input type="hidden" name="num11g" value="{{ $data->x_oneamt }}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col-3 my-1" style="">
                                    <input type="hidden" name="res1g" value="0" readonly="readonly" />
                                    <p id="demo1g" class="text-success">0</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9 my-1" style="">$5x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input name="num5g" value="{{ $data->x_fiveamt}}" type="number" class="text-left w-25 " placeholder="" onchange="cal()" onkeyup="cal()">
                                    &nbsp;={{ $data->x_fiveamt*5}}&nbsp;
                                    <input type="hidden" name="num55g" value="{{ $data->x_fiveamt}}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col-3 my-1" style="">
                                    <input type="hidden" name="res5g" value="0" readonly="readonly" />
                                    <p id="demo5g" class="text-success">0</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9 my-1">$10x&nbsp;&nbsp;&nbsp;
                                    <input name="num10g" value="{{ $data->x_tenamt }}" type="number" class="text-left  w-25 " placeholder="" onchange="cal()" onkeyup="cal()">
                                    &nbsp;={{ $data->x_tenamt*10 }}
                                    <input type="hidden" name="num1010g" value="{{ $data->x_tenamt }}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col-3 my-1" style="">
                                    <input type="hidden" name="res10g" value="0" readonly="readonly" />
                                    <p id="demo10g" class="text-success">0</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9 my-1">$20x&nbsp;&nbsp;&nbsp;
                                    <input name="num20g" value="{{ $data->x_twentyamt }}" type="number" class="text-left  w-25 " placeholder="" onchange="cal()" onkeyup="cal()">
                                    &nbsp;={{ $data->x_twentyamt*20 }}
                                    <input type="hidden" name="num2020g" value="{{ $data->x_twentyamt }}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col-3 my-1" style="">
                                    <input type="hidden" name="res20g" value="0" readonly="readonly" />
                                    <p id="demo20g" class="text-success">0</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-9 my-1">$50x&nbsp;&nbsp;&nbsp;
                                    <input name="num50g" value="{{ $data->x_fiftyamt }}" type="number" class="text-left  w-25 " placeholder="" onchange="cal()" onkeyup="cal()">
                                    &nbsp;={{ $data->x_fiftyamt*50 }}
                                    <input type="hidden" name="num5050g" value="{{ $data->x_fiftyamt }}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col-3 my-1" style="">
                                    <input type="hidden" name="res50g" value="0" readonly="readonly" />
                                    <p id="demo50g" class="text-success">0</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9 my-1">$100x&nbsp;
                                    <input name="num100g" value="{{ $data->x_hundredamt }}" type="number" class="text-left  w-25 " placeholder="" onchange="cal()" onkeyup="cal()">
                                    &nbsp;={{ $data->x_hundredamt*100 }}
                                    <input type="hidden" name="num100100g" value="{{ $data->x_hundredamt }}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col-3 my-1" style="">
                                    <input type="hidden" name="res100g" value="0" readonly="readonly" />
                                    <p id="demo100g" class="text-success">0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-light">
                        <div class="card-body p-1">
                            <div class="row m-0 p-0">
                                <div class="col-6 m-0 p-0">
                                    <h4 class="mb-0">Otros</h4>
                                </div>
                                <div class="col-6 text-right m-0 p-0">
                                    <h5 class="mb-0"> <b>{{ $data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</b> </h5>
                                </div>
                            </div>
                            <div class="row p-0 my-1 m-0">
                                <div class="p-0 col-sm-5 col-md-5 col-lg-5 col-5 m-0" style="">Yappy&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="m-0 p-0 col-sm-7 col-md-7 col-lg-7 col-7" style=""><input name="yappyGerente" value="{{ $data->yappy }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Otros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="otrosGerente" value="{{ $data->otros }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Vales Pagoda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="valespagodaGerente" value="{{ $data->valespagoda }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Monto cheques&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="CheckAmtGerente" value="{{ $data->CheckAmt }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Loteria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="LotoAmtGerente" value="{{ $data->LotoAmt }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Tarjeta Vale&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="CardValeGerente" value="" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Visa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="CardVisaGerente" value="" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Master&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="CardMasterGerente" value="" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">American Express&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="CardAEGerente" value="" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Sencillo&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-sm-7 col-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="CashAmtGerente" value="{{ $data->CashAmt }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Rollos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="m-0 p-0 col-7 col-sm-7 col-md-7 col-lg-7" style=""><input name="CoinRollGerente" value="{{ $data->CoinRoll }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Facturas&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-md-7 col-sm-7 col-lg-7 m-0 p-0" style=""><input name="InvoiceAmtGerente" value="{{ $data->InvoiceAmt }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vale digital&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="VoucherAmtGerente" value="{{ $data->VoucherAmt }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Beca Digital&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="GrantAmtGerente" value="{{ $data->GrantAmt }}" type="number" class="w-100 text-right" placeholder=""></div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-light">
                        <div class="card-body p-1">
                            <div class="row m-0 p-0">
                                <div class="m-0 p-0 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Monto contado</h4>
                                </div>
                                <div class="text-right m-0 p-0 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <b>{{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100+$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</b> </h5>
                                </div>
                            </div>
                            <h6 class="mb-0 text-right">Subtotal = {{ $data->BeginningBalance+$data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100+$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</b></h6>
                            <h6 class="mb-0 text-right">Monto X = <b>{{ $data->XAmt }}</b></h6>
                            <h6 class="mb-0 text-right">Diferencia = <b>{{ $data->DifferenceAmt }}</b></h6>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Total Panaderia</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <input name="totalPanaderiaGerente" value="" type="number" class="w-100 text-right" placeholder=""> </h5>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Total Pagatodo</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <input name="totalPagatodoGerente" value="" type="number" class="w-100 text-right" placeholder=""> </h5>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Total Super</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <input name="totalsuperGerente" value="" type="number" class="w-100 text-right" placeholder=""> </h5>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Dinero de Taxi</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <input name="dineroTaxiGerente" value="" type="number" class="w-100 text-right" placeholder=""> </h5>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Vuelto de mercado</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <input name="vueltoMercadoGerente" value="" type="number" class="w-100 text-right" placeholder=""> </h5>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Comentarios</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <textarea name="comentariosGerente"  class="w-100 text-right" placeholder=""> </textarea></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-12 m-1" style="">
                <label for="formFileMultiple" class="form-label">Por favor adjunte los reportes z</label>
                <input class="form-control" type="file" id="formFileMultiple" multiple="">
            </div>
        </div>
        
    </div>
    @endif
    @endsection
    <script>
        function cal() {
            try {
                var r1 = parseInt(document.closecash_store.num1.value),
                    r11 = parseInt(document.closecash_store.num11.value);
                var r5 = parseInt(document.closecash_store.num5.value),
                    r55 = parseInt(document.closecash_store.num55.value);
                var r10 = parseInt(document.closecash_store.num10.value),
                    r1010 = parseInt(document.closecash_store.num1010.value);
                var r20 = parseInt(document.closecash_store.num20.value),
                    r2020 = parseInt(document.closecash_store.num2020.value);
                var r50 = parseInt(document.closecash_store.num50.value),
                    r5050 = parseInt(document.closecash_store.num5050.value);
                var r100 = parseInt(document.closecash_store.num100.value),
                    r100100 = parseInt(document.closecash_store.num100100.value);

                document.getElementById("demo1").innerHTML = document.closecash_store.res1.value = r1 - r11;
                document.getElementById("demo5").innerHTML = document.closecash_store.res5.value = r5 - r55;
                document.getElementById("demo10").innerHTML = document.closecash_store.res10.value = r10 - r1010;
                document.getElementById("demo20").innerHTML = document.closecash_store.res20.value = r20 - r2020;
                document.getElementById("demo50").innerHTML = document.closecash_store.res50.value = r50 - r5050;
                document.getElementById("demo100").innerHTML = document.closecash_store.res100.value = r100 - r100100;

                const cambio1 = document.getElementById("demo1");
                const cambio5 = document.getElementById("demo5");
                const cambio10 = document.getElementById("demo10");
                const cambio20 = document.getElementById("demo20");
                const cambio50 = document.getElementById("demo50");
                const cambio100 = document.getElementById("demo100");

                if (document.getElementById("demo1").innerHTML <= -1) {
                    cambio1.classList.replace("text-success", "text-danger");
                } else {
                    cambio1.classList.replace("text-success", "text-success");
                    cambio1.classList.replace("text-danger", "text-success");
                }

                if (document.getElementById("demo5").innerHTML <= -1) {
                    cambio5.classList.replace("text-success", "text-danger");
                } else {
                    cambio5.classList.replace("text-success", "text-success");
                    cambio5.classList.replace("text-danger", "text-success");
                }

                if (document.getElementById("demo10").innerHTML <= -1) {
                    cambio10.classList.replace("text-success", "text-danger");
                } else {
                    cambio10.classList.replace("text-success", "text-success");
                    cambio10.classList.replace("text-danger", "text-success");
                }

                if (document.getElementById("demo20").innerHTML <= -1) {
                    cambio20.classList.replace("text-success", "text-danger");
                } else {
                    cambio20.classList.replace("text-success", "text-success");
                    cambio20.classList.replace("text-danger", "text-success");
                }

                if (document.getElementById("demo50").innerHTML <= -1) {
                    cambio50.classList.replace("text-success", "text-danger");
                } else {
                    cambio50.classList.replace("text-success", "text-success");
                    cambio50.classList.replace("text-danger", "text-success");
                }

                if (document.getElementById("demo100").innerHTML <= -1) {
                    cambio100.classList.replace("text-success", "text-danger");
                } else {
                    cambio100.classList.replace("text-success", "text-success");
                    cambio100.classList.replace("text-danger", "text-success");
                }

                var r1g = parseInt(document.closecash_store.num1g.value),
                    r11g = parseInt(document.closecash_store.num11g.value);
                var r5g = parseInt(document.closecash_store.num5g.value),
                    r55g = parseInt(document.closecash_store.num55g.value);
                var r10g = parseInt(document.closecash_store.num10g.value),
                    r1010g = parseInt(document.closecash_store.num1010g.value);
                var r20g = parseInt(document.closecash_store.num20g.value),
                    r2020g = parseInt(document.closecash_store.num2020g.value);
                var r50g = parseInt(document.closecash_store.num50g.value),
                    r5050g = parseInt(document.closecash_store.num5050g.value);
                var r100g = parseInt(document.closecash_store.num100g.value),
                    r100100g = parseInt(document.closecash_store.num100100g.value);

                document.getElementById("demo1g").innerHTML = document.closecash_store.res1g.value = r1g - r11g;
                document.getElementById("demo5g").innerHTML = document.closecash_store.res5g.value = r5g - r55g;
                document.getElementById("demo10g").innerHTML = document.closecash_store.res10g.value = r10g - r1010g;
                document.getElementById("demo20g").innerHTML = document.closecash_store.res20g.value = r20g - r2020g;
                document.getElementById("demo50g").innerHTML = document.closecash_store.res50g.value = r50g - r5050g;
                document.getElementById("demo100g").innerHTML = document.closecash_store.res100g.value = r100g - r100100g;

                const cambio1g = document.getElementById("demo1g");
                const cambio5g = document.getElementById("demo5g");
                const cambio10g = document.getElementById("demo10g");
                const cambio20g = document.getElementById("demo20g");
                const cambio50g = document.getElementById("demo50g");
                const cambio100g = document.getElementById("demo100g");

                if (document.getElementById("demo1g").innerHTML <= -1) {
                    cambio1g.classList.replace("text-success", "text-danger");
                } else {
                    cambio1g.classList.replace("text-success", "text-success");
                    cambio1g.classList.replace("text-danger", "text-success");
                }

                if (document.getElementById("demo5g").innerHTML <= -1) {
                    cambio5g.classList.replace("text-success", "text-danger");
                } else {
                    cambio5g.classList.replace("text-success", "text-success");
                    cambio5g.classList.replace("text-danger", "text-success");
                }

                if (document.getElementById("demo10g").innerHTML <= -1) {
                    cambio10g.classList.replace("text-success", "text-danger");
                } else {
                    cambio10g.classList.replace("text-success", "text-success");
                    cambio10g.classList.replace("text-danger", "text-success");
                }

                if (document.getElementById("demo20g").innerHTML <= -1) {
                    cambio20g.classList.replace("text-success", "text-danger");
                } else {
                    cambio20g.classList.replace("text-success", "text-success");
                    cambio20g.classList.replace("text-danger", "text-success");
                }

                if (document.getElementById("demo50g").innerHTML <= -1) {
                    cambio50g.classList.replace("text-success", "text-danger");
                } else {
                    cambio50g.classList.replace("text-success", "text-success");
                    cambio50g.classList.replace("text-danger", "text-success");
                }

                if (document.getElementById("demo100g").innerHTML <= -1) {
                    cambio100g.classList.replace("text-success", "text-danger");
                } else {
                    cambio100g.classList.replace("text-success", "text-success");
                    cambio100g.classList.replace("text-danger", "text-success");
                }
            } catch (e) {}
        }
    </script>