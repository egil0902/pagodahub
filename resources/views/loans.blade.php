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
        <div class="card w-auto">

            <div class="card-header">
                Consultar Deudor
            </div>
            <div class="card-body">
                <form name="loans_search" id="loans_search" method="get" action="{{ route('loans.search') }}">
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
                    <br>
                    <div class="row gy-2 gx-3 align-items-center">
                        <div class="col-md">
                            <label>Nro. Identificación</label>
                            <input name="cedula" value="" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="col-md">
                            <label>Nombre</label>
                            <input name="nombre" value="" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="col-md">
                            <label> </label>
                            <button type="submit" class="form-control btn btn-primary">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
        @if (isset($usuario))
            <div class="card w-auto">
                <div class="card-body">
                    @if ($usuario->isNotEmpty())
                        @foreach ($usuario as $data)
                            <div class="container bg-primary p-2 text-dark bg-opacity-10">
                                <h2> Datos Deudor </h2>
                                <div class="row row-cols-2 row-cols-sm-2  row-cols-md-4 text-start">
                                    <div class="col">
                                        <p class=""> Nombre del deudor:</p>
                                        <p class=""> Cédula o RUC:</p>

                                    </div>
                                    <div class="col">
                                        <p class=""> {{ $data->nombre }} </p>
                                        <p class=""> {{ $data->cedula }} </p>
                                    </div>
                                    <div class="col">
                                        <p class=""> Total de presetamos:</p>
                                        <p class=""> Total de pagos:</p>
                                    </div>
                                    <div class="col">
                                        @if (isset($loan_view[0]->sum))
                                            <p class="">$ {{ $loan_view[0]->sum }} </p>
                                        @else
                                            <p class="">$ 0 </p>
                                        @endif

                                        @if (isset($payment_view[0]->sum))
                                            <p class="">$ {{ $payment_view[0]->sum }} </p>
                                        @else
                                            <p class="">$ 0 </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row row-cols-2 row-cols-sm-2 ">
                                    <div class="col text-end">
                                        <p class=""> Saldo pendiente:</p>
                                    </div>
                                    <div class="col text-start ">
                                        @if (isset($usuario_monto))
                                            @foreach ($usuario_monto as $info)
                                                @if (isset($usuario_payment[0]->sum))
                                                    <p >$ {{ $info->sum - $usuario_payment[0]->sum }}
                                                    </p>
                                                @else
                                                    <p >$ {{ $info->sum - 0 }}</p>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                <button type="button" class="btn btn-success w-100 mb-1" data-bs-toggle="modal"
                                    data-bs-target="#bpartnerModal">Nuevo prestamo</button><br>
                                <button type="button" class="btn btn-primary w-100 mb-1" data-bs-toggle="modal"
                                    data-bs-target="#bpartnerModalPago">Pago Prestamo</button>
                            </div>

                            <form name="loans_store_new" id="loans_store_new" method="POST"
                                action="{{ route('loans.store_new') }}">
                                @csrf
                                <div class="modal fade" id="bpartnerModal" tabindex="-1"
                                    aria-labelledby="bpartnerModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <input type="hidden" name="cedula_user" value="{{ $data->cedula }}"
                                                type="text" class=" form-control text-left  w-100 " placeholder=""
                                                required>
                                            <input type="hidden" name="nombre_user" value="{{ $data->nombre }}"
                                                type="text" class=" form-control text-left  w-100 " placeholder=""
                                                required>
                                            <input type="hidden" name="loans_users_id" value="{{ $data->id }}"
                                                type="text" class=" form-control text-left  w-100 " placeholder=""
                                                required>

                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="bpartnerModalLabel">Nuevo
                                                    prestamo</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label>Fecha</label>
                                                <input name="fechanuevoprestamo" type="date" class="form-control"
                                                    required>

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
                                                                aria-label="Amount (to the nearest dollar)"
                                                                value="0">
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
                                                <input name="datepayment" type="date" value=""
                                                    class="form-control" required>
                                                <br>
                                                <input name="loans_users_id" type="hidden"
                                                    value="{{ $usuario[0]->id }}" class="form-control">

                                                <label>Seleccionar un prestamo</label>
                                                <select id="cc" class="form-select"
                                                    aria-label="Default select example" required onchange="deuda()"
                                                    onkeyup="deuda()">
                                                    @if (isset($usuario_monto))
                                                        @foreach ($usuario_monto as $info)
                                                            <option selected value="all">Abono
                                                                Global</option>
                                                        @endforeach
                                                    @endif
                                                    @if (isset($usuario_loans))
                                                        @foreach ($usuario_loans as $info)
                                                            <option value="{{ $info->id }}">
                                                                Fecha: {{ $info->fechanuevoprestamo }} -----
                                                                Monto: {{ $info->monto }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <br>
                                                <div hidden class="input-group mb-3">
                                                    <span hidden class="input-group-text">$</span>
                                                    <input hidden name="loans_id" class="form-control" type="text"
                                                        placeholder="Disabled input" id="xyz">
                                                </div>
                                                <label>Monto a Pagar</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">$</span>
                                                    <input name="amount" type="number" class="form-control"
                                                        aria-label="Amount (to the nearest dollar)">
                                                </div>
                                                <br>
                                                <label>Adjuntar Foto *Pago*</label>
                                                <input class="form-control" type="file" id="filePicker2"
                                                    placeholder="Recibo" name="filee" value="0"
                                                    accept=".png, .jpg, .jpeg" required>
                                                <textarea style="display:none;" name="file" id="base64textarea2" placeholder="Base64 will appear here"
                                                    cols="50" rows="15"></textarea>
                                                <br>
                                                <br>
                                                <label>Firma *Pago*</label>
                                                <div>
                                                    <center>
                                                        @include('canvas/tablero4')
                                                        <input type="hidden" id="myText4" name="signature"
                                                            value="Firma No File" required>
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
                                                            b64img4();
                                                        }
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    @else
                        <form name="loans_newuser" id="loans_newuser" method="POST"
                            action="{{ route('loans.newuser') }}">
                            @csrf

                            <div class="container bg-success p-2 text-dark bg-opacity-10">
                                <h2> Creacion Deudor </h2>
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                    <div class="co-md">
                                        <label>Nombre del Deudor</label>
                                        <input name="nombre" value="{{ $nombre }}" type="text"
                                            class=" form-control text-left  w-100 " placeholder="" required>
                                    </div>
                                    <div class="col-md">
                                        <label>Cédula o RUC</label>
                                        <input name="cedula" value="{{ $cedula }}" type="text"
                                            class=" form-control text-left  w-100 " placeholder="" required>
                                    </div>
                                    <div class="col-md">
                                        <label>Telefono</label>
                                        <input name="telefono" value="" type="text"
                                            class=" form-control text-left  w-100 " placeholder="" required>
                                    </div>
                                    <div class="col-md">
                                        <label>Solicitante</label>
                                        <input name="solicitante" value="" type="text"
                                            class=" form-control text-left  w-100 " placeholder="" required>
                                    </div>
                                    <div class="col-md">
                                        <label>Direccion</label>
                                        <input name="direccion" value="" type="text"
                                            class=" form-control text-left  w-100 " placeholder="" required><br>
                                    </div>
                                    <div class="col-md">
                                        <label>Adjuntar Foto Cedula</label>
                                        <input class="form-control" type="file" id="filePicker" placeholder="Cedula"
                                            name="" value="0" accept=".png, .jpg, .jpeg" required>
                                        <textarea style="display:none;" name="fotocedula" id="base64textarea" placeholder="Base64 will appear here"
                                            cols="50" rows="15"></textarea>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success my-auto active w-100 mb-1">Guardar</button>
                                <a href="{{ url('loans_search') }}" class="btn btn-secondary active my-auto w-100 mb-1"
                                    role="button" aria-pressed="true">Cancelar</a>
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        @endif

        <br>

        <div class="card w-auto">
            <div class="card-header">
                Estado de cuenta de prestamos
            </div>
            <div class="card-body">
                @livewire('loanssearch')
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
                        document.getElementById("base64textarea2").value = btoa(binaryString);
                    };
                    reader.readAsBinaryString(file);
                }
            };
            if (window.File && window.FileReader && window.FileList && window.Blob) {
                document.getElementById('filePicker').addEventListener('change', handleFileSelect, false);
                document.getElementById('filePicker2').addEventListener('change', handleFileSelect, false);
            } else {
                alert('The File APIs are not fully supported in this browser.');
            }
        </script>
    </body>
@endsection
