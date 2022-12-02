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
        Consultar Deudor
    </div>
    <div class="card-body">
        <div class="form-group">
            <form name="loans_search" id="loans_search" method="get" action="{{ route('loans.search') }}">
                @csrf
                <div class="container p-0  mx-auto">
                    <div class="row m-0 p-0">
                        <div class="mx-auto col-lg-12 col-md-12 d-flex">
                            <div class="form-group">
                                <label for="cars">Sucursal</label>
                                <select class="form-control" name="AD_Org_ID" id="AD_Org_ID">
                                    @if (isset($orgs))
                                    @if ($orgs->{'records-size'} > 0)
                                    @foreach ($orgs->records as $org)
                                    <option value="{{ $org->id }}" {{ isset($request) ? ($org->id == $request->AD_Org_ID ? __('selected') : __('')) : __('') }}>
                                        {{ $org->Name }}
                                    </option>
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
                        <div class="col-md-3 col-3 col-sm-3 col-lg-3 ">
                            <label>Nro Identificación </label>
                            <input name="TaxID" value="{{ isset($request) ? $request->TaxId : '' }}" type="text" class="form-control text-left   " placeholder="">
                        </div>

                        <div class="col-md-4 col-4 col-sm-4  ">
                            <label>Nombre</label>
                            <input name="Name" value="{{ isset($request) ? $request->Name : '' }}" type="text" class="form-control text-left   " placeholder="">
                        </div>
                        <div class="col-md-5 col-5 col-sm-5 d-flex" style="">
                            <button type="submit" class="btn btn-primary my-auto">Buscar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </form>
        <br><br>
        @if (isset($datas))
        @if ($datas->{'array-count'} == 0)
        <br><br><br>

        <form name="loans_bpartnerstore" id="loans_bpartnerstore" method="GET" action="{{ route('loans.bpartnerstore') }}">
            @csrf
            <div class="container">
                <div class="row ">
                    <center>
                        <div class="col-3 col-lg-3 col-sm-3 col-md-3">
                            <label>Cédula o RUC</label>
                            <input name="AD_Org_ID" value="{{ isset($request) ? $request->AD_Org_ID : '' }}" type="hidden" class="form-control text-left w-100 m-1" placeholder="">

                            <input name="value" value="{{ isset($request) ? $request->value : '' }}" type="hidden" class="form-control text-left w-100 m-1" placeholder="">
                            <input name="taxid" value="" type="text" class=" form-control text-left  w-100 " placeholder="">

                            <label>Nombre del Deudor</label>
                            <input name="name" value="" type="text" class=" form-control text-left  w-100 " placeholder="">
                            <input name="CreatedBy" value="{{ auth()->user()->name }}" type="hidden" class=" form-control text-left  w-100 ">

                            <label>Telefono</label>
                            <input name="name" value="" type="text" class=" form-control text-left  w-100 " placeholder="">

                            <label>Solicitante</label>
                            <input name="name" value="" type="text" class=" form-control text-left  w-100 " placeholder="">

                            <label>Direccion</label>
                            <input name="name" value="" type="text" class=" form-control text-left  w-100 " placeholder="">

                            <label for="formFileMultiple" class="form-label">Adjuntar Foto Cedula</label>
                            <input class="form-control" type="file" id="Filecedula" name="FileCedula" value="0">
                            <br>


                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary my-auto active ">Guardar</button>
                            <a href="{{ url('loanscancel') }}" class="btn btn-secondary active my-auto" role="button" aria-pressed="true">Cancelar</a>
                        </div>
                    </center>
                </div>
            </div>
        </form>
        <br>
        @endif

        @if ($datas->{'array-count'} == 1)
        @foreach ($datas->records as $data)
        <div class="card">
            <div class="card-body">
                <form name="loans_store" id="loans_store" method="POST" action="{{ route('loans.store') }}">
                    <p class="fw-bold"><span class="fw-light">Cédula: </span>{{ $data->TaxID }}<span class="fw-light"> Nombre: </span>{{ $data->Name }} <span class="fw-light"> Monto total pendiente: </span></p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bpartnerModal">Agregar Nuevo Prestamo</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bpartnerModal">Agregar Pago</button>

                    <div class="modal fade" id="bpartnerModal" tabindex="-1" aria-labelledby="bpartnerModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="bpartnerModalLabel">Agregar nuevo
                                        prestamo</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label>Fecha</label>
                                    <input name="DateTrx" type="date" value="" class="form-control">
                                    <label>Monto</label>
                                    <input name="name" value="" type="text" class=" form-control text-left  w-100 " placeholder="">
                                   
                                    <label>Monto cuota</label>
                                    <input name="name" value="" type="text" class=" form-control text-left  w-100 " placeholder="">
                                    <label>Frecuencia</label>
                                    <input name="name" value="" type="text" class=" form-control text-left  w-100 " placeholder="">



                                    <label for="FileCedula" class="form-label">Adjuntar Foto
                                        Recibo</label>
                                    <input class="form-control" type="file" id="Filecedula" placeholder="Recibo" name="FileCedula" value="0">

                                    <br> <br>
                                    <label>Firma</label>
                                    <div>
                                        @include('canvas/tablero3')
                                        <input type="hidden" id="myText3" name="v12" value="no guarda">
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
        @endif
        @endif





    </div>
</div>
</div>
<div class="container">

    <div class="card">
        <div class="card-header">
            Lista de prestamos Solicitados
        </div>
        <div class="card-body">
            @livewire('loanssearch')
        </div>
    </div>

</div>
@endsection