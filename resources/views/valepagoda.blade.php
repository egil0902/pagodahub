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

    <body class="p-3 m-0 border-0 bd-example">
        <!-- Example Code -->
        <div class="card">
            <div class="card-header">
                Consultar Vale pagoda
            </div>
            <div class="card-body">

                <form name="valepagoda_search" id="valepagoda_search" method="GET" action="{{ route('valepagoda.search') }}">
                    @csrf
                    <div class="row gy-2 gx-3 align-items-center">
                        <div class="col-md">
                            <label>Sucursal</label>
                            <select class="form-control w-100" name="AD_Org_ID" id="AD_Org_ID">
                                @if (isset($orgs))
                                    @if ($orgs->{'records-size'} > 0)
                                        @foreach ($orgs->records as $org)
                                            <option value="{{ $org->id }}"
                                                {{ isset($request) ? ($org->id == $request->AD_Org_ID ? __('selected') : __('')) : __('') }}>
                                                {{ $org->Name }}
                                            </option>
                                        @endforeach
                                    @endif
                                @endif
                            </select>
                        </div>
                    </div>


                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                        <div class="col-md">
                            <label>Numero de vale</label>
                            <input name="value" value="{{ isset($request) ? $request->value : '' }}" type="number"
                                class="form-control text-left   " placeholder="">
                        </div>
                        <div class="col-md">
                            <label> </label>
                            @if (!isset($datas) || !$datas->isEmpty() || $range->isEmpty())
                                <button type="submit" class="form-control btn btn-primary">Buscar</button>
                            @endif
                        </div>
                        <div class="col-md">

                            <label> </label>
                            @if (isset($datas))
                                @if (!$datas->isEmpty() || $range->isEmpty())
                                    <h2 class="display-5 text-danger my-auto">X</h2>
                                @endif
                                @if ($datas->isEmpty() && !$range->isEmpty())
                                    <h2 class="display-5 text-success my-auto">&#10004;</h2>
                                @endif
                            @endif
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <br>
        @if (isset($range))
            @if ($range->isEmpty())
                <h1 class=" text-danger">El vale introducido no es valido</h1>
            @endif
        @endif
        @if (isset($datas))
            @foreach ($datas as $data)
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-header">
                                ...
                            </div>
                            <div class="card-body">
                                <p class="fw-bold"><span class="fw-light">Cédula: </span>{{ $data->taxid }}<span
                                        class="fw-light">
                                        Nombre: </span>{{ $data->name }}</p>
                                <p class="fw-bold"><span class="fw-light">Validado por: </span> {{ $data->CreatedBy }}
                                    <span class="fw-light">En Fecha: </span>
                                    {{ date('d-m-Y', strtotime($data->created_at)) }}
                                </p>
                                <p class="fw-bold"><span class="fw-light">Sucursal: </span> {{ $data->AD_Org_ID }} </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        @if (isset($datas))
            @if ($datas->isEmpty() && !$range->isEmpty())
                <form name="valepagoda_store" id="valepagoda_store" method="GET"
                    action="{{ route('valepagoda.store') }}">
                    @csrf
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-header">
                                    No. ...
                                </div>
                                <div class="card-body">
                                    <input name="AD_Org_ID" value="{{ isset($request) ? $request->AD_Org_ID : '' }}"
                                        type="hidden" class="form-control">
                                    <input name="value" value="{{ isset($request) ? $request->value : '' }}"
                                        type="hidden" class="form-control">
                                    <input name="CreatedBy" value="{{ auth()->user()->name }}" type="hidden"
                                        class=" form-control">
                                    <label>Cédula</label>
                                    <input name="taxid" value="" type="text"
                                        class=" form-control text-left  w-100 " placeholder="" required>
                                    <label>Nombre</label>
                                    <input name="name" value="" type="text"
                                        class=" form-control text-left  w-100" placeholder="" required>
                                    <label> </label>
                                    <button type="submit" class="btn btn-primary w-100">Guardar</button>
                                    <label> </label>
                                    <a href="{{ url('valepagodacancel') }}" class="btn btn-secondary w-100"
                                        role="button" aria-pressed="true">Cancelar</a>
                                </div>

                            </div>

                        </div>

                        {{-- <div class="col">
                            <div class="card h-100">

                                <div class="card-header">
                                    Featured
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Special title treatment</h5>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional
                                        content.
                                    </p>
                                </div>
                            </div>
                        </div> --}}


                    </div>


                </form>
            @endif
        @endif
    </body>
@endsection
