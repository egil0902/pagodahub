@extends('layouts.app')

@section('content')
<form name="closecashform" id="closecashform" method="post" action="{{ route('closecashform.store') }}" enctype="multipart/form-data"> @csrf
    <div class="card m-5">
        <div class="card-header">
            <div class="container">

                <div class="row my-1">
                    <div class="text-center col-md-3">
                        <h6>{{ $AD_Org_ID }}</h6>
                    </div>

                    <div class="text-center col-md-3">
                        <h1>Supervisor: Gloria benitez</h1>
                    </div>
                    <div class="text-center col-md-3">
                        <div class="form-group row"><label class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0">Fecha</label>
                            <div class="col-md-7 offset-md-3 col-7 col-sm-7 col-lg-7 m-0 p-0"><input name="DateTrx" type="date" value={{ date("Y-m-d") }} class="form-control text-left w-100 m-0 p-0" placeholder=""></div>
                        </div>
                    </div>
                    <div class="text-center col-md-3"><a class="btn btn-primary m-0" href="#">Importar</a></div>

                </div>

            </div>
        </div>
        <div class="card-body ">
            <div class="container">
                <div class="row my-1">
                    <div class="text-center col-md-3">
                        <h6>Cantidad de cajeras:10</h6>
                    </div>
                    <div class="text-center col-md-3"></div>

                    <div class="text-center col-md-3">
                        <h6>Supermercado</h6>
                    </div>

                    <div class="text-center col-md-3">
                        <h6>Inicio caja: 300</h6>
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
                                        <h5 class="mb-0"> <b>$2891</b> </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$1x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" value="64" type="text" class="text-left  w-25 " placeholder="" readonly="">&nbsp;=$64</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1" style="">$5x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" value="97" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$485</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$10x&nbsp;&nbsp;&nbsp;<input name="" value="0" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$0</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1 col-md-12">$20x&nbsp;&nbsp;&nbsp;<input name="" value="10" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$200</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1 col-md-12">$50x&nbsp;&nbsp;&nbsp;<input name="" value="0" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$0</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1 col-md-12">$100x&nbsp;<input name="" value="1" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$100</div>
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
                                        <h5 class="mb-0"> <b>$740.03</b> </h5>
                                    </div>
                                </div>
                                <div class="row p-0 my-1 m-0">
                                    <div class="p-0 col-sm-5 col-md-5 col-lg-5 col-5 m-0" style="">Yappy&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="m-0 p-0 col-sm-7 col-md-7 col-lg-7 col-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Otros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Vales Pagoda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Monto cheques&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Loteria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="66" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vales&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Tarjetas&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="m-0 col-7 col-sm-7 col-md-7 col-lg-7 p-0" style=""><input name="" value="574.79" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Sencillo&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-sm-7 col-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="21.92" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Rollos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="m-0 p-0 col-7 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="25" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Facturas&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-md-7 col-sm-7 col-lg-7 m-0 p-0" style=""><input name="" value="1993.01" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vale digital&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="1711.19" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Beca Digital&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="2.09" type="text" class="w-100 text-right" placeholder=""></div>
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
                                        <h5 class="mb-0"> <b>$4923</b> </h5>
                                    </div>
                                </div>
                                <h6 class="mb-0 text-right">Subtotal = <b>$5223.00</b></h6>
                                <h6 class="mb-0 text-right">Monto X = <b>$4922.30</b></h6>
                                <h6 class="mb-0 text-right">Diferencia = <b>$0.70</b></h6>
                            </div>
                        </div>
                    </div>
                    <div class="p-0 col-lg-4 col-md-4 col-sm-4 col-4 m-0" style="">
                        <div class="card bg-light">
                            <div class="card-header">Fiscalizadora</div>
                            <div class="card-body p-1">
                                <div class="row m-0 p-0">
                                    <div class="col-8 col-md-6 m-0 p-0" style="">
                                        <h4 class="mb-0">Efectivo</h4>
                                    </div>
                                    <div class="col-4 text-right col-md-5 m-0 p-0" style="">
                                        <h5 class="mb-0"> <b>$2891</b> </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$1x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" value="64" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$64</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1" style="">$5x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" value="97" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$485</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$10x&nbsp;&nbsp;&nbsp;<input name="" value="0" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$0</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$20x&nbsp;&nbsp;&nbsp;<input name="" value="10" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$200</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$50x&nbsp;&nbsp;&nbsp;<input name="" value="0" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$0</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$100x&nbsp;<input name="" value="1" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$100</div>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-light">
                            <div class="card-body p-1">
                                <div class="row m-0 p-0">
                                    <div class="col-6 m-0 p-0" style="">
                                        <h4 class="mb-0">Otros</h4>
                                    </div>
                                    <div class="text-right col-6 m-0 p-0" style="">
                                        <h5 class="mb-0"> <b>$740.03</b> </h5>
                                    </div>
                                </div>
                                <div class="row p-0 my-1 m-0">
                                    <div class="p-0 col-sm-5 col-md-5 col-lg-5 col-5 m-0" style="">Yappy&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="m-0 p-0 col-sm-7 col-md-7 col-lg-7 col-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Otros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Vales Pagoda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Monto cheques&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Loteria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="66" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vales&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Tarjetas&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="m-0 col-7 col-sm-7 col-md-7 col-lg-7 p-0" style=""><input name="" value="574.79" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Sencillo&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-sm-7 col-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="21.92" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Rollos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="m-0 p-0 col-7 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="25" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Facturas&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-md-7 col-sm-7 col-lg-7 m-0 p-0" style=""><input name="" value="1993.01" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vale digital&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="1711.19" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Beca Digital&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="2.09" type="text" class="w-100 text-right" placeholder=""></div>
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
                                        <h5 class="mb-0"> <b>$4923</b> </h5>
                                    </div>
                                </div>
                                <h6 class="mb-0 text-right">Subtotal = <b>$5223.00</b></h6>
                                <h6 class="mb-0 text-right">Monto X = <b>$4922.30</b></h6>
                                <h6 class="mb-0 text-right">Diferencia = <b>$0.70</b></h6>
                            </div>
                        </div>
                    </div>
                    <div class="p-0 col-lg-4 col-4 col-sm-4 col-md-4 m-0" style="">
                        <div class="card bg-light">
                            <div class="card-header">Gerente</div>
                            <div class="card-body p-1">
                                <div class="row m-0 p-0">
                                    <div class="col-8 col-md-6 m-0 p-0" style="">
                                        <h4 class="mb-0">Efectivo</h4>
                                    </div>
                                    <div class="col-4 text-right col-md-5 m-0 p-0" style="">
                                        <h5 class="mb-0"> <b>$2891</b> </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$1x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" value="64" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$64</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$5x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" value="97" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$485</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$10x&nbsp;&nbsp;&nbsp;<input name="" value="0" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$0</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$20x&nbsp;&nbsp;&nbsp;<input name="" value="10" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$200</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$50x&nbsp;&nbsp;&nbsp;<input name="" value="0" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$0</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$100x&nbsp;<input name="" value="1" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$100</div>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-light">
                            <div class="card-body p-1">
                                <div class="row m-0 p-0">
                                    <div class="col-6 m-0 p-0" style="">
                                        <h4 class="mb-0">Otros</h4>
                                    </div>
                                    <div class="text-right col-6 m-0 p-0" style="">
                                        <h5 class="mb-0"> <b>$740.03</b> </h5>
                                    </div>
                                </div>
                                <div class="row p-0 my-1 m-0">
                                    <div class="p-0 col-sm-5 col-md-5 col-lg-5 col-5 m-0" style="">Yappy&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="m-0 p-0 col-sm-7 col-md-7 col-lg-7 col-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Otros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Vales Pagoda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Monto cheques&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Loteria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="66" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vales&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Tarjetas&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="m-0 col-7 col-sm-7 col-md-7 col-lg-7 p-0" style=""><input name="" value="574.79" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Sencillo&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-sm-7 col-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="21.92" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Rollos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="m-0 p-0 col-7 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="25" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Facturas&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-md-7 col-sm-7 col-lg-7 m-0 p-0" style=""><input name="" value="1993.01" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vale digital&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="1711.19" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Beca Digital&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="2.09" type="text" class="w-100 text-right" placeholder=""></div>
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
                                        <h5 class="mb-0"> <b>$4923</b> </h5>
                                    </div>
                                </div>
                                <h6 class="mb-0 text-right">Subtotal = <b>$5223.00</b></h6>
                                <h6 class="mb-0 text-right">Monto X = <b>$4922.30</b></h6>
                                <h6 class="mb-0 text-right">Diferencia = <b>$0.70</b></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container ">
                <div class="row my-1">
                    <div class="text-center col-md-3">

                    </div>
                    <div class="text-center col-md-3"></div>

                    <div class="text-center col-md-3">
                        <h6>Panaderia</h6>
                    </div>

                    <div class="text-center col-md-3">
                        <h6>Inicio caja: 300</h6>
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
                                        <h5 class="mb-0"> <b>$2891</b> </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$1x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" value="64" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$64</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1" style="">$5x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" value="97" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$485</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$10x&nbsp;&nbsp;&nbsp;<input name="" value="0" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$0</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1 col-md-12">$20x&nbsp;&nbsp;&nbsp;<input name="" value="10" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$200</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1 col-md-12">$50x&nbsp;&nbsp;&nbsp;<input name="" value="0" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$0</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1 col-md-12">$100x&nbsp;<input name="" value="1" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$100</div>
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
                                        <h5 class="mb-0"> <b>$740.03</b> </h5>
                                    </div>
                                </div>
                                <div class="row p-0 my-1 m-0">
                                    <div class="p-0 col-sm-5 col-md-5 col-lg-5 col-5 m-0" style="">Yappy&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="m-0 p-0 col-sm-7 col-md-7 col-lg-7 col-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Otros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Vales Pagoda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Monto cheques&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Loteria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="66" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vales&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Tarjetas&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="m-0 col-7 col-sm-7 col-md-7 col-lg-7 p-0" style=""><input name="" value="574.79" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Sencillo&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-sm-7 col-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="21.92" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Rollos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="m-0 p-0 col-7 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="25" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Facturas&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-md-7 col-sm-7 col-lg-7 m-0 p-0" style=""><input name="" value="1993.01" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vale digital&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="1711.19" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Beca Digital&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="2.09" type="text" class="w-100 text-right" placeholder=""></div>
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
                                        <h5 class="mb-0"> <b>$4923</b> </h5>
                                    </div>
                                </div>
                                <h6 class="mb-0 text-right">Subtotal = <b>$5223.00</b></h6>
                                <h6 class="mb-0 text-right">Monto X = <b>$4922.30</b></h6>
                                <h6 class="mb-0 text-right">Diferencia = <b>$0.70</b></h6>
                            </div>
                        </div>
                    </div>
                    <div class="p-0 col-lg-4 col-md-4 col-sm-4 col-4 m-0" style="">
                        <div class="card bg-light">
                            <div class="card-header">Fiscalizadora</div>
                            <div class="card-body p-1">
                                <div class="row m-0 p-0">
                                    <div class="col-8 col-md-6 m-0 p-0" style="">
                                        <h4 class="mb-0">Efectivo</h4>
                                    </div>
                                    <div class="col-4 text-right col-md-5 m-0 p-0" style="">
                                        <h5 class="mb-0"> <b>$2891</b> </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$1x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" value="64" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$64</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1" style="">$5x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" value="97" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$485</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$10x&nbsp;&nbsp;&nbsp;<input name="" value="0" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$0</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$20x&nbsp;&nbsp;&nbsp;<input name="" value="10" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$200</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$50x&nbsp;&nbsp;&nbsp;<input name="" value="0" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$0</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$100x&nbsp;<input name="" value="1" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$100</div>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-light">
                            <div class="card-body p-1">
                                <div class="row m-0 p-0">
                                    <div class="col-6 m-0 p-0" style="">
                                        <h4 class="mb-0">Otros</h4>
                                    </div>
                                    <div class="text-right col-6 m-0 p-0" style="">
                                        <h5 class="mb-0"> <b>$740.03</b> </h5>
                                    </div>
                                </div>
                                <div class="row p-0 my-1 m-0">
                                    <div class="p-0 col-sm-5 col-md-5 col-lg-5 col-5 m-0" style="">Yappy&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="m-0 p-0 col-sm-7 col-md-7 col-lg-7 col-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Otros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Vales Pagoda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Monto cheques&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Loteria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="66" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vales&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Tarjetas&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="m-0 col-7 col-sm-7 col-md-7 col-lg-7 p-0" style=""><input name="" value="574.79" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Sencillo&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-sm-7 col-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="21.92" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Rollos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="m-0 p-0 col-7 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="25" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Facturas&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-md-7 col-sm-7 col-lg-7 m-0 p-0" style=""><input name="" value="1993.01" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vale digital&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="1711.19" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Beca Digital&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="2.09" type="text" class="w-100 text-right" placeholder=""></div>
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
                                        <h5 class="mb-0"> <b>$4923</b> </h5>
                                    </div>
                                </div>
                                <h6 class="mb-0 text-right">Subtotal = <b>$5223.00</b></h6>
                                <h6 class="mb-0 text-right">Monto X = <b>$4922.30</b></h6>
                                <h6 class="mb-0 text-right">Diferencia = <b>$0.70</b></h6>
                            </div>
                        </div>
                    </div>
                    <div class="p-0 col-lg-4 col-4 col-sm-4 col-md-4 m-0" style="">
                        <div class="card bg-light">
                            <div class="card-header">Gerente</div>
                            <div class="card-body p-1">
                                <div class="row m-0 p-0">
                                    <div class="col-8 col-md-6 m-0 p-0" style="">
                                        <h4 class="mb-0">Efectivo</h4>
                                    </div>
                                    <div class="col-4 text-right col-md-5 m-0 p-0" style="">
                                        <h5 class="mb-0"> <b>$2891</b> </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$1x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" value="64" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$64</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$5x&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="" value="97" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$485</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$10x&nbsp;&nbsp;&nbsp;<input name="" value="0" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$0</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$20x&nbsp;&nbsp;&nbsp;<input name="" value="10" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$200</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$50x&nbsp;&nbsp;&nbsp;<input name="" value="0" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$0</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-1">$100x&nbsp;<input name="" value="1" type="text" class="text-left  w-25 " placeholder="">&nbsp;=$100</div>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-light">
                            <div class="card-body p-1">
                                <div class="row m-0 p-0">
                                    <div class="col-6 m-0 p-0" style="">
                                        <h4 class="mb-0">Otros</h4>
                                    </div>
                                    <div class="text-right col-6 m-0 p-0" style="">
                                        <h5 class="mb-0"> <b>$740.03</b> </h5>
                                    </div>
                                </div>
                                <div class="row p-0 my-1 m-0">
                                    <div class="p-0 col-sm-5 col-md-5 col-lg-5 col-5 m-0" style="">Yappy&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="m-0 p-0 col-sm-7 col-md-7 col-lg-7 col-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Otros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Vales Pagoda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-12 m-0 p-0 col-sm-5 col-md-5 col-lg-5" style="">Monto cheques&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-12 m-0 p-0 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Loteria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="66" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vales&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="0" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Tarjetas&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="m-0 col-7 col-sm-7 col-md-7 col-lg-7 p-0" style=""><input name="" value="574.79" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Sencillo&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-sm-7 col-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="21.92" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Rollos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="m-0 p-0 col-7 col-sm-7 col-md-7 col-lg-7" style=""><input name="" value="25" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Facturas&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-md-7 col-sm-7 col-lg-7 m-0 p-0" style=""><input name="" value="1993.01" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Vale digital&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="1711.19" type="text" class="w-100 text-right" placeholder=""></div>
                                </div>
                                <div class="row p-0 m-0 my-1">
                                    <div class="col-5 col-sm-5 col-md-5 col-lg-5 m-0 p-0" style="">Beca Digital&nbsp;&nbsp;&nbsp;</div>
                                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 m-0 p-0" style=""><input name="" value="2.09" type="text" class="w-100 text-right" placeholder=""></div>
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
                                        <h5 class="mb-0"> <b>$4923</b> </h5>
                                    </div>
                                </div>
                                <h6 class="mb-0 text-right">Subtotal = <b>$5223.00</b></h6>
                                <h6 class="mb-0 text-right">Monto X = <b>$4922.30</b></h6>
                                <h6 class="mb-0 text-right">Diferencia = <b>$0.70</b></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 m-1" style="">
                <label for="formFileMultiple" class="form-label">Por favor adjunte los reportes z</label>
                <input class="form-control" type="file" id="formFileMultiple" multiple="">
            </div>
        </div>
    </div>
</form>
@endsection