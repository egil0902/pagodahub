@extends('layouts.app')

@section('content')
    <?php
    if (isset($error)) {
        echo "<h1 class='text-danger'>" . $error . '</h1>';
    }
    ?>


    <div class="card">
        <div class="card-header">Ingrese un rango para generar</div>
        <div class="card-body">
            <div class="form-group">
                <form name="valespagodarange_store" id="valespagodarange_store" method="post"
                    action="{{ route('valespagodarange.store') }}">
                    @csrf
                    <center>
                        <h5 class="fw-bold">Ingrese el rango de números a generar para los vales</h5>
                    </center>

                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                        <div class="col">
                            <div>Desde</div>
                            <input name="valueFrom" value="{{ isset($request) ? $request->valueFrom : '' }}" type="text"
                                class="form-control text-left w-100" placeholder="">
                        </div>
                        <div class="col">
                            <div>Hasta</div>
                            <input name="valueTo" value="{{ isset($request) ? $request->valueTo : '' }}" type="text"
                                class="form-control text-left w-100" placeholder="">
                        </div>
                        <div class="col">
                            <div>Monto</div>
                            <input name="amount" value="{{ isset($request) ? $request->amount : '' }}" type="text"
                                class="form-control text-left w-100" placeholder="">
                            <input name="CreatedBy" value="{{ auth()->user()->name }}" type="hidden"
                                class=" form-control text-left  w-100 ">
                        </div>
                        <div class="col">

                            <center>
                                <div>...</div>
                            </center>
                            <button type="submit" class="btn btn-primary w-100">Guardar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">Listado de Rangos generados</div>
        <div class="card-body">
            <form name="valespagodarange_list" id="valespagodarange_list" method="post"
                action="{{ route('valespagodarange.list') }}">
                <button type="submit" class="btn btn-primary w-100">Mostrar</button>
                <br>
                @csrf
                @if (isset($list))
                    <div class="row fw-bold row-cols-5" style="font-size:12px;">
                        <div class="col">
                            Desde
                        </div>
                        <div class="col">
                            Hasta
                        </div>
                        <div class="col">
                            Monto
                        </div>
                        <div class="col">
                            Fecha de creacion
                        </div>
                        <div class="col">
                            Creado por
                        </div>
                    </div>
                    @foreach ($list as $data)
                        <div class="row row-cols-5" style="font-size:12px;">
                            <div class="col">
                                {{ $data->valueFrom }}
                            </div>
                            <div class="col">
                                {{ $data->valueTo }}
                            </div>
                            <div class="col">
                                {{ $data->amount }}
                            </div>
                            <div class="col">
                                {{ date('d-m-Y', strtotime($data->created_at)) }}
                            </div>
                            <div class="col">
                                {{ $data->CreatedBy }}
                            </div>
                        </div>
                    @endforeach
                @endif
            </form>
        </div>
    </div>

@endsection
