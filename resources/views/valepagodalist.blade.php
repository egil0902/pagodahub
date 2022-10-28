@extends('layouts.app')

@section('content')

            
<div class="card w-75 m-auto">
    <div class="card-header">Listado de vales pagoda consumidos</div>
    <div class="card-body">
        <form name="valepagoda_list" id="valepagoda_list" method="GET" action="{{ route('valepagoda.list') }}">
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