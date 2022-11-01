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
                    <h6>{{ $data->AD_Org_ID->identifier }}</h6>
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
                                <div class="col-12 my-1">$1x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" value="{{ $data->x_oneamt }}" type="text" class="text-left  w-25 " placeholder="" readonly="">&nbsp;={{ $data->x_oneamt*1 }}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1" style="">$5x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" value="{{ $data->x_fiveamt }}" type="text" class="text-left  w-25 " placeholder="">&nbsp;={{ $data->x_fiveamt*5 }}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1">$10x&nbsp;&nbsp;&nbsp;<input name="" value="{{ $data->x_tenamt }}" type="text" class="text-left  w-25 " placeholder="">&nbsp;={{ $data->x_tenamt*10 }}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1 col-md-12">$20x&nbsp;&nbsp;&nbsp;<input name="" value="{{ $data->x_twentyamt }}" type="text" class="text-left  w-25 " placeholder="">&nbsp;={{ $data->x_twentyamt*20 }}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1 col-md-12">$50x&nbsp;&nbsp;&nbsp;<input name="" value="{{ $data->x_fiftyamt }}" type="text" class="text-left  w-25 " placeholder="">&nbsp;={{ $data->x_fiftyamt*50 }}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1 col-md-12">$100x&nbsp;<input name="" value="{{ $data->x_hundredamt }}" type="text" class="text-left  w-25 " placeholder="">&nbsp;={{ $data->x_hundredamt*100 }}</div>
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
                                <div class="m-0 p-0 col-sm-7 col-md-7 col-lg-7 col-7" style=""><input name="" value="{{ $data->yappy }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Otros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="{{ $data->otros }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Vales Pagoda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="{{ $data->valespagoda }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Monto cheques&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="{{ $data->CheckAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Loteria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="{{ $data->LotoAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vales&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Tarjetas&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="m-0 col-7 col-sm-7 col-md-7 col-lg-7 p-0" style=""><input name="" value="{{ $data->CardAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Sencillo&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-sm-7 col-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="{{ $data->CashAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Rollos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="m-0 p-0 col-7 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="{{ $data->CoinRoll }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Facturas&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-md-7 col-sm-7 col-lg-7 m-0 p-0" style=""><input name="" value="{{ $data->InvoiceAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vale digital&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="{{ $data->VoucherAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Beca Digital&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="{{ $data->GrantAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
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
                                <div class="col-12 my-1">$1x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" value="{{ $data->x_oneamt }}" type="text" class="text-left  w-25 " placeholder="" readonly="">&nbsp;={{ $data->x_oneamt*1 }}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1" style="">$5x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" value="{{ $data->x_fiveamt }}" type="text" class="text-left  w-25 " placeholder="">&nbsp;={{ $data->x_fiveamt*5 }}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1">$10x&nbsp;&nbsp;&nbsp;<input name="" value="{{ $data->x_tenamt }}" type="text" class="text-left  w-25 " placeholder="">&nbsp;={{ $data->x_tenamt*10 }}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1 col-md-12">$20x&nbsp;&nbsp;&nbsp;<input name="" value="{{ $data->x_twentyamt }}" type="text" class="text-left  w-25 " placeholder="">&nbsp;={{ $data->x_twentyamt*20 }}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1 col-md-12">$50x&nbsp;&nbsp;&nbsp;<input name="" value="{{ $data->x_fiftyamt }}" type="text" class="text-left  w-25 " placeholder="">&nbsp;={{ $data->x_fiftyamt*50 }}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1 col-md-12">$100x&nbsp;<input name="" value="{{ $data->x_hundredamt }}" type="text" class="text-left  w-25 " placeholder="">&nbsp;={{ $data->x_hundredamt*100 }}</div>
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
                                <div class="m-0 p-0 col-sm-7 col-md-7 col-lg-7 col-7" style=""><input name="" value="{{ $data->yappy }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Otros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="{{ $data->otros }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Vales Pagoda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="{{ $data->valespagoda }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Monto cheques&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="{{ $data->CheckAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Loteria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="{{ $data->LotoAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vales&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Tarjetas&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="m-0 col-7 col-sm-7 col-md-7 col-lg-7 p-0" style=""><input name="" value="{{ $data->CardAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Sencillo&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-sm-7 col-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="{{ $data->CashAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Rollos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="m-0 p-0 col-7 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="{{ $data->CoinRoll }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Facturas&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-md-7 col-sm-7 col-lg-7 m-0 p-0" style=""><input name="" value="{{ $data->InvoiceAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vale digital&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="{{ $data->VoucherAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Beca Digital&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="{{ $data->GrantAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
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
                                <div class="col-12 my-1">$1x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" value="{{ $data->x_oneamt }}" type="text" class="text-left  w-25 " placeholder="" readonly="">&nbsp;={{ $data->x_oneamt*1 }}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1" style="">$5x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" value="{{ $data->x_fiveamt }}" type="text" class="text-left  w-25 " placeholder="">&nbsp;={{ $data->x_fiveamt*5 }}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1">$10x&nbsp;&nbsp;&nbsp;<input name="" value="{{ $data->x_tenamt }}" type="text" class="text-left  w-25 " placeholder="">&nbsp;={{ $data->x_tenamt*10 }}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1 col-md-12">$20x&nbsp;&nbsp;&nbsp;<input name="" value="{{ $data->x_twentyamt }}" type="text" class="text-left  w-25 " placeholder="">&nbsp;={{ $data->x_twentyamt*20 }}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1 col-md-12">$50x&nbsp;&nbsp;&nbsp;<input name="" value="{{ $data->x_fiftyamt }}" type="text" class="text-left  w-25 " placeholder="">&nbsp;={{ $data->x_fiftyamt*50 }}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-1 col-md-12">$100x&nbsp;<input name="" value="{{ $data->x_hundredamt }}" type="text" class="text-left  w-25 " placeholder="">&nbsp;={{ $data->x_hundredamt*100 }}</div>
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
                                <div class="m-0 p-0 col-sm-7 col-md-7 col-lg-7 col-7" style=""><input name="" value="{{ $data->yappy }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Otros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="{{ $data->otros }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Vales Pagoda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="{{ $data->valespagoda }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Monto cheques&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="{{ $data->CheckAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Loteria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="{{ $data->LotoAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vales&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Tarjetas&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="m-0 col-7 col-sm-7 col-md-7 col-lg-7 p-0" style=""><input name="" value="{{ $data->CardAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Sencillo&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-sm-7 col-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="{{ $data->CashAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Rollos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="m-0 p-0 col-7 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="{{ $data->CoinRoll }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Facturas&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-md-7 col-sm-7 col-lg-7 m-0 p-0" style=""><input name="" value="{{ $data->InvoiceAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vale digital&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="{{ $data->VoucherAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
                            </div>
                            <div class="row p-0 m-0 my-1">
                                <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Beca Digital&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="{{ $data->GrantAmt }}" type="text" class="w-100 text-right" placeholder=""></div>
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