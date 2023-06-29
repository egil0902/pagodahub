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

    <div class="container">
        
            <div class="card w-auto">
                <div class="card-body shadow p-1 mb-1 bg-body-tertiary rounded">
                    @if ($usuario->isNotEmpty())
                        {{--  Modal Inicio --}}
                            @foreach ($usuario as $data)
                                <br>
                                <div class="container bg-primary p-2 text-dark bg-opacity-10 shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                                    <h2> Datos Deudor </h2>
                                    <div class="row row-cols-2 row-cols-sm-2  row-cols-md-4">
                                        <div class="col">
                                            <p class="lh-1">Nombre del deudor:</p>
                                            <p class="lh-1">Cédula o RUC:</p>
                                        </div>
                                        <div class="col">
                                            <p class="lh-1">{{ $data->nombre }}</p>
                                            <p class="lh-1">{{ $data->cedula }}</p>
                                        </div>
                                        <div class="col">
                                            <p class="lh-1">Total de prestamos:</p>
                                            <p class="lh-1">Total de pagos:</p>
                                            <p class="lh-1">Saldo pendiente:</p>
                                        </div>
                                        <div class="col">
                                            @if (isset($loan_view[0]->sum))
                                                <p class="lh-1 ">$
                                                    @php
                                                        echo number_format($loan_view[0]->sum, 2, ',', ' ');
                                                    @endphp
                                                </p>
                                            @else
                                                <p class="lh-1">$ 0,00</p>
                                            @endif

                                            @if (isset($payment_view[0]->sum))
                                                <p class="lh-1">$
                                                    @php
                                                        echo number_format($payment_view[0]->sum, 2, ',', ' ');
                                                    @endphp
                                                </p>
                                            @else
                                                <p class="lh-1">$ 0,00</p>
                                            @endif
                                            @if (isset($usuario_monto))
                                                @foreach ($usuario_monto as $info)
                                                    @if (isset($usuario_payment[0]->sum))
                                                        <p class="lh-1">$

                                                            @php
                                                                echo number_format($info->sum - $usuario_payment[0]->sum, 2, ',', ' ');
                                                            @endphp

                                                        </p>
                                                    @else
                                                        <p class="lh-1">$
                                                            @php
                                                                echo number_format($info->sum - 0, 2, ',', ' ');
                                                            @endphp
                                                        </p>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="col">
                                        </div>
                                        <div class="col">
                                        </div>
                                    </div>
                                    <div class="row row-cols-2 row-cols-sm-2 ">

                                    </div>
                                    <br>
                                    <!--MODIFICAR RUTA-->
                                    @if($tipo=="Prestamo")
                                    <form name="loans_store_new" id="loans_store_new" method="POST"
                                        action="{{ route('loans.updateLoan') }}" style="display: block;">
                                        @csrf
                                        <div class="card card-body  border-success shadow p-3 mb-5 bg-body-tertiary rounded">
                                            <input type="hidden" name="id_payment" value="{{ $loan[0]->id }}"
                                                type="text" class=" form-control text-left  w-100 " placeholder=""
                                                required>
                                            <input type="hidden" name="cedula_user" value="{{ $data->cedula }}"
                                                type="text" class=" form-control text-left  w-100 " placeholder=""
                                                required>
                                            <input type="hidden" name="nombre_user" value="{{ $data->nombre }}"
                                                type="text" class=" form-control text-left  w-100 " placeholder=""
                                                required>
                                            <input type="hidden" name="loans_users_id" value="{{ $data->id }}"
                                                type="text" class=" form-control text-left  w-100 " placeholder=""
                                                required>
                                            <input type="hidden" name="loan_id" value="{{ $loan[0]->id }}"
                                                type="text" class=" form-control text-left  w-100 " placeholder=""
                                                required>
                                            <h1 class="modal-title fs-5 text-success" id="bpartnerModalLabel">Nuevo
                                                prestamo</h1>

                                            <label>Fecha</label>
                                            <input id="min-max" name="fechanuevoprestamo" type="date"
                                                class="form-control" min="2022-01-01" max="2100-12-31" value="{{$loan[0]->fechanuevoprestamo}}" required>
                                            
                                            <label>Monto</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">$</span>
                                                <input name="monto" type="number" placeholder="0.00" step="0.01"
                                                    class="form-control" aria-label="Amount (to the nearest dollar)" value="{{$loan[0]->monto}}"
                                                    required>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                <label>Frecuencia</label>
                                                <select id="fre" class="form-select" name="frecuencia" onchange="deuda()" onkeyup="deuda()">
                                                    <option value="---" @if($loan[0]->frecuencia == '---') selected @endif>No Aplica</option>
                                                    <option value="Diario" @if($loan[0]->frecuencia == 'Diario') selected @endif>Diario</option>
                                                    <option value="Semanal" @if($loan[0]->frecuencia == 'Semanal') selected @endif>Semanal</option>
                                                    <option value="Quincenal" @if($loan[0]->frecuencia == 'Quincenal') selected @endif>Quincenal</option>
                                                    <option value="Mensual" @if($loan[0]->frecuencia == 'Mensual') selected @endif>Mensual</option>
                                                </select>

                                            </div>
                                                <div class="col">
                                                    <label>Monto cuota</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">$</span>
                                                        <input id="cuo" name="cuota" type="number"
                                                            placeholder="0.00" step="0.01" class="form-control"
                                                            aria-label="Amount (to the nearest dollar)" value="{{$loan[0]->cuota}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <label>Adjuntar Foto Recibo (opcional)</label>
                                            <input class=" subirimagen form-control" type="file" id="filePicker"
                                                placeholder="Recibo" name="FileCedula" value="0"
                                                onchange="imgsize()" onkeyup="imgsize()" accept=".png, .jpg, .jpeg"
                                                >
                                            <textarea style="display:none;" name="filecedula" id="base64textarea" placeholder="Base64 will appear here"
                                                cols="50" rows="15"></textarea>
                                            <br>
                                            <label>Firma (opcional)</label>
                                            <div>
                                                <center>
                                                    @include('/canvas/tablero3')
                                                    <input type="hidden" id="myText3" name="firmanuevoprestamo"
                                                        value="Firma No File">

                                                </center>
                                            </div>
                                            <div class="row">
                                                {{-- <div class="col">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="collapse">Cerrar</button>
                                            </div> --}}
                                                <div class="col">
                                                    <button onclick="allfuncion()" type="submit"
                                                        class="btn btn-primary w-100">Modificar</button>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                    @endif
                                    @if($tipo=="Pago")
                                    <form name="loans_update" id="loans_update" method="POST"
                                        action="{{ route('loans.updatePayment') }}">
                                        @csrf
                                        <div class="card card-body border-info shadow p-3 mb-5 bg-body-tertiary rounded">
                                            <input type="hidden" name="id_payment" value="{{ $loan[0]->id }}"
                                                type="text" class=" form-control text-left  w-100 " placeholder=""
                                                required>
                                            <input type="hidden" name="cedula_user" value="{{ $data->cedula }}"
                                                type="text" class=" form-control text-left  w-100 " placeholder=""
                                                required>
                                            <input type="hidden" name="nombre_user" value="{{ $data->nombre }}"
                                                type="text" class=" form-control text-left  w-100 " placeholder=""
                                                required>
                                            <h1 class="modal-title fs-5 text-primary" id="bpartnerModalLabel">Pago
                                                Prestamo
                                            </h1>
                                            <label>Fecha</label>
                                            <input id="min-max2" name="datepayment" type="date" value="{{$loan[0]->datepayment}}" class="form-control"
                                                required>

                                            <script>
                                                // Obtener la fecha actual
                                                var hoy = new Date();
                                                // Restar 3 días a la fecha actual
                                                // Establecer el atributo min en el campo de fecha con la fecha de hace 3 días
                                                document.getElementById("min-max2").max = hoy.toISOString().split("T")[0];
                                            </script>
                                            <br>
                                            <input name="loans_users_id" type="hidden" value="{{ $usuario[0]->id }}"
                                                class="form-control">
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
                                                {{-- @if (isset($usuario_loans))
                                                        @foreach ($usuario_loans as $info)
                                                            <option value="{{ $info->id }}">
                                                                Fecha: {{ $info->fechanuevoprestamo }} -----
                                                                Monto: {{ $info->monto }}
                                                            </option>
                                                        @endforeach
                                                    @endif --}}
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
                                                <input name="amount" type="number" placeholder="0.00" step="0.01" value="{{$loan[0]->amount}}"
                                                    class="form-control" aria-label="Amount (to the nearest dollar)">
                                            </div>
                                            <br>
                                            <label>Adjuntar Foto *Pago*</label>
                                            <input class=" subirimagen2 form-control" type="file" id="filePicker2"
                                                placeholder="Recibo" name="filee" value="0" onchange="imgsize2()"
                                                onkeyup="imgsize2()" accept=".png, .jpg, .jpeg" >
                                            <textarea style="display:none;" name="file" id="base64textarea2" placeholder="Base64 will appear here"
                                                cols="50" rows="15"></textarea>
                                            <br>
                                            <br>
                                            <label>Firma *Pago*</label>
                                            <div>
                                                <center>
                                                    @include('canvas/tablero4')
                                                    <input type="hidden" id="myText4" name="signature"
                                                        value="Firma No File" >
                                                </center>
                                            </div>
                                            <div class="row">
                                                {{-- <div class="col">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                            </div> --}}
                                                <div class="col">
                                                    <button onclick="allfuncion()" type="submit"
                                                        class="btn btn-primary w-100">Guardar</button>
                                                </div>

                                            </div>

                                        </div>
                                    </form>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                </div>
            </div>
        <script>
            window.onload = function() {
                deuda();
                var today = new Date();

                var day = today.getDate();
                var month = today.getMonth() + 1;
                var year = today.getFullYear();
                console.log(`${year}-${month}-${day}`);
                document.getElementById('loans_store_new').style.display = 'none';
                document.getElementById('loans_update').style.display = 'none';
            }

            function allfuncion() {
                b64img3();
                b64img4();
            }

            function ocultar() {

            }

            function busqueda() {


                if (document.getElementById("cedula").value == "") {
                    //alert("blanco");
                    document.getElementById("nombre").removeAttribute("disabled", "")
                } else {
                    //alert("lleno");
                    document.getElementById("nombre").value = "";
                    document.getElementById("nombre").setAttribute("disabled", "");
                }

                if (document.getElementById("nombre").value == "") {
                    //alert("blanco");
                    document.getElementById("cedula").removeAttribute("disabled", "")
                } else {
                    //alert("lleno");
                    document.getElementById("cedula").value = "";
                    document.getElementById("cedula").setAttribute("disabled", "");
                }
            }

            /* function imgsize() {
                                var imgsize = document.getElementsByClassName("subirimagen")[0].files[0].size;
                                if (imgsize > 5000000) {
                                    alert('El archivo supera los 5Mb.');
                                    document.getElementsByClassName("subirimagen").filePicker.value = "";
                                }
                            }

                            function imgsize2() {
                                var imgsize2 = document.getElementsByClassName("subirimagen2")[0].files[0].size;
                                if (imgsize2 > 5000000) {
                                    alert('El archivo supera los 5Mb.');
                                    document.getElementsByClassName("subirimagen2").filePicker2.value = "";
                                }
                            }
                 */


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


            ////
            const formulario = document.getElementById('loans_store_new');
            const boton = document.getElementById('Nuevo');

            boton.addEventListener('click', () => {
                if (formulario.style.display === 'none') {
                    formulario.style.display = 'block';
                    /* boton.textContent = 'Ocultar formulario'; */
                } else {
                    formulario.style.display = 'none';
                    /* boton.textContent = 'Mostrar formulario'; */
                }
            });


            const formulario2 = document.getElementById('loans_update');
            const boton2 = document.getElementById('Pago');

            boton2.addEventListener('click', () => {
                if (formulario2.style.display === 'none') {
                    formulario2.style.display = 'block';
                    /*  boton2.textContent = 'Ocultar formulario'; */
                } else {
                    formulario2.style.display = 'none';
                    /* boton2.textContent = 'Mostrar formulario'; */
                }
            });
            ////
        </script>
    </div>
