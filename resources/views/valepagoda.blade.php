@extends('layouts.app')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif



    

<div class="card w-75 m-auto">
    <div class="card-header">
    Consultar Vale pagoda
    </div>
    <div class="card-body">

        <div class="form-group">
            <form name="valepagoda_search" id="valepagoda_search" method="GET" action="{{ route('valepagoda.search') }}">
                @csrf
                <div class="container p-0  mx-auto">
                    <div class="row m-0 p-0">
                        <div class="mx-auto col-lg-12 col-md-12 d-flex">
                            <div class="form-group">
                                <label for="cars">Sucursal</label>
                                <select class="form-control" name="AD_Org_ID" id="AD_Org_ID">
                                    @if (isset($orgs))
                                    @if ($orgs->{'records-size'} > 0)
                                    @foreach($orgs->records as $org)
                                    <option value="{{$org->id}}" {{ (isset($request))? ($org->id == $request->AD_Org_ID)? __('selected') : __(''):__('') }}>{{$org->Name}}</option>
                                    @endforeach
                                    @endif
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row align-items-end">

                        <div class="col-md-5 col-5 col-sm-5 col-lg-5 ">
                            <label>Numero de vale</label>
                            <input name="value" value="{{(isset($request))?$request->value:''}}" type="number" class="form-control text-left   " placeholder="">
                        </div>

                        <div class="col-md-2 col-2 col-sm-2 d-flex ">
                            @if(isset($datas))
                            @if (!$datas->isEmpty() || $range->isEmpty())
                            <h2 class="display-5 text-danger my-auto">X</h2>


                            @endif


                            @if ($datas->isEmpty() && !$range->isEmpty())
                            <h2 class="display-5 text-success my-auto">&#10004;</h2>
                            @endif


                            @endif
                        </div>
                        <div class="col-md-5 col-5 col-sm-5 d-flex" style="">
                            @if(!isset($datas) || !$datas->isEmpty() || $range->isEmpty())
                            <button type="submit" class="btn btn-primary my-auto">Buscar</button>
                            @endif
                        </div>


                    </div>
                </div>


            </form>
            <br>
            @if (isset($range))
            @if ($range->isEmpty())
            <h1 class=" text-danger">El vale introducido no es valido</h1>
            @endif
            @endif
            @if (isset($datas))
            @foreach($datas as $data)
            <div class="card">
                <div class="card-body">


                    <p class="fw-bold"><span class="fw-light">Cédula: </span>{{ $data->taxid }}<span class="fw-light"> Nombre: </span>{{ $data->name }}</p>




                    <p class="fw-bold"><span class="fw-light">Validado por: </span> {{ $data->CreatedBy }} <span class="fw-light">En Fecha: </span> {{ date('d-m-Y',strtotime($data->created_at)) }} </p>


                    <p class="fw-bold"><span class="fw-light">Sucursal: </span> {{ $data->AD_Org_ID }} </p>

                </div>

            </div>

            @endforeach
            @endif
            @if (isset($datas))

            @if ($datas->isEmpty() && !$range->isEmpty())

            <form name="valepagoda_store" id="valepagoda_store" method="GET" action="{{ route('valepagoda.store') }}">
                @csrf
                <div class="container-fluid d-flex">
                    <div class="row  align-items-end">
                        <div class="col-4 col-lg-3 col-sm-4 col-md-3">
                            <label>Cédula</label>
                            <input name="AD_Org_ID" value="{{(isset($request))?$request->AD_Org_ID:''}}" type="hidden" class="form-control text-left w-100 m-1" placeholder="">

                            <input name="value" value="{{(isset($request))?$request->value:''}}" type="hidden" class="form-control text-left w-100 m-1" placeholder="">
                            <input name="taxid" value="" type="text" class=" form-control text-left  w-100 " placeholder="">
                        </div>
                        <div class="col-5 col-sm-5 col-md-3 col-lg-3">
                            <label>Nombre</label>
                            <input name="name" value="" type="text" class=" form-control text-left  w-100 " placeholder="">
                            <input name="CreatedBy" value="{{ auth()->user()->name }}" type="hidden" class=" form-control text-left  w-100 ">
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3 d-flex ">
                            <button type="submit" class="btn btn-primary my-auto active ">Guardar</button>
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3 d-flex ">
                            <a href="{{ url('valepagodacancel') }}" class="btn btn-secondary active my-auto" role="button" aria-pressed="true">Cancelar</a>

                        </div>
                    </div>


                </div>
            </form>
            @endif
            @endif

        </div>
    </div>
</div>

@endsection