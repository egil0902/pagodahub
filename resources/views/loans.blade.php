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
                                <input name="cedula" value="" type="text" class="form-control text-left"
                                    placeholder="">
                            </div>
                            <div class="col-md-4 col-4 col-sm-4  ">
                                <label>Nombre</label>
                                <input name="nombre" value="" type="text" class="form-control text-left "
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
                        <div class="container text-justify">
                            <div class="row">
                                <div class="col">
                                    <br>
                                    <p> Nombre del Deudor:</p>
                                    <p> Cédula o RUC:</p>
                                    <p> Monto Gobal total pendiente:</p>
                                </div>
                                <div class="col">
                                    <br>
                                    <p> {{ $data->nombre }} </p>
                                    <p> {{ $data->cedula }} </p>
                                    <p>
                                        @if (isset($usuario_monto))
                                            @foreach ($usuario_monto as $info)
                                                {{ $info->sum - $usuario_payment[0]->sum}}
                                            @endforeach
                                        @endif
                                    </p>
                                </div>
                                <div class="col">
                                    <br>
                                    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal"
                                        data-bs-target="#bpartnerModal">Nuevo prestamo</button><br>
                                    <br>
                                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                        data-bs-target="#bpartnerModalPago">Pago Prestamo</button>
                                </div>
                            </div>
                        </div>
                        <form name="loans_store_new" id="loans_store_new" method="POST"
                            action="{{ route('loans.store_new') }}">
                            <div class="modal fade" id="bpartnerModal" tabindex="-1" aria-labelledby="bpartnerModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <input type="hidden" name="cedula_user" value="{{ $data->cedula }}" type="text"
                                            class=" form-control text-left  w-100 " placeholder="" required>

                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="bpartnerModalLabel">Nuevo
                                                prestamo</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label>Fecha</label>
                                            <input name="fechanuevoprestamo" type="date" class="form-control" required>

                                            <label>Monto</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">$</span>
                                                <input name="monto" type="number" class="form-control"
                                                    aria-label="Amount (to the nearest dollar)" required>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <label>Frecuencia</label>
                                                    <select id="fre" class="form-select" name="frecuencia"
                                                        onchange="deuda()" onkeyup="deuda()">
                                                        <option selected="" value="---">No Aplica</option>
                                                        <option value="Diario">Diario</option>
                                                        <option value="Semanal">Semanal</option>
                                                        <option value="Quincenal">Quincenal</option>
                                                        <option value="Mensual">Mensual</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label>Monto cuota</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">$</span>
                                                        <input id="cuo" name="cuota" type="number"
                                                            class="form-control"
                                                            aria-label="Amount (to the nearest dollar)" value="0">
                                                    </div>
                                                </div>
                                            </div>

                                            <label>Adjuntar Foto Recibo</label>
                                            <input class="form-control" type="file" id="filePicker"
                                                placeholder="Recibo" name="FileCedula" value="0"
                                                accept=".png, .jpg, .jpeg" required>
                                            <textarea style="display:none;" name="filecedula" id="base64textarea" placeholder="Base64 will appear here"
                                                cols="50" rows="15"></textarea>
                                            <br>
                                            <label>Firma</label>
                                            <div>
                                                <center>
                                                    @include('canvas/tablero3')
                                                    <input type="hidden" id="myText3" name="firmanuevoprestamo"
                                                        value="Firma No File" required>
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
                        </form>

                        <form name="loans_update" id="loans_update" method="POST"
                            action="{{ route('loans.update') }}">
                            @csrf
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
                                            <input name="datepayment" type="date" value="" class="form-control"
                                                required>
                                            <br>

                                            <input  name="loans_users_id" type="hidden" value="{{$usuario[0]->id}}" class="form-control">
                                            <br>

                                            <label>Seleccionar un prestamo</label>
                                            <select id="cc" class="form-select"
                                                aria-label="Default select example" required onchange="deuda()"
                                                onkeyup="deuda()">
                                                @if (isset($usuario_monto))
                                                    @foreach ($usuario_monto as $info)
                                                        <option selected value="{{ $info->sum }}">Abono
                                                            Global</option>
                                                    @endforeach
                                                @endif
                                                @if (isset($usuario_loans))
                                                    @foreach ($usuario_loans as $info)
                                                        <option value="{{ $info->monto }} {{ $info->id }}">
                                                            Fecha: {{ $info->fechanuevoprestamo }} -----
                                                            Monto: {{ $info->monto }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <br>
                                            <div  hidden class="input-group mb-3">
                                                <span hidden class="input-group-text">$</span>
                                                <input  hidden name="loans_id" class="form-control" type="text"
                                                    placeholder="Disabled input" id="xyz">
                                            </div>
                                            <label>Monto a Pagar</label>
                                            <div class="input-group mb-3">
                                                <span  class="input-group-text">$</span>
                                                <input name="amount" type="number" class="form-control"
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
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
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
                    <form name="loans_newuser" id="loans_newuser" method="POST" action="{{ route('loans.newuser') }}">
                        @csrf
                        <br>
                        <div class="container text-justify">
                            <h2> Creacion de nuevo cliente </h2>
                            <div class="row">
                                <div class="col">
                                    <label>Nombre del Deudor</label>
                                    <input name="nombre" value="{{ $nombre }}" type="text"
                                        class=" form-control text-left  w-100 " placeholder="" required>
                                    <label>Telefono</label>
                                    <input name="telefono" value="" type="text"
                                        class=" form-control text-left  w-100 " placeholder="" required>
                                    <label>Direccion</label>
                                    <input name="direccion" value="" type="text"
                                        class=" form-control text-left  w-100 " placeholder="" required><br>
                                </div>
                                <div class="col">
                                    <label>Cédula o RUC</label>
                                    <input name="cedula" value="{{ $cedula }}" type="text"
                                        class=" form-control text-left  w-100 " placeholder="" required>
                                    <label>Solicitante</label>
                                    <input name="solicitante" value="" type="text"
                                        class=" form-control text-left  w-100 " placeholder="" required>
                                    <label>Adjuntar Foto Cedula</label>
                                    <input class="form-control" type="file" id="filePicker" placeholder="Cedula"
                                        name="" value="0" accept=".png, .jpg, .jpeg" required>
                                    <textarea style="display:none;" name="fotocedula" id="base64textarea" placeholder="Base64 will appear here"
                                        cols="50" rows="15"></textarea>
                                    <br>
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
    <br>
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
        window.onload = function() {
            deuda();
        }

        function deuda() {
            document.getElementById("xyz").value = document.getElementById("cc").value;
            const cambio = document.getElementById("cuo");
            if ('---' == document.getElementById("fre").value) {

                cambio.setAttribute('disabled');
                //cambio.classList.replace("text-success", "text-danger");
            } else {
                cambio.removeAttribute('disabled');
                cambio.setAttribute('enable');
            }

        }
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
