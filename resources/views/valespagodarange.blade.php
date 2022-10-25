@extends('layouts.app')

@section('content')
<?php
if (isset($error))
    echo "<h1 class='text-danger'>".$error."</h1>";
?>

<div class="card w-75 m-auto">
    <div class="card-header">Ingrese un rango para generar</div>
    <div class="card-body">
        <div class="form-group">
            <form name="valespagodarange_store" id="valespagodarange_store" method="post" action="{{ route('valespagodarange.store') }}">
                @csrf

                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-4 col-sm-4 col-lg-3" style=""> <label class="m-1">Desde</label>
                        </div>
                        <div class="col-md-4 col-7" style=""> <label class="m-1">Hasta</label>
                        </div>
                        <div class="col-md-4 col-7" style=""> <label class="m-1">Monto</label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-3 col-4 col-sm-4 col-lg-3" style=""> 
                            <input name="valueFrom" value="{{(isset($request))?$request->valueFrom:''}}" type="text" class="form-control text-left w-100 m-1" placeholder="">
                        </div>
                        <div class="col-md-4 col-7" style=""> 
                            <input name="valueTo" value="{{(isset($request))?$request->valueTo:''}}" type="text" class="form-control text-left w-100 m-1" placeholder="">
                        </div>
                        <div class="col-md-4 col-7" style=""> 
                            <input name="amount" value="{{(isset($request))?$request->amount:''}}" type="text" class="form-control text-left w-100 m-1" placeholder="">
                            <input name="CreatedBy" value="{{ auth()->user()->name }}" type="hidden" class=" form-control text-left  w-100 " >
                        </div>

                    </div>
                    <div class="col-md-4 col-11 col-sm-11 col-lg-4">
                            <button type="submit" class="btn btn-primary m-10">Guardar</button>
                        </div>
                </div>

            </form>

            
           

        </div>
    </div>
</div>
<br>
<div class="card w-75 m-auto">
    <div class="card-header">Listado de Rangos generados</div>
    <div class="card-body">
        <form name="valespagodarange_list" id="valespagodarange_list" method="post" action="{{ route('valespagodarange.list') }}">
            <button type="submit" class="btn btn-primary m-10">Mostrar</button>

            @csrf
            @if (isset($list))

            <div class="container-fluid">
            <div class="row fw-bold">
                    <div class="col-md-2 col-2 col-sm-2 col-lg-2 fw-bold">

                        Desde
                    </div>
                    <div class="col-md-2 col-2 col-sm-2 col-lg-2 fw-bold">

                        Hasta
                    </div>
                    <div class="col-md-3 col-3 col-sm-3 col-lg-3 fw-bold">
                        Monto
                    </div>
                    <div class="col-md-3 col-3 col-sm-3 col-lg-3 fw-bold">
                        Fecha de creacion
                    </div>
                    <div class="col-md-2 col-2 col-sm-2 col-lg-2 fw-bold">
                        Creado por
                    </div>

                </div>
            @foreach($list as $data)
            
                <div class="row">
                    <div class="col-md-2 col-2 col-sm-2 col-lg-2">

                        {{ $data->valueFrom }}
                    </div>
                    <div class="col-md-2 col-2 col-sm-2 col-lg-2">

                        {{ $data->valueTo }}
                    </div>
                    <div class="col-md-3 col-3 col-sm-3 col-lg-3">
                        {{ $data->amount }}
                    </div>
                    <div class="col-md-3 col-3 col-sm-3 col-lg-3">
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