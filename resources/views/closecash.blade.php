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
                                    <h5 id="Montosistema_t" class="mb-0">{{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100 }}</h5>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-6">$1x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input  name="x_oneamtSistema"      value="{{ $data->x_oneamt }}" type="number" style="width:40%;"readonly class="text-left"  placeholder="">
                                </div>
                                <div class="col">
                                    <p id="" >{{ $data->x_oneamt*1 }}</p> 
                                </div>
                                <div class="col">
                                    <p id="" class="text-success"></p>
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-6">$5x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input  name="x_fiveamtSistema"     value="{{ $data->x_fiveamt }}"  type="number" style="width:40%;" readonly class="text-left"  placeholder="">
                                </div>
                                <div class="col">
                                    <p id="" >{{ $data->x_fiveamt*5 }}</p> 
                                </div>
                                <div class="col">
                                    <p id="" class="text-success"></p>
                                </div> 
                            </div>
                            
                            <div class="row">
                                <div class="col-6">$10x&nbsp;&nbsp;&nbsp;
                                    <input  name="x_tenamtSistema"      value="{{ $data->x_tenamt }}"  type="number" style="width:40%;" readonly class="text-left"  placeholder="">
                                </div>
                                <div class="col">
                                    <p id="">{{ $data->x_tenamt*10 }}</p>
                                </div>
                                <div class="col">
                                    <p id=""></p>
                                </div> 

                            </div>
                            <div class="row">
                                <div class="col-6">$20x&nbsp;&nbsp;&nbsp;
                                    <input  name="x_twentyamtSistema"   value="{{ $data->x_twentyamt }}"  type="number" style="width:40%;" readonly class="text-left"  placeholder="">
                                </div>
                                <div class="col">
                                    <p>{{ $data->x_twentyamt*20 }}</p>
                                </div>
                                <div class="col">
                                    <p id=""></p>
                                </div> 


                            </div>
                            <div class="row">
                                <div class="col-6">$50x&nbsp;&nbsp;&nbsp;
                                    <input  name="x_fiftyamtSistema"    value="{{ $data->x_fiftyamt }}"  type="number" style="width:40%;" readonly class="text-left"  placeholder="">
                                </div>
                                <div class="col">
                                    <p>{{ $data->x_fiftyamt*50 }}</p>
                                </div>
                                <div class="col">
                                    <p id=""></p>
                                </div>
                            </div>

                            <div class="row">
                                 <div class="col-6 border">$100x&nbsp;
                                    <input name="x_hundredamtSistema" value="{{ $data->x_hundredamt }}"  type="number" style="width:40%;" readonly class="text-left"  placeholder="">
                                </div>
                                <div class="col">
                                    <p class="">{{ $data->x_hundredamt*100 }}</p>
                                </div>
                                <div class="col">
                                    <p id=""></p>
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
                                    <h5 class="mb-0" id="Otros">{{ $data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</h5>
                                </div>
                            </div>
                            <div class="row p-0 my-1 m-0 border">
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
                    <div class="card bg-light">
                        <div class="card-header">Fiscalizadora</div>
                        <div class="card-body p-1">
                            <div class="row m-0 p-0">
                                <div class="col-8 col-md-6 m-0 p-0">
                                    <h4 class="mb-0">Efectivo</h4>
                                </div>
                                <div class="col-4 text-right col-md-5 m-0 p-0">
                                    <h5 class="mb-0 fw-bold text-success" id="Fiscalizadora_t">{{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100 }}</h5>
                                </div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-2 border">$1x</div>
                                <div class="col-3 border">
                                    <input name="x_oneamtFiscalizadora" value="{{ $data->x_oneamt }}" type="number" style="width:100%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()"/>
                                    <input type="hidden" name="fis1" value="{{ $data->x_oneamt }}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col border" id="x_oneamtFiscalizadora_t">{{ $data->x_oneamt*1 }}</div>
                                <div class="col border text-success" id="x_oneamtFiscalizadora_r">0.00</div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-2 border">$5x</div>
                                <div class="col-3 border">
                                    <input name="x_fiveamtFiscalizadora" value="{{ $data->x_fiveamt}}" type="number" style="width:100%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()"> 
                                    <input type="hidden" name="fis5" value="{{ $data->x_fiveamt}}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                
                                <div class="col border" id="x_fiveamtFiscalizadora_t"> {{ $data->x_fiveamt*5}}</div>
                                <div class="col border text-success" id="x_fiveamtFiscalizadora_r">0.00</div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-2 border">$10x</div>
                                <div class="col-3 border">
                                    <input name="x_tenamtFiscalizadora" value="{{ $data->x_tenamt }}" type="number" style="width:100%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()">
                                    <input type="hidden" name="fis10" value="{{ $data->x_tenamt }}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col border" id="x_tenamtFiscalizadora_t">{{ $data->x_tenamt*10 }}</div>
                                <div class="col border text-success" id="x_tenamtFiscalizadora_r">0.00</div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-2 border">$20x</div>
                                <div class="col-3 border">
                                    <input name="x_twentyamtFiscalizadora" value="{{ $data->x_twentyamt }}" type="number" style="width:100%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()">
                                    <input type="hidden" name="fis20" value="{{ $data->x_twentyamt }}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col border" id="x_twentyamtFiscalizadora_t">{{ $data->x_twentyamt*20 }}</div>
                                <div class="col border text-success"  id="x_twentyamtFiscalizadora_r">0.00</div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-2 border">$50x</div>
                                <div class="col-3 border">
                                    <input name="x_fiftyamtFiscalizadora" value="{{ $data->x_fiftyamt }}" type="number" style="width:100%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()">
                                    <input type="hidden" name="fis50" value="{{ $data->x_fiftyamt }}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col border" id="x_fiftyamtFiscalizadora_t" >{{ $data->x_fiftyamt*50 }} </div>
                                <div class="col border text-success" id="x_fiftyamtFiscalizadora_r">0.00</div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-2 border">$100x</div>
                                <div class="col-3 border">
                                    <input name="x_hundredamtFiscalizadora" value="{{ $data->x_hundredamt }}" type="number" style="width:100%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()">
                                    <input type="hidden" name="fis100" value="{{ $data->x_hundredamt }}" onchange="cal()" onkeyup="cal()" />
                                </div>
                                <div class="col border" id="x_hundredamtFiscalizadora_t"> {{ $data->x_hundredamt*100 }} </div>
                                <div class="col border text-success" id="x_hundredamtFiscalizadora_r">0.00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-light">
                        <div class="card-body p-1">
                            <div class="row m-0 p-0">
                                <div class="col-6 m-0 p-0">
                                    <h4 class="mb-0">Otros Fiscalizadora</h4>
                                </div>
                                <div class="col-6 text-right m-0 p-0">
                                    <h5 class="mb-0 fw-bold text-success" id="Otros_Fiscalizadora_t">{{ $data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</h5>
                                </div>
                            </div>
                            
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Yappy</div>
                                <div class="col border"><input name="yappyFiscalizadora" value="{{ $data->yappy }}" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="yappyFiscalizadora_r">0.0</div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Otros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col border"><input name="otrosFiscalizadora" value="{{ $data->otros }}" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="otrosFiscalizadora_r" >0.0</div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Vales Pagoda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col border"><input name="valespagodaFiscalizadora" value="{{ $data->valespagoda }}" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="valespagodaFiscalizadora_r" >0.0</div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Monto cheques&nbsp;&nbsp;&nbsp;</div>
                                <div class="col border"><input name="CheckAmtFiscalizadora" value="{{ $data->CheckAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="CheckAmtFiscalizadora_r" >0.0</div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Loteria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col border"><input name="LotoAmtFiscalizadora" value="{{ $data->LotoAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="LotoAmtFiscalizadora_r">0.0</div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Tarjeta Vale&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col border"><input name="CardValeFiscalizadora" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="CardValeFiscalizadora_r">0.0</div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Visa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col border"><input name="CardVisaFiscalizadora" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="CardVisaFiscalizadora_r" >0.0</div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Master&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col border"><input name="CardMasterFiscalizadora" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="CardMasterFiscalizadora_r">0.0</div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">American Express&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col border"><input name="CardAEFiscalizadora" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="CardAEFiscalizadora_r">0.0</div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Sencillo&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col border"><input name="CashAmtFiscalizadora" value="{{ $data->CashAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="CashAmtFiscalizadora_r">0.0</div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Rollos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col border"><input name="CoinRollFiscalizadora" value="{{ $data->CoinRoll }}" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="CoinRollFiscalizadora_r">0.0</div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Facturas&nbsp;&nbsp;&nbsp;</div>
                                <div class="col border"><input name="InvoiceAmtFiscalizadora" value="{{ $data->InvoiceAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="InvoiceAmtFiscalizadora_r">0.0</div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Vale digital&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col border"><input name="VoucherAmtFiscalizadora" value="{{ $data->VoucherAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="VoucherAmtFiscalizadora_r">0.0</div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Beca Digital&nbsp;&nbsp;&nbsp;</div>
                                <div class="col border"><input name="GrantAmtFiscalizadora" value="{{ $data->GrantAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="GrantAmtFiscalizadora_r">0.0</div>
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
                                    <h5 class="mb-0" id="Monto_Fiscalizadora_t"> {{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100+$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</h5>
                                </div>
                            </div>
                            <h6 class="mb-0 text-right" >Subtotal = {{ $data->BeginningBalance+$data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100+$data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }}</b></h6>
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
                                    <h5 class="mb-0 fw-bold text-success" id="Gerente_t">{{ $data->x_oneamt*1+$data->x_fiveamt*5+$data->x_tenamt*10+$data->x_twentyamt*20+$data->x_fiftyamt*50+$data->x_hundredamt*100 }}</h5>
                                </div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-2 border">$1x</div>
                                <div class="col-3 border">
                                <input name="x_oneamtGerente" value="{{ $data->x_oneamt }}" type="number" style="width:100%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()" />
                                   
                                </div>
                                <div class="col border" id="x_oneamtGerente_t">{{ $data->x_oneamt*1 }}</div>
                                <div class="col border text-success" id="x_oneamtGerente_r">0.00</div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-2 border">$5x</div>
                                <div class="col-3 border">
                                    <input name="x_fiveamtGerente" value="{{ $data->x_fiveamt}}" type="number" style="width:100%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()">
                                   
                                </div>
                                <div class="col border" id="x_fiveamtGerente_t">{{ $data->x_fiveamt*5}}</div>
                                <div class="col border text-success" id="x_fiveamtGerente_r">0.00</div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-2 border">$10x</div>
                                <div class="col-3 border">
                                    <input name="x_tenamtGerente" value="{{ $data->x_tenamt }}" type="number" style="width:100%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()">
                                    
                                </div>
                                <div class="col border" id="x_tenamtGerente_t" >{{ $data->x_tenamt*10 }}</div>
                                <div class="col border text-success" id="x_tenamtGerente_r">0.00</div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-2 border">$20x</div>
                                <div class="col-3 border">
                                    <input name="x_twentyamtGerente" value="{{ $data->x_twentyamt }}" type="number" style="width:100%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()">
                                   
                                </div>
                                <div class="col border" id="x_twentyamtGerente_t" >{{ $data->x_twentyamt*20 }}</div>
                                <div class="col border text-success" id="x_twentyamtGerente_r">0.00</div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-2 border">$50x</div>
                                <div class="col-3 border">
                                <input name="x_fiftyamtGerente" value="{{ $data->x_fiftyamt }}" type="number" style="width:100%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()">
                                    
                                </div>
                                <div class="col border" id="x_fiftyamtGerente_t" >{{ $data->x_fiftyamt*50 }}</div>
                                <div class="col border text-success" id="x_fiftyamtGerente_r">0.00</div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-2 border">$100x</div>
                                <div class="col-3 border">
                                <input name="x_hundredamtGerente" value="{{ $data->x_hundredamt }}" type="number" style="width:100%;" class="text-left" placeholder="" onchange="cal()" onkeyup="cal()">
                                   
                                </div>
                                <div class="col border" id="x_hundredamtGerente_t" >{{ $data->x_hundredamt*100 }}</div>
                                <div class="col border text-success" id="x_hundredamtGerente_r">0.00</div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-light">
                        <div class="card-body p-1">
                            <div class="row m-0 p-0">
                                <div class="col-6 m-0 p-0">
                                    <h4 class="mb-0">Otros Gerente</h4>
                                </div>
                                <div class="col-6 text-right m-0 p-0">
                                    <h5 class="mb-0 fw-bold text-success" id="Otros_Gerente_t" >{{ $data->yappy+$data->otros+$data->valespagoda+$data->CheckAmt+$data->LotoAmt+$data->CardAmt+$data->CashAmt+$data->CoinRoll+$data->InvoiceAmt+$data->VoucherAmt+$data->GrantAmt }} </h5>
                                </div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Yappy</div>
                                <div class="col border"><input name="yappyGerente" value="{{ $data->yappy }}" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="yappyGerente_r">0.0</div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Otros</div>
                                <div class="col border"><input name="otrosGerente" value="{{ $data->otros }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="otrosGerente_r">0.0</div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Vales Pagoda</div>
                                <div class="col border"><input name="valespagodaGerente" value="{{ $data->valespagoda }}" type="number"   step="0.01" class="w-100 text-right" placeholder=""onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="valespagodaGerente_r">0.0</div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Monto cheques</div>
                                <div class="col border"><input name="CheckAmtGerente" value="{{ $data->CheckAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="CheckAmtGerente_r">0.0</div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Loteria</div>
                                <div class="col border"><input name="LotoAmtGerente" value="{{ $data->LotoAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="LotoAmtGerente_r">0.0</div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Tarjeta Vale</div>
                                <div class="col border"><input name="CardValeGerente" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="CardValeGerente_r">0.0</div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Visa</div>
                                <div class="col border"><input name="CardVisaGerente" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="CardVisaGerente_r">0.0</div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Master</div>
                                <div class="col border"><input name="CardMasterGerente" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="CardMasterGerente_r">0.0</div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">American Express</div>
                                <div class="col border"><input name="CardAEGerente" value="0" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="CardAEGerente_r">0.0</div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Sencillo</div>
                                <div class="col border"><input name="CashAmtGerente" value="{{ $data->CashAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="CashAmtGerente_r">0.0</div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Rollos</div>
                                <div class="col border"><input name="CoinRollGerente" value="{{ $data->CoinRoll }}" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="CoinRollGerente_r">0.0</div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Facturas</div>
                                <div class="col border"><input name="InvoiceAmtGerente" value="{{ $data->InvoiceAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="InvoiceAmtGerente_r">0.0</div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Vale digital</div>
                                <div class="col border"><input name="VoucherAmtGerente" value="{{ $data->VoucherAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="VoucherAmtGerente_r">0.0</div>
                            </div>

                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 border">Beca Digital</div>
                                <div class="col border"><input name="GrantAmtGerente" value="{{ $data->GrantAmt }}" type="number"   step="0.01" class="w-100 text-right" placeholder="" onchange="cal()" onkeyup="cal()"></div>
                                <div class="col border" id="GrantAmtGerente_r">0.0</div>
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
                document.getElementById("x_oneamtFiscalizadora_r").innerHTML = parseFloat((document.closecash_store.x_oneamtFiscalizadora.value)    -(document.closecash_store.fis1.value)).toFixed(2);
                document.getElementById("x_oneamtFiscalizadora_t").innerHTML = (document.closecash_store.x_oneamtFiscalizadora.value);
                document.getElementById("x_oneamtGerente_r").innerHTML = parseFloat((document.closecash_store.x_oneamtGerente.value)    -(document.closecash_store.x_oneamtFiscalizadora.value)).toFixed(2);
                document.getElementById("x_oneamtGerente_t").innerHTML = (document.closecash_store.x_oneamtGerente.value);

                document.getElementById("x_fiveamtFiscalizadora_r").innerHTML =  parseFloat((document.closecash_store.x_fiveamtFiscalizadora.value)   -(document.closecash_store.fis5.value)).toFixed(2);
                document.getElementById("x_fiveamtFiscalizadora_t").innerHTML=(document.closecash_store.x_fiveamtFiscalizadora.value)*5;
                document.getElementById("x_fiveamtGerente_r").innerHTML =  parseFloat((document.closecash_store.x_fiveamtGerente.value)   -(document.closecash_store.x_fiveamtFiscalizadora.value)).toFixed(2);
                document.getElementById("x_fiveamtGerente_t").innerHTML = (document.closecash_store.x_fiveamtGerente.value)*5;

                document.getElementById("x_tenamtFiscalizadora_r").innerHTML =  parseFloat((document.closecash_store.x_tenamtFiscalizadora.value)    -(document.closecash_store.fis10.value)).toFixed(2);
                document.getElementById("x_tenamtFiscalizadora_t").innerHTML=(document.closecash_store.x_tenamtFiscalizadora.value)*10;
                document.getElementById("x_tenamtGerente_r").innerHTML =  parseFloat((document.closecash_store.x_tenamtGerente.value)    -(document.closecash_store.x_tenamtFiscalizadora.value)).toFixed(2);
                document.getElementById("x_tenamtGerente_t").innerHTML =(document.closecash_store.x_tenamtGerente.value)*10;

                document.getElementById("x_twentyamtFiscalizadora_r").innerHTML =  parseFloat((document.closecash_store.x_twentyamtFiscalizadora.value) -(document.closecash_store.fis20.value)).toFixed(2);
                document.getElementById("x_twentyamtFiscalizadora_t").innerHTML =(document.closecash_store.x_twentyamtFiscalizadora.value)*20;
                document.getElementById("x_twentyamtGerente_r").innerHTML =  parseFloat((document.closecash_store.x_twentyamtGerente.value) -(document.closecash_store.x_twentyamtFiscalizadora.value)).toFixed(2);
                document.getElementById("x_twentyamtGerente_t").innerHTML = (document.closecash_store.x_twentyamtGerente.value)*20;

                document.getElementById("x_fiftyamtFiscalizadora_r").innerHTML =  parseFloat((document.closecash_store.x_fiftyamtFiscalizadora.value)  -(document.closecash_store.fis50.value)).toFixed(2);
                document.getElementById("x_fiftyamtFiscalizadora_t").innerHTML =(document.closecash_store.x_fiftyamtFiscalizadora.value)*50;
                document.getElementById("x_fiftyamtGerente_r").innerHTML =  parseFloat((document.closecash_store.x_fiftyamtGerente.value)  -(document.closecash_store.x_fiftyamtFiscalizadora.value)).toFixed(2);
                document.getElementById("x_fiftyamtGerente_t").innerHTML = (document.closecash_store.x_fiftyamtGerente.value)*50;

                document.getElementById("x_hundredamtFiscalizadora_r").innerHTML =  parseFloat((document.closecash_store.x_hundredamtFiscalizadora.value)-(document.closecash_store.fis100.value)).toFixed(2);
                document.getElementById("x_hundredamtFiscalizadora_t").innerHTML =(document.closecash_store.x_hundredamtFiscalizadora.value)*100;
                document.getElementById("x_hundredamtGerente_r").innerHTML =  parseFloat((document.closecash_store.x_hundredamtGerente.value)-(document.closecash_store.x_hundredamtFiscalizadora.value)).toFixed(2);
                document.getElementById("x_hundredamtGerente_t").innerHTML =(document.closecash_store.x_hundredamtGerente.value)*100;

                //Otrosf
                document.getElementById("yappyFiscalizadora_r").innerHTML =  parseFloat((document.closecash_store.yappyFiscalizadora.value)    -(document.closecash_store.yappySistema.value)).toFixed(2);
                document.getElementById("otrosFiscalizadora_r").innerHTML =  parseFloat((document.closecash_store.otrosFiscalizadora.value)    -(document.closecash_store.otrosSistema.value)).toFixed(2);
                document.getElementById("valespagodaFiscalizadora_r").innerHTML =  parseFloat((document.closecash_store.valespagodaFiscalizadora.value)    -(document.closecash_store.valespagodaSistema.value)).toFixed(2);
                document.getElementById("CheckAmtFiscalizadora_r").innerHTML =  parseFloat((document.closecash_store.CheckAmtFiscalizadora.value)    -(document.closecash_store.CheckAmtSistema.value)).toFixed(2);
                document.getElementById("LotoAmtFiscalizadora_r").innerHTML =  parseFloat((document.closecash_store.LotoAmtFiscalizadora.value)    -(document.closecash_store.LotoAmtSistema.value)).toFixed(2);
                //
                document.getElementById("CardValeFiscalizadora_r").innerHTML    =  parseFloat((document.closecash_store.CardValeFiscalizadora.value)    -(document.closecash_store.CardAmtSistema.value)).toFixed(2);
                document.getElementById("CardVisaFiscalizadora_r").innerHTML    =  parseFloat((document.closecash_store.CardVisaFiscalizadora.value)    -(document.closecash_store.CardAmtSistema.value)).toFixed(2);
                document.getElementById("CardMasterFiscalizadora_r").innerHTML  =  parseFloat((document.closecash_store.CardMasterFiscalizadora.value)  -(document.closecash_store.CardAmtSistema.value)).toFixed(2);
                document.getElementById("CardAEFiscalizadora_r").innerHTML      =  parseFloat((document.closecash_store.CardAEFiscalizadora.value)      -(document.closecash_store.CardAmtSistema.value)).toFixed(2);
                //
                document.getElementById("CashAmtFiscalizadora_r").innerHTML =  parseFloat((document.closecash_store.CashAmtFiscalizadora.value)    -(document.closecash_store.CashAmtSistema.value)).toFixed(2);
                document.getElementById("CoinRollFiscalizadora_r").innerHTML =  parseFloat((document.closecash_store.CoinRollFiscalizadora.value)    -(document.closecash_store.CoinRollSistema.value)).toFixed(2);
                document.getElementById("InvoiceAmtFiscalizadora_r").innerHTML =  parseFloat((document.closecash_store.InvoiceAmtFiscalizadora.value)    -(document.closecash_store.InvoiceAmtSistema.value)).toFixed(2);
                document.getElementById("VoucherAmtFiscalizadora_r").innerHTML =  parseFloat((document.closecash_store.VoucherAmtFiscalizadora.value)    -(document.closecash_store.VoucherAmtSistema.value)).toFixed(2);
                document.getElementById("GrantAmtFiscalizadora_r").innerHTML =  parseFloat((document.closecash_store.GrantAmtFiscalizadora.value)    -(document.closecash_store.GrantAmtSistema.value)).toFixed(2);
                
                //otrosg
                document.getElementById("yappyGerente_r").innerHTML =  parseFloat((document.closecash_store.yappyGerente.value)    -(document.closecash_store.yappyFiscalizadora.value)).toFixed(2);
                document.getElementById("otrosGerente_r").innerHTML =  parseFloat((document.closecash_store.otrosGerente.value)    -(document.closecash_store.otrosFiscalizadora.value)).toFixed(2);
                document.getElementById("valespagodaGerente_r").innerHTML =  parseFloat((document.closecash_store.valespagodaGerente.value)    -(document.closecash_store.valespagodaFiscalizadora.value)).toFixed(2);
                document.getElementById("CheckAmtGerente_r").innerHTML =  parseFloat((document.closecash_store.CheckAmtGerente.value)    -(document.closecash_store.CheckAmtFiscalizadora.value)).toFixed(2);
                document.getElementById("LotoAmtGerente_r").innerHTML =  parseFloat((document.closecash_store.LotoAmtGerente.value)    -(document.closecash_store.LotoAmtFiscalizadora.value)).toFixed(2);

                document.getElementById("CardValeGerente_r").innerHTML    =  parseFloat((document.closecash_store.CardValeFiscalizadora.value)    -(document.closecash_store.CardAmtSistema.value)).toFixed(2);
                document.getElementById("CardVisaGerente_r").innerHTML    =  parseFloat((document.closecash_store.CardVisaFiscalizadora.value)    -(document.closecash_store.CardAmtSistema.value)).toFixed(2);
                document.getElementById("CardMasterGerente_r").innerHTML  =  parseFloat((document.closecash_store.CardMasterFiscalizadora.value)  -(document.closecash_store.CardAmtSistema.value)).toFixed(2);
                document.getElementById("CardAEGerente_r").innerHTML      =  parseFloat((document.closecash_store.CardAEFiscalizadora.value)      -(document.closecash_store.CardAmtSistema.value)).toFixed(2);
                //
                document.getElementById("CashAmtGerente_r").innerHTML =  parseFloat((document.closecash_store.CashAmtGerente.value)    -(document.closecash_store.CashAmtSistema.value)).toFixed(2);
                document.getElementById("CoinRollGerente_r").innerHTML =  parseFloat((document.closecash_store.CoinRollGerente.value)    -(document.closecash_store.CoinRollSistema.value)).toFixed(2);
                document.getElementById("InvoiceAmtGerente_r").innerHTML =  parseFloat((document.closecash_store.InvoiceAmtGerente.value)    -(document.closecash_store.InvoiceAmtSistema.value)).toFixed(2);
                document.getElementById("VoucherAmtGerente_r").innerHTML =  parseFloat((document.closecash_store.VoucherAmtGerente.value)    -(document.closecash_store.VoucherAmtSistema.value)).toFixed(2);
                document.getElementById("GrantAmtGerente_r").innerHTML =  parseFloat((document.closecash_store.GrantAmtGerente.value)    -(document.closecash_store.GrantAmtSistema.value)).toFixed(2);


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
                document.getElementById("Gerente_t").innerHTML = parseFloat(document.getElementById("x_oneamtGerente_t").innerHTML) + parseFloat(document.getElementById("x_fiveamtGerente_t").innerHTML)+parseFloat(document.getElementById("x_tenamtGerente_t").innerHTML)+parseFloat(document.getElementById("x_twentyamtGerente_t").innerHTML)+parseFloat(document.getElementById("x_fiftyamtGerente_t").innerHTML)+parseFloat(document.getElementById("x_hundredamtGerente_t").innerHTML);
                document.getElementById("Otros_Fiscalizadora_t").innerHTML = parseFloat(parseFloat(document.closecash_store.yappyFiscalizadora.value)+parseFloat(document.closecash_store.otrosFiscalizadora.value)+parseFloat(document.closecash_store.valespagodaFiscalizadora.value) +parseFloat(document.closecash_store.CheckAmtFiscalizadora.value)  +parseFloat(document.closecash_store.LotoAmtFiscalizadora.value)+parseFloat(document.closecash_store.CashAmtFiscalizadora.value)+parseFloat(document.closecash_store.CoinRollFiscalizadora.value)+parseFloat(document.closecash_store.InvoiceAmtFiscalizadora.value)+parseFloat(document.closecash_store.VoucherAmtFiscalizadora.value)+parseFloat(document.closecash_store.GrantAmtFiscalizadora.value)+ parseFloat(document.closecash_store.CardValeFiscalizadora.value) + parseFloat(document.closecash_store.CardVisaFiscalizadora.value)+parseFloat(document.closecash_store.CardMasterFiscalizadora.value)+ parseFloat(document.closecash_store.CardAEFiscalizadora.value) ).toFixed(2);
                document.getElementById("Otros_Gerente_t").innerHTML = parseFloat(parseFloat(document.closecash_store.yappyGerente.value)+parseFloat(document.closecash_store.otrosGerente.value)+parseFloat(document.closecash_store.valespagodaGerente.value) +parseFloat(document.closecash_store.CheckAmtGerente.value) +parseFloat(document.closecash_store.LotoAmtGerente.value)+parseFloat(document.closecash_store.CashAmtGerente.value)+parseFloat(document.closecash_store.CoinRollGerente.value)+parseFloat(document.closecash_store.InvoiceAmtGerente.value)+parseFloat(document.closecash_store.VoucherAmtGerente.value)+parseFloat(document.closecash_store.GrantAmtGerente.value)+ parseFloat(document.closecash_store.CardValeGerente.value) + parseFloat(document.closecash_store.CardVisaGerente.value)+parseFloat(document.closecash_store.CardMasterGerente.value)+ parseFloat(document.closecash_store.CardAEGerente.value) ).toFixed(2);
                document.getElementById("Monto_Fiscalizadora_t").innerHTML = document.getElementById("Fiscalizadora_t").innerHTML + document.getElementById("Otros_Fiscalizadora_t").innerHTML;

                const card = parseFloat(parseFloat(document.closecash_store.CardValeFiscalizadora.value) + parseFloat(document.closecash_store.CardVisaFiscalizadora.value)+parseFloat(document.closecash_store.CardMasterFiscalizadora.value)+ parseFloat(document.closecash_store.CardAEFiscalizadora.value) ).toFixed(2);
                document.getElementById("CardValeFiscalizadora_r").innerHTML =parseFloat(card-document.closecash_store.CardAmtSistema.value).toFixed(2); 
                document.getElementById("CardVisaFiscalizadora_r").innerHTML =parseFloat(card-document.closecash_store.CardAmtSistema.value).toFixed(2);
                document.getElementById("CardMasterFiscalizadora_r").innerHTML =parseFloat(card-document.closecash_store.CardAmtSistema.value).toFixed(2);
                document.getElementById("CardAEFiscalizadora_r").innerHTML = parseFloat(card-document.closecash_store.CardAmtSistema.value).toFixed(2);

                const cambioFiscalizadora_t         = document.getElementById("Fiscalizadora_t");
                const cambioGerente_t               = document.getElementById("Gerente_t");
                const cambioOtros_Fiscalizadora_t   = document.getElementById("Otros_Fiscalizadora_t");
            
                if (document.getElementById("Fiscalizadora_t").innerHTML < document.getElementById("Montosistema_t").innerHTML ) {cambioFiscalizadora_t.classList.replace("text-success", "text-danger");} 
                else{cambioFiscalizadora_t.classList.replace("text-success", "text-success"); cambioFiscalizadora_t.classList.replace("text-danger", "text-success");}

                if (document.getElementById("Gerente_t").innerHTML < document.getElementById("Fiscalizadora_t").innerHTML || document.getElementById("Gerente_t").innerHTML < document.getElementById("Montosistema_t").innerHTML ) {cambioGerente_t.classList.replace("text-success", "text-danger");} 
                else{cambioGerente_t.classList.replace("text-success", "text-success"); cambioGerente_t.classList.replace("text-danger", "text-success");}

                if (document.getElementById("Otros_Fiscalizadora_t").innerHTML < document.getElementById("Otros").innerHTML ) {cambioOtros_Fiscalizadora_t.classList.replace("text-success", "text-danger");} 
                else{cambioOtros_Fiscalizadora_t.classList.replace("text-success", "text-success"); cambioOtros_Fiscalizadora_t.classList.replace("text-danger", "text-success");}

            } catch (e) {}
        }
    </script>