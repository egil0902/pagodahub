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
                <div class="p-0 col-4 col-sm-4 col-md-4 col-lg-4 m-0">
                    <div class="card bg-light w-100">
                        <div class="card-header">Monto sistema</div>
                        <div class="card-body p-1">
                            <div class="row m-0 p-0">
                                <div class="col-8 col-md-6 m-0 p-0">
                                    <h4 class="mb-0">Efectivo</h4>
                                </div>
                                <div class="col-4 text-right col-md-5 m-0 p-0">
                                    <h5 class="mb-0"> <b>{{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100 }}</b> </h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-9 my-1">$1x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input  name="x_oneamtSistema"      value="{{ $data->x_oneamt }}" type="number" style="width:40%;"readonly class="text-left"  placeholder="">
                                    &nbsp;= {{ $data->x_oneamt*1 }}</div>
                                <div class="col-3 my-1">
                                    <p class="text-success"><br></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9 my-1">$5x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input  name="x_fiveamtSistema"     value="{{ $data->x_fiveamt }}"  type="number" style="width:40%;" readonly class="text-left"  placeholder="">
                                    &nbsp;= {{ $data->x_fiveamt*5 }}
                                </div>
                                <div class="col-3 my-1">
                                    <p class="text-success"><br></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9 my-1">$10x&nbsp;&nbsp;&nbsp;
                                    <input  name="x_tenamtSistema"      value="{{ $data->x_tenamt }}"  type="number" style="width:40%;" readonly class="text-left"  placeholder="">
                                    &nbsp;= {{ $data->x_tenamt*10 }}
                                </div>
                                <div class="col-3 my-1">
                                    <p class="text-success"><br></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9 my-1">$20x&nbsp;&nbsp;&nbsp;
                                    <input  name="x_twentyamtSistema"   value="{{ $data->x_twentyamt }}"  type="number" style="width:40%;" readonly class="text-left"  placeholder="">
                                    &nbsp;= {{ $data->x_twentyamt*20 }}
                                </div>
                                <div class="col-3 my-1">
                                    <p class="text-success"><br></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9 my-1">$50x&nbsp;&nbsp;&nbsp;
                                    <input  name="x_fiftyamtSistema"    value="{{ $data->x_fiftyamt }}"  type="number" style="width:40%;" readonly class="text-left"  placeholder="">
                                    &nbsp;= {{ $data->x_fiftyamt*50 }}
                                </div>
                                <div class="col-3 my-1">
                                    <p class="text-success"><br></p>
                                </div>
                            </div>
                            <div class="row">
                                 <div class="col-9 my-1">$100x&nbsp;
                                    <input name="x_hundredamtSistema" value="{{ $data->x_hundredamt }}"  type="number" style="width:40%;" readonly class="text-left"  placeholder="">
                                    &nbsp;= {{ $data->x_hundredamt*100 }}
                                </div>
                                <div class="col-3 my-1">
                                    <p class="text-success"><br></p>
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
                                <div class="p-0 col-sm-5 col-md-5 col-lg-5 col-5 m-0">Yappy&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="m-0 p-0 col-sm-7 col-md-7 col-lg-7 col-7">
                                    <input name="yappySistema" value="{{ $data->yappy }}"  type="number"   step="0.01" readonly class="w-100 text-right" placeholder="">
                                </div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5">Otros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7">
                                    <input name="otrosSistema" value="{{ $data->otros }}"  type="number"   step="0.01" readonly class="w-100 text-right" placeholder="">
                                </div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5">Vales Pagoda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7">
                                    <input name="valespagodaSistema" value="{{ $data->valespagoda }}" type="number" step="0.01" readonly class="w-100 text-right" placeholder="">
                                </div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5">Monto cheques&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7">
                                    <input name="CheckAmtSistema" value="{{ $data->CheckAmt }}"type="number" step="0.01" readonly class="w-100 text-right" placeholder="">
                                </div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0">Loteria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0">
                                    <input name="LotoAmtSistema" value="{{ $data->LotoAmt }}" type="number" step="0.01" readonly class="w-100 text-right" placeholder="">
                                </div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0">Tarjetas&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="m-0 col-7 col-sm-7 col-md-7 col-lg-7 p-0">
                                    <input name="CardAmtSistema" value="{{ $data->CardAmt }}" type="number" step="0.01" readonly class="w-100 text-right" placeholder="">
                            </div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0">Sencillo&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-sm-7 col-7 col-md-7 col-lg-7 m-0 p-0">
                                    <input name="CashAmtSistema" value="{{ $data->CashAmt }}" type="number" step="0.01" readonly class="w-100 text-right" placeholder="">
                            </div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0">Rollos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="m-0 p-0 col-7 col-sm-7 col-md-7 col-lg-7">
                                    <input name="CoinRollSistema" value="{{ $data->CoinRoll }}" type="number" step="0.01" readonly class="w-100 text-right" placeholder="">
                            </div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0">Facturas&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-md-7 col-sm-7 col-lg-7 m-0 p-0">
                                    <input name="InvoiceAmtSistema" value="{{ $data->InvoiceAmt }}" type="number"   step="0.01" readonly class="w-100 text-right" placeholder="">
                            </div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0">Vale digital&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0">
                                    <input name="VoucherAmtSistema" value="{{ $data->VoucherAmt }}" type="number"   step="0.01" readonly class="w-100 text-right" placeholder="">
                            </div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0">Beca Digital&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0">
                                    <input name="GrantAmtSistema" value="{{ $data->GrantAmt }}" type="number"   step="0.01" readonly class="w-100 text-right" placeholder="">
                            </div>
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
                            <h6 class="mb-0 text-right">Subtotal &nbsp;&nbsp;&nbsp;= {{ $data->BeginningBalance+$data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100+$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</b></h6>
                            <h6 class="mb-0 text-right">Monto X &nbsp;&nbsp;&nbsp;= <b>{{ $data->XAmt }}</b></h6>
                            <h6 class="mb-0 text-right">Diferencia = <b>{{ $data->DifferenceAmt }}</b></h6>
                        </div>
                    </div>
                </div>
                <div class="p-0 col-4 col-sm-4 col-md-4 col-lg-4 m-0">
                    <div class="card bg-light w-100">
                        <div class="card-header">Fiscalizadora</div>
                        <div class="card-body p-1">
                            <div class="row m-0 p-0">
                                <div class="col-8 col-md-6 m-0 p-0">
                                    <h4 class="mb-0">Efectivo</h4>
                                </div>
                                <div class="col-4 text-right col-md-5 m-0 p-0">
                                    <p class="mb-0" id="Fiscalizadora_t">{{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100 }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">$1x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input name="x_oneamtFiscalizadora" value="{{ $data->x_oneamt }}" type="number" style="width:40%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()"/>
                                    <input type="hidden" name="fis1" value="{{ $data->x_oneamt }}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col">
                                    <p id="x_oneamtFiscalizadora_t" >{{ $data->x_oneamt*1 }}</p> 
                                </div>
                                <div class="col">
                                    <p id="x_oneamtFiscalizadora_r" class="text-success">0.00</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 my-1">$5x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input name="x_fiveamtFiscalizadora" value="{{ $data->x_fiveamt}}" type="number" style="width:40%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()">
                                    
                                    <input type="hidden" name="fis5" value="{{ $data->x_fiveamt}}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col">
                                    <p id="x_fiveamtFiscalizadora_t" >{{ $data->x_fiveamt*5}}</p> 
                                </div>
                                <div class="col">
                                    <p id="x_fiveamtFiscalizadora_r" class="text-success">0.00</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 my-1">$10x&nbsp;&nbsp;&nbsp;
                                    <input name="x_tenamtFiscalizadora" value="{{ $data->x_tenamt }}" type="number" style="width:40%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()">
                                    <input type="hidden" name="fis10" value="{{ $data->x_tenamt }}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col">
                                    <p id="x_tenamtFiscalizadora_t" >{{ $data->x_tenamt*10 }}</p> 
                                </div>
                                <div class="col">
                                <p id="x_tenamtFiscalizadora_r" class="text-success">0.00</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 my-1">$20x&nbsp;&nbsp;&nbsp;
                                    <input name="x_twentyamtFiscalizadora" value="{{ $data->x_twentyamt }}" type="number" style="width:40%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()">
                                    <input type="hidden" name="fis20" value="{{ $data->x_twentyamt }}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col">
                                    <p id="x_twentyamtFiscalizadora_t" >{{ $data->x_twentyamt*20 }}</p> 
                                </div>
                                <div class="col">
                                    <p id="x_twentyamtFiscalizadora_r" class="text-success">0.00</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 my-1">$50x&nbsp;&nbsp;&nbsp;
                                    <input name="x_fiftyamtFiscalizadora" value="{{ $data->x_fiftyamt }}" type="number" style="width:40%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()">
                                    <input type="hidden" name="fis50" value="{{ $data->x_fiftyamt }}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col">
                                    <p id="x_fiftyamtFiscalizadora_t" >{{ $data->x_fiftyamt*50 }}</p> 
                                </div>
                                <div class="col">
                                    <p id="x_fiftyamtFiscalizadora_r" class="text-success">0.00</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 my-1">$100x&nbsp;
                                    <input name="x_hundredamtFiscalizadora" value="{{ $data->x_hundredamt }}" type="number" style="width:40%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()">
                                    <input type="hidden" name="fis100" value="{{ $data->x_hundredamt }}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col">
                                    <p id="x_hundredamtFiscalizadora_t" >{{ $data->x_hundredamt*100 }}</p> 
                                </div>
                                <div class="col">
                                    <p id="x_hundredamtFiscalizadora_r" class="text-success">0.00</p>
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
                                <div class="p-0 col-sm-5 col-md-5 col-lg-5 col-5 m-0">Yappy&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="m-0 p-0 col-sm-7 col-md-7 col-lg-7 col-7"><input name="yappyFiscalizadora" value="{{ $data->yappy }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5">Otros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7"><input name="otrosFiscalizadora" value="{{ $data->otros }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5">Vales Pagoda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7"><input name="valespagodaFiscalizadora" value="{{ $data->valespagoda }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5">Monto cheques&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7"><input name="CheckAmtFiscalizadora" value="{{ $data->CheckAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0">Loteria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0"><input name="LotoAmtFiscalizadora" value="{{ $data->LotoAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0">Tarjeta Vale&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0"><input name="CardValeFiscalizadora" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0">Visa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0"><input name="CardVisaFiscalizadora" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0">Master&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0"><input name="CardMasterFiscalizadora" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0">American Express&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0"><input name="CardAEFiscalizadora" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0">Sencillo&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-sm-7 col-7 col-md-7 col-lg-7 m-0 p-0"><input name="CashAmtFiscalizadora" value="{{ $data->CashAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0">Rollos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="m-0 p-0 col-7 col-sm-7 col-md-7 col-lg-7"><input name="CoinRollFiscalizadora" value="{{ $data->CoinRoll }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0">Facturas&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-md-7 col-sm-7 col-lg-7 m-0 p-0"><input name="InvoiceAmtFiscalizadora" value="{{ $data->InvoiceAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0">Vale digital&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0"><input name="VoucherAmtFiscalizadora" value="{{ $data->VoucherAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0">Beca Digital&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0"><input name="GrantAmtFiscalizadora" value="{{ $data->GrantAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
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
                                    <h5 class="mb-0"> <input name="totalPanaderiaFiscalizadora" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder=""> </h5>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Total Pagatodo</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <input name="totalPagatodoFiscalizadora" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder=""> </h5>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Total Super</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <input name="totalsuperFiscalizadora" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder=""> </h5>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Dinero de Taxi</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <input name="dineroTaxiFiscalizadora" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder=""> </h5>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Vuelto de mercado</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <input name="vueltoMercadoFiscalizadora" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder=""> </h5>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Comentarios</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <textarea name="comentariosFiscalizadora"  value="0" class="w-100 text-right" placeholder="Comentarios"></textarea></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-0 col-4 col-sm-4 col-md-4 col-lg-4 m-0">
                    <div class="card bg-light w-100">
                        <div class="card-header">Gerente</div>
                        <div class="card-body p-1">
                            <div class="row m-0 p-0">
                                <div class="col-8 col-md-6 m-0 p-0">
                                    <h4 class="mb-0">Efectivo</h4>
                                </div>
                                <div class="col-4 text-right col-md-5 m-0 p-0">
                                    <h5 class="mb-0"> <b>{{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100 }}</b> </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 my-1">$1x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input name="x_oneamtGerente" value="{{ $data->x_oneamt }}" type="number" style="width:40%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col">
                                    <p id="x_oneamtGerente_t" >{{ $data->x_oneamt*1 }}</p> 
                                </div>
                                <div class="col">
                                    <p id="x_oneamtGerente_r" class="text-success">0.00</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 my-1">$5x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input name="x_fiveamtGerente" value="{{ $data->x_fiveamt}}" type="number" style="width:40%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()">
                                    <input type="hidden" name="res5g" value="0" readonly="readonly" />
                                </div>
                                <div class="col">
                                    <p id="x_fiveamtGerente_t" >{{ $data->x_fiveamt*5}}</p> 
                                </div>
                                <div class="col">
                                    <p id="x_fiveamtGerente_r" class="text-success">0.00</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 my-1">$10x&nbsp;&nbsp;&nbsp;
                                    <input name="x_tenamtGerente" value="{{ $data->x_tenamt }}" type="number" style="width:40%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()">
                                    <input type="hidden" name="res10g" value="0" readonly="readonly" />
                                </div>
                                <div class="col">
                                    <p id="x_tenamtGerente_t" >{{ $data->x_tenamt*10 }}</p> 
                                </div>
                                <div class="col">
                                    <p id="x_tenamtGerente_r" class="text-success">0.00</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 my-1">$20x&nbsp;&nbsp;&nbsp;
                                    <input name="x_twentyamtGerente" value="{{ $data->x_twentyamt }}" type="number" style="width:40%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()">
                                    <input type="hidden" name="res20g" value="0" readonly="readonly" />
                                </div>
                                <div class="col">
                                    <p id="x_twentyamtGerente_t" >{{ $data->x_twentyamt*20 }}</p> 
                                </div>
                                <div class="col">
                                    
                                    <p id="x_twentyamtGerente_r" class="text-success">0.00</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 my-1">$50x&nbsp;&nbsp;&nbsp;
                                    <input name="x_fiftyamtGerente" value="{{ $data->x_fiftyamt }}" type="number" style="width:40%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()">
                                    <input type="hidden" name="res50g" value="0" readonly="readonly" />
                                </div>
                                <div class="col">
                                    <p id="x_fiftyamtGerente_t" >{{ $data->x_fiftyamt*50 }}</p> 
                                </div>
                                <div class="col">
                                    <p id="x_fiftyamtGerente_r" class="text-success">0.00</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 my-1">$100x&nbsp;
                                    <input name="x_hundredamtGerente" value="{{ $data->x_hundredamt }}" type="number" style="width:40%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()">
                                    <input type="hidden" name="res100g" value="0" readonly="readonly" />
                                </div>
                                <div class="col">
                                    <p id="x_hundredamtGerente_t" >{{ $data->x_hundredamt*100 }}</p> 
                                </div>
                                <div class="col">
                                    
                                    <p id="x_hundredamtGerente_r" class="text-success">0.00</p>
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
                                <div class="p-0 col-sm-5 col-md-5 col-lg-5 col-5 m-0">Yappy&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="m-0 p-0 col-sm-7 col-md-7 col-lg-7 col-7"><input name="yappyGerente" value="{{ $data->yappy }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5">Otros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7"><input name="otrosGerente" value="{{ $data->otros }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" >Vales Pagoda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" ><input name="valespagodaGerente" value="{{ $data->valespagoda }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" >Monto cheques&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" ><input name="CheckAmtGerente" value="{{ $data->CheckAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" >Loteria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" ><input name="LotoAmtGerente" value="{{ $data->LotoAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" >Tarjeta Vale&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" ><input name="CardValeGerente" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" >Visa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" ><input name="CardVisaGerente" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" >Master&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" ><input name="CardMasterGerente" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" >American Express&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" ><input name="CardAEGerente" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" >Sencillo&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-sm-7 col-7 col-md-7 col-lg-7 m-0 p-0" ><input name="CashAmtGerente" value="{{ $data->CashAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" >Rollos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="m-0 p-0 col-7 col-sm-7 col-md-7 col-lg-7" ><input name="CoinRollGerente" value="{{ $data->CoinRoll }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" >Facturas&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-md-7 col-sm-7 col-lg-7 m-0 p-0" ><input name="InvoiceAmtGerente" value="{{ $data->InvoiceAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" >Vale digital&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" ><input name="VoucherAmtGerente" value="{{ $data->VoucherAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" >Beca Digital&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" ><input name="GrantAmtGerente" value="{{ $data->GrantAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""></div>
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
                                    <h5 class="mb-0"> <input name="totalPanaderiaGerente" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder=""> </h5>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Total Pagatodo</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <input name="totalPagatodoGerente" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder=""> </h5>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Total Super</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <input name="totalsuperGerente" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder=""> </h5>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Dinero de Taxi</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <input name="dineroTaxiGerente" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder=""> </h5>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Vuelto de mercado</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <input name="vueltoMercadoGerente" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder=""> </h5>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h4 class="mb-0">Comentarios</h4>
                                </div>
                                <div class="text-right m-0 p-1 col-6 col-sm-6 col-md-6 col-lg-6">
                                    <h5 class="mb-0"> <textarea name="comentariosGerente"  value="0" class="w-100 text-right" placeholder="Comentarios"></textarea></h5>
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
            <div class="col-md-12 m-1">
                <label for="formFileMultiple" class="form-label">Por favor adjunte los reportes z</label>
                <input class="form-control" type="file" id="formFileMultiple" multiple="">
            </div>
        </div>
        
    </div>
    <div class="container">
        <div style="height: 100px;" class="row ">
            <div class="h-100 col-md-12 d-flex align-items-center p-1 text-center">
                <button type="submit" class="btn btn-primary mh-100" style="width: 200px; height: 100px;">Guardar</button>
            </div>
        </div>
    </div>
    @endif
    @endsection
    <script>
        function cal() {
            try {
                var r1      = (document.closecash_store.x_oneamtFiscalizadora.value)    -(document.closecash_store.fis1.value);
                var rg1     = (document.closecash_store.x_oneamtGerente.value)    -(document.closecash_store.x_oneamtFiscalizadora.value);
                
                var r5      = (document.closecash_store.x_fiveamtFiscalizadora.value)   -(document.closecash_store.fis5.value);
                var rg5      = (document.closecash_store.x_fiveamtGerente.value)   -(document.closecash_store.x_fiveamtFiscalizadora.value);
                
                var r10     = (document.closecash_store.x_tenamtFiscalizadora.value)    -(document.closecash_store.fis10.value);
                var rg10     = (document.closecash_store.x_tenamtGerente.value)    -(document.closecash_store.x_tenamtFiscalizadora.value);
                
                var r20     = (document.closecash_store.x_twentyamtFiscalizadora.value) -(document.closecash_store.fis20.value);
                var rg20     = (document.closecash_store.x_twentyamtGerente.value) -(document.closecash_store.x_twentyamtFiscalizadora.value);
                
                var r50     = (document.closecash_store.x_fiftyamtFiscalizadora.value)  -(document.closecash_store.fis50.value);
                var rg50     = (document.closecash_store.x_fiftyamtGerente.value)  -(document.closecash_store.x_fiftyamtFiscalizadora.value);
                
                var r100    = (document.closecash_store.x_hundredamtFiscalizadora.value)-(document.closecash_store.fis100.value);
                var rg100    = (document.closecash_store.x_hundredamtGerente.value)-(document.closecash_store.x_hundredamtFiscalizadora.value);

                

                document.getElementById("x_oneamtFiscalizadora_r").innerHTML = parseFloat(r1).toFixed(2);
                document.getElementById("x_oneamtFiscalizadora_t").innerHTML = (document.closecash_store.x_oneamtFiscalizadora.value);
                document.getElementById("x_oneamtGerente_r").innerHTML = parseFloat(rg1).toFixed(2);
                document.getElementById("x_oneamtGerente_t").innerHTML = (document.closecash_store.x_oneamtGerente.value);

                document.getElementById("x_fiveamtFiscalizadora_r").innerHTML =  parseFloat(r5).toFixed(2);
                document.getElementById("x_fiveamtFiscalizadora_t").innerHTML=(document.closecash_store.x_fiveamtFiscalizadora.value)*5;
                document.getElementById("x_fiveamtGerente_r").innerHTML =  parseFloat(rg5).toFixed(2);
                document.getElementById("x_fiveamtGerente_t").innerHTML = (document.closecash_store.x_fiveamtGerente.value)*5;

                document.getElementById("x_tenamtFiscalizadora_r").innerHTML =  parseFloat(r10).toFixed(2);
                document.getElementById("x_tenamtFiscalizadora_t").innerHTML=(document.closecash_store.x_tenamtFiscalizadora.value)*10;
                document.getElementById("x_tenamtGerente_r").innerHTML =  parseFloat(rg10).toFixed(2);
                document.getElementById("x_tenamtGerente_t").innerHTML =(document.closecash_store.x_tenamtGerente.value)*10;

                document.getElementById("x_twentyamtFiscalizadora_r").innerHTML =  parseFloat(r20).toFixed(2);
                document.getElementById("x_twentyamtFiscalizadora_t").innerHTML =(document.closecash_store.x_twentyamtFiscalizadora.value)*20;
                document.getElementById("x_twentyamtGerente_r").innerHTML =  parseFloat(rg20).toFixed(2);
                document.getElementById("x_twentyamtGerente_t").innerHTML = (document.closecash_store.x_twentyamtGerente.value)*20;

                document.getElementById("x_fiftyamtFiscalizadora_r").innerHTML =  parseFloat(r50).toFixed(2);
                document.getElementById("x_fiftyamtFiscalizadora_t").innerHTML =(document.closecash_store.x_fiftyamtFiscalizadora.value)*50;
                document.getElementById("x_fiftyamtGerente_r").innerHTML =  parseFloat(rg50).toFixed(2);
                document.getElementById("x_fiftyamtGerente_t").innerHTML = (document.closecash_store.x_fiftyamtGerente.value)*50;

                document.getElementById("x_hundredamtFiscalizadora_r").innerHTML =  parseFloat(r100).toFixed(2);
                document.getElementById("x_hundredamtFiscalizadora_t").innerHTML =(document.closecash_store.x_hundredamtFiscalizadora.value)*100;
                document.getElementById("x_hundredamtGerente_r").innerHTML =  parseFloat(rg100).toFixed(2);
                document.getElementById("x_hundredamtGerente_t").innerHTML =(document.closecash_store.x_hundredamtGerente.value)*100;

                const cambio1   = document.getElementById("x_oneamtFiscalizadora_r");
                const cambio5   = document.getElementById("x_fiveamtFiscalizadora_r");
                const cambio10  = document.getElementById("x_tenamtFiscalizadora_r");
                const cambio20  = document.getElementById("x_twentyamtFiscalizadora_r");
                const cambio50  = document.getElementById("x_fiftyamtFiscalizadora_r");
                const cambio100 = document.getElementById("x_hundredamtFiscalizadora_r");

                const cambio1g   = document.getElementById("x_oneamtGerente_r");
                const cambio5g   = document.getElementById("x_fiveamtGerente_r");
                const cambio10g  = document.getElementById("x_tenamtGerente_r");
                const cambio20g  = document.getElementById("x_twentyamtGerente_r");
                const cambio50g  = document.getElementById("x_fiftyamtGerente_r");
                const cambio100g = document.getElementById("x_hundredamtGerente_r");

                if (document.getElementById("x_oneamtFiscalizadora_r").innerHTML <= -0.01) {cambio1.classList.replace("text-success", "text-danger");} 
                else{cambio1.classList.replace("text-success", "text-success");cambio1.classList.replace("text-danger", "text-success");}

                if (document.getElementById("x_fiveamtFiscalizadora_r").innerHTML <= -0.01){cambio5.classList.replace("text-success", "text-danger");}
                else{cambio5.classList.replace("text-success", "text-success");cambio5.classList.replace("text-danger", "text-success");}

                if (document.getElementById("x_tenamtFiscalizadora_r").innerHTML <= -0.01){cambio10.classList.replace("text-success", "text-danger");} 
                else{cambio10.classList.replace("text-success", "text-success");cambio10.classList.replace("text-danger", "text-success");}

                if (document.getElementById("x_twentyamtFiscalizadora_r").innerHTML <= -0.01){cambio20.classList.replace("text-success", "text-danger");} 
                else{cambio20.classList.replace("text-success", "text-success");cambio20.classList.replace("text-danger", "text-success");}

                if (document.getElementById("x_fiftyamtFiscalizadora_r").innerHTML <= -0.01) {cambio50.classList.replace("text-success", "text-danger");} 
                else{cambio50.classList.replace("text-success", "text-success");cambio50.classList.replace("text-danger", "text-success");}

                if (document.getElementById("x_hundredamtFiscalizadora_r").innerHTML <= -0.01) {cambio100.classList.replace("text-success", "text-danger");} 
                else{cambio100.classList.replace("text-success", "text-success"); cambio100.classList.replace("text-danger", "text-success");}

                if (document.getElementById("x_oneamtGerente_r").innerHTML <= -0.01) {cambio1g.classList.replace("text-success", "text-danger");} 
                else{cambio1g.classList.replace("text-success", "text-success");cambio1g.classList.replace("text-danger", "text-success");}

                if (document.getElementById("x_fiveamtGerente_r").innerHTML <= -0.01){cambio5g.classList.replace("text-success", "text-danger");}
                else{cambio5g.classList.replace("text-success", "text-success");cambio5g.classList.replace("text-danger", "text-success");}

                if (document.getElementById("x_tenamtGerente_r").innerHTML <= -0.01){cambio10g.classList.replace("text-success", "text-danger");} 
                else{cambio10g.classList.replace("text-success", "text-success");cambio10g.classList.replace("text-danger", "text-success");}

                if (document.getElementById("x_twentyamtGerente_r").innerHTML <= -0.01){cambio20g.classList.replace("text-success", "text-danger");} 
                else{cambio20g.classList.replace("text-success", "text-success");cambio20g.classList.replace("text-danger", "text-success");}

                if (document.getElementById("x_fiftyamtGerente_r").innerHTML <= -0.01) {cambio50g.classList.replace("text-success", "text-danger");} 
                else{cambio50g.classList.replace("text-success", "text-success");cambio50g.classList.replace("text-danger", "text-success");}

                if (document.getElementById("x_hundredamtGerente_r").innerHTML <= -0.01) {cambio100g.classList.replace("text-success", "text-danger");} 
                else{cambio100g.classList.replace("text-success", "text-success"); cambio100g.classList.replace("text-danger", "text-success");}
                
                document.getElementById("Fiscalizadora_t").innerHTML = parseFloat(document.getElementById("x_oneamtFiscalizadora_t").innerHTML) + parseFloat(document.getElementById("x_fiveamtFiscalizadora_t").innerHTML)+parseFloat(document.getElementById("x_tenamtFiscalizadora_t").innerHTML)+parseFloat(document.getElementById("x_twentyamtFiscalizadora_t").innerHTML)+parseFloat(document.getElementById("x_fiftyamtFiscalizadora_t").innerHTML)+parseFloat(document.getElementById("x_hundredamtFiscalizadora_t").innerHTML);
            
            } catch (e) {}
        }
    </script>