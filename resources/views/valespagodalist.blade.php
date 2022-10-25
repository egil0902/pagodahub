@extends('layouts.app')

@section('content')
<?php
if (isset($datas[0]))
    //dd($data);

if (isset($range[0]))
    //dd($range);
?>

<div class="card w-75 m-auto">
    <div class="card-header">Consultar Listado de Vale Pagoda</div>
    <div class="card-body">
        <div class="form-group">
            <form name="valepagoda_search" id="valepagoda_search" method="post" action="{{ route('valepagoda.search') }}">
                @csrf

                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-4 col-sm-4 col-lg-3" style=""> <label class="m-1">Numero de vale</label>
                        </div>
                        <div class="col-md-4 col-7" style=""> <input name="value" value="{{(isset($request))?$request->value:''}}" type="text" class="form-control text-left w-100 m-1" placeholder="">
                        </div>


                        @if(isset($datas))
                        @if (!$datas->isEmpty() || $range->isEmpty())
                        <div class="col-md-1 col-1 col-sm-1" style="">
                            <h1 class="display-5 text-danger">X</h1>
                            
                        </div>
                        @endif
                        @if ($datas->isEmpty() && !$range->isEmpty())
                        <div class="col-md-1 col-1 col-sm-1" style="">
                            <h1 class="display-5 text-success">&#10004;</h1>

                        </div>
                        @endif
                        @endif
                        @if(!isset($datas) || !$datas->isEmpty() || $range->isEmpty())
                        <div class="col-md-4 col-11 col-sm-11" style="">
                            <button type="submit" class="btn btn-primary m-10 w-100 m-1">Buscar</button>
                        </div>

                        @endif
                    </div>
                </div>
                @if (!isset($range[0]))
                    <h1 class=" text-danger">El numero introducido no es valido</h1>
                @endif
            </form>
            @if (isset($datas))

            <form name="valepagoda_store" id="valepagoda_store" method="post" action="{{ route('valepagoda.store') }}">
                @csrf
                @foreach($datas as $data)
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3">

                            <input name="taxid" value="{{ $data->taxid }}" type="text" class=" form-control text-left  w-100 " placeholder="Cedula">
                        </div>
                        <div class="col-md-4 col-7 col-sm-7 col-lg-4">
                            <input name="name" value="{{ $data->name }}" type="text" class=" form-control text-left  w-100 " placeholder="Nombre">
                            <input name="CreatedBy" value="{{ auth()->user()->name }}" type="hidden" class=" form-control text-left  w-100 " >
                            
                        </div>
                        <div class="col-md-4 col-11 col-sm-11 col-lg-4">

                        </div>
                    </div>
                </div>
                @endforeach

            </form>
            @endif

            @if (isset($datas))

            @if ($datas->isEmpty() && !$range->isEmpty())

            <form name="valepagoda_store" id="valepagoda_store" method="post" action="{{ route('valepagoda.store') }}">
                @csrf
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                            <input name="value" value="{{(isset($request))?$request->value:''}}" type="hidden" class="form-control text-left w-100 m-1" placeholder="">
                            <input name="taxid" value="" type="text" class=" form-control text-left  w-100 " placeholder="Cedula">
                        </div>
                        <div class="col-md-4 col-7 col-sm-7 col-lg-4">
                            <input name="name" value="" type="text" class=" form-control text-left  w-100 " placeholder="Nombre">
                            <input name="CreatedBy" value="{{ auth()->user()->name }}" type="hidden" class=" form-control text-left  w-100 " >

                        </div>
                        <div class="col-md-4 col-11 col-sm-11 col-lg-4">
                            <button type="submit" class="btn btn-primary m-10">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
            @endif
            @endif

        </div>
    </div>
</div>
<div class="card w-75 m-auto">
    <div class="card-header">Listado de vales pagodas consumidos</div>
    <div class="card-body">
        <form name="valepagoda_list" id="valepagoda_list" method="post" action="{{ route('valepagoda.list') }}">
            <button type="submit" class="btn btn-primary m-10">Mostrar</button>

            @csrf
            @if (isset($list))

            <div class="container-fluid">
            <div class="row fw-bold">
                    <div class="col-md-2 col-2 col-sm-2 col-lg-2 fw-bold">

                        Numero de vale
                    </div>
                    <div class="col-md-2 col-2 col-sm-2 col-lg-2 fw-bold">

                        Cedula
                    </div>
                    <div class="col-md-3 col-3 col-sm-3 col-lg-3 fw-bold">
                        Nombre
                    </div>
                    <div class="col-md-3 col-3 col-sm-3 col-lg-3 fw-bold">
                        Fecha de consumo
                    </div>
                    <div class="col-md-2 col-2 col-sm-2 col-lg-2 fw-bold">
                        Validado por
                    </div>
                </div>
            @foreach($list as $data)
            
                <div class="row">
                    <div class="col-2 col-sm-2 col-md-2 col-lg-2">

                        {{ $data->value }}
                    </div>
                    <div class="col-3 col-sm-3 col-md-3 col-lg-3">

                        {{ $data->taxid }}
                    </div>
                    <div class="col-md-3 col-3 col-sm-3 col-lg-3">
                        {{ $data->name }}
                    </div>
                    <div class="col-md-2 col-2 col-sm-2 col-lg-2">
                        {{ date('d-m-Y',strtotime($data->created_at)) }}
                    </div>
                    <div class="col-md-2 col-2 col-sm-2 col-lg-2">
                        {{ $data->CreatedBy }}
                    </div>
                </div>
                @endforeach

            </div>

            @endif
        </form>

    </div>

</div>
@endsection