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
                        </div>
                    </div>
                    <div class="container">
                        <div class="row align-items-end">
                            <div class="col-md-3 col-3 col-sm-3 col-lg-3 ">
                                <label>Nro Identificación </label>
                                <input name="Cedula" value="" type="text" class="form-control text-left   "
                                    placeholder="">
                            </div>

                            <div class="col-md-4 col-4 col-sm-4  ">
                                <label>Nombre</label>
                                <input name="Nombre" value="" type="text" class="form-control text-left   "
                                    placeholder="">
                            </div>
                            <div class="col-md-5 col-5 col-sm-5 d-flex" style="">
                                <button type="submit" class="btn btn-primary my-auto">Buscar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


            @if (isset($usuario))
                @if ($usuario->isNotEmpty())
                    @foreach ($usuario as $data)
                                <form name="loans_store" id="loans_store" method="POST"
                                    action="{{ route('loans.store') }}">
                                    <div class="container text-justify">
                                        <div class="row">
                                            <div class="col">
                                                <br>
                                                <p> Nombre del Deudor: {{ $data->Nombre }} </p>
                                                <p> Cédula o RUC: {{ $data->Cedula }} </p>
                                                <p> Monto Gobal total pendiente: 00.00</p>
                                            </div>
                                            <div class="col">
                                                <br>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#bpartnerModal">Nuevo prestamo</button><br>
                                                <br>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#bpartnerModalPago">Pago Prestamo</button>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="modal fade" id="bpartnerModal" tabindex="-1"
                                        aria-labelledby="bpartnerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="bpartnerModalLabel">Nuevo
                                                        prestamo</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <label>Fecha</label>
                                                    <input name="FechaNuevoPrestamo" type="date" class="form-control"
                                                        required>

                                                    <br>

                                                    <label>Monto</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">$</span>
                                                        <input name="Monto" type="number" class="form-control"
                                                            aria-label="Amount (to the nearest dollar)" required>
                                                    </div>

                                                    <br>
                                                    <label>Monto cuota</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">$</span>
                                                        <input name="Cuota" type="number" class="form-control"
                                                            aria-label="Amount (to the nearest dollar)" required>
                                                    </div>

                                                    <br>
                                                    <label>Frecuencia</label>
                                                    <select class="form-select" name="Frecuencia" required="">
                                                        <option selected="" disabled="" value="">Seleccione
                                                        </option>
                                                        <option value="Diario">Diario</option>
                                                        <option value="Semanal">Semanal</option>
                                                        <option value="Quincenal">Quincenal</option>
                                                        <option value="Mensual">Mensual</option>
                                                    </select>

                                                    <br>
                                                    <label>Adjuntar Foto Recibo</label>
                                                    <input class="form-control" type="file" id="filePicker"
                                                        placeholder="Recibo" name="FileCedula" value="0"
                                                        accept=".png, .jpg, .jpeg" required>
                                                    <textarea style="display:none;" name="Filecedula" id="base64textarea" placeholder="Base64 will appear here"
                                                        cols="50" rows="15"></textarea>
                                                    <br> <br>
                                                    <label>Firma</label>
                                                    <div>
                                                        <center>
                                                            @include('canvas/tablero3')
                                                            <input type="hidden" id="myText3"
                                                                name="FirmaNuevoPrestamo" value="Firma No File" required>
                                                            <button class="btn btn-primary mh-100" type='button'
                                                                onclick='LimpiarTrazado3()'>Borrar</button>
                                                        </center>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <div class="row">
                                                        <div class="col">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                        <div class="col">
                                                            <button onclick="allfuncion()" type="submit"
                                                                class="btn btn-primary">Guardar</button>
                                                        </div>
                                                        <script type="text/javascript">
                                                            function allfuncion() {
                                                                b64img3();
                                                            }
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>


                                    <div class="modal fade" id="bpartnerModalPago" tabindex="-1"
                                        aria-labelledby="bpartnerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="bpartnerModalLabel">Pago Prestamo
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <label>Fecha</label>
                                                    <input name="DateTrx" type="date" value=""
                                                        class="form-control" required>
                                                    <br>

                                                    <label>Seleccionar un prestamo</label>
                                                    <select class="form-select" aria-label="Default select example"
                                                        required>
                                                        <option selected>Seleccione</option>
                                                        <option value="1">Abono Global</option>
                                                        <option value="2">Pretamo XX</option>
                                                        <option value="3">Pretamo YY</option>
                                                        <option value="4">Pretamo ZZ</option>
                                                    </select>
                                                    <br>
                                                    <label>Deuda</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">$</span>
                                                        <input type="number" class="form-control"
                                                            aria-label="Amount (to the nearest dollar)" readonly
                                                            value="0.00">
                                                    </div>

                                                    <label>Monto a Pagar</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">$</span>
                                                        <input type="number" class="form-control"
                                                            aria-label="Amount (to the nearest dollar)">
                                                    </div>
                                                    <br>

                                                </div>
                                                <div class="modal-footer">
                                                    <div class="row">
                                                        <div class="col">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                        <div class="col">
                                                            <button type="submit"
                                                                class="btn btn-primary">Guardar</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                          
                    @endforeach
                @else
                    <br>
                    <form name="loans_bpartnerstore" id="loans_bpartnerstore" method="POST"
                        action="{{ route('loans.bpartnerstore') }}">
                        @csrf
                        <div class="container text-justify">
                            <h2> Creacion de nuevo cliente </h2>
                            <div class="row">
                                <div class="col">

                                    <label>Nombre del Deudor</label>
                                    <input name="Nombre" value="" type="text"
                                        class=" form-control text-left  w-100 " placeholder="" required>
                                    <label>Telefono</label>
                                    <input name="Telefono" value="" type="text"
                                        class=" form-control text-left  w-100 " placeholder="" required>
                                    <label>Direccion</label>
                                    <input name="Direccion" value="" type="text"
                                        class=" form-control text-left  w-100 " placeholder="" required><br>
                                </div>
                                <div class="col">

                                    <label>Cédula o RUC</label>
                                    <input name="Cedula" value="" type="text"
                                        class=" form-control text-left  w-100 " placeholder="" required>
                                    <label>Solicitante</label>
                                    <input name="Solicitante" value="" type="text"
                                        class=" form-control text-left  w-100 " placeholder="" required>
                                    <label>Adjuntar Foto Cedula</label>
                                    <input name="FotoCedula" class="form-control" type="file" id="Filecedula"
                                        value="0" required><br>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-success my-auto active ">Guardar</button>
                                <br><br>
                                <a href="{{ url('loanscancel') }}" class="btn btn-secondary active my-auto"
                                    role="button" aria-pressed="true">Cancelar</a>
                            </div>
                        </div>
                    </form>
                @endif
            @endif


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
    <script>
        var handleFileSelect = function(evt) {
            var files = evt.target.files;
            var file = files[0];

            if (files && file) {
                var reader = new FileReader();

                reader.onload = function(readerEvt) {
                    var binaryString = readerEvt.target.result;
                    document.getElementById("base64textarea").value = btoa(binaryString);
                };

                reader.readAsBinaryString(file);
            }
        };

        if (window.File && window.FileReader && window.FileList && window.Blob) {
            document.getElementById('filePicker')
                .addEventListener('change', handleFileSelect, false);
        } else {
            alert('The File APIs are not fully supported in this browser.');
        }
    </script>
@endsection
