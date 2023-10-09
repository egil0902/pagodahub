@extends('layouts.app')
@section('title', 'Page Title')


@if (session('mensaje'))
    <div class="alert alert-success">{{ session('mensaje') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
@section('content')
<div class="p-2 m-0 border-0 bd-example">
    <div class="d-flex">
        <!-- Formulario de búsqueda por proveedor -->
        <div class="container">
            <div class="card">
                <div class="card-header">Facturas</div>
                <div class="card-body">
                    <!-- Formulario para envio-->
                    <form name="provider" id="provider" method="post" action="{{ route('invoice.create') }}">
                        @csrf
                        @method('POST')
                        <div class="col-md-6 mb-3">
                            <label for="fecha_ingreso">Fecha de Ingreso</label>
                            <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" placeholder="" value="<?php echo date("Y-m-d"); ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="responsable_ingreso">Responsable</label>
                            <input type="text" class="form-control" id="responsable_ingreso" name="responsable_ingreso" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="proveedor">Proveedor</label>
                            <input type="text" class="form-control" id="proveedor" name="proveedor" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="monto_total">Monto Excento</label>
                            <input type="number" class="form-control" id="monto_total" name="monto_total" step="0.01" required>
                        </div>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                // Función para calcular el ITBMS y actualizar los campos
                                function calcularITBMS(monto, porcentaje, campoResultado) {
                                    const montoITBMS = monto * porcentaje;
                                    $(campoResultado).val(montoITBMS.toFixed(2));
                                }

                                // Escucha los cambios en los campos de monto y realiza los cálculos
                                $('#monto_7').on('input', function() {
                                    const monto = parseFloat($(this).val());
                                    const porcentaje = 0.07;
                                    calcularITBMS(monto, porcentaje, '#monto_impuesto_7');
                                });

                                $('#monto_10').on('input', function() {
                                    const monto = parseFloat($(this).val());
                                    const porcentaje = 0.10;
                                    calcularITBMS(monto, porcentaje, '#monto_impuesto_10');
                                });

                                $('#monto_15').on('input', function() {
                                    const monto = parseFloat($(this).val());
                                    const porcentaje = 0.15;
                                    calcularITBMS(monto, porcentaje, '#monto_impuesto_15');
                                });
                            });
                        </script>

                        <div class="col-md-6 mb-3">
                            <label for="monto_7">Monto al que aplica ITBMS del 7%</label>
                            <input type="number" class="form-control" id="monto_7" name="monto_7" step="0.01" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="monto_impuesto_7">ITBMS7%</label>
                            <input type="number" class="form-control" id="monto_impuesto_7" name="monto_impuesto_7" step="0.01" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="monto_10">Monto al que aplica ITBMS del 10%</label>
                            <input type="number" class="form-control" id="monto_10" name="monto_10" step="0.01" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="monto_impuesto_10">ITBMS10%</label>
                            <input type="number" class="form-control" id="monto_impuesto_10" name="monto_impuesto_10" step="0.01" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="monto_15">Monto al que aplica ITBMS del 15%</label>
                            <input type="number" class="form-control" id="monto_15" name="monto_15" step="0.01" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="monto_impuesto_15">ITBMS15%</label>
                            <input type="number" class="form-control" id="monto_impuesto_15" name="monto_impuesto_15" step="0.01" disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="fecha_pago">Fecha de Pago</label>
                            <input type="date" class="form-control" id="fecha_pago" name="fecha_pago" placeholder="" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="forma_pago">Forma de Pago</label>
                            <select class="form-control" id="forma_pago" name="forma_pago" required>
                                <option value="" disabled selected>Selecciona una forma de pago</option>
                                <option value="credito">Crédito</option>
                                <option value="banco">Banco</option>
                                <option value="caja">Caja</option>
                                <option value="tarjeta_credito">Tarjeta de Crédito</option>
                            </select>
                        </div>

                        <!-- Fields for displaying based on forma_pago selection -->
                        <div class="col-md-6 mb-3" id="creditoFields" class="form-group" style="display: none;">
                            <label for="credito_options">Opciones para Crédito</label>
                            <select class="form-control" id="credito_options" name="credito_options">
                                <option value="cheque">Cheque</option>
                                <option value="ach">ACH</option>
                            </select>
                            <label for="banco_credito">Banco</label>
                            <input type="text" class="form-control" id="banco_credito" name="banco_credito">
                            <label for="num_comprobante_credito">Número de Comprobante</label>
                            <input type="text" class="form-control" id="num_comprobante_credito" name="num_comprobante_credito">
                        </div>

                        <div class="col-md-6 mb-3" id="bancoFields" class="form-group" style="display: none;">
                            <label for="banco_options">Opciones para Banco</label>
                            <select class="form-control" id="banco_options" name="banco_options">
                                <option value="" disabled selected>Selecciona una forma de pago</option>
                                <option value="efectivo">Efectivo</option>
                                <option value="loteria">Lotería</option>
                                <option value="cheque">Cheque</option>
                            </select>
                            <div id="bancoDesc" class="form-group" style="display: none;">
                                <label for="banco_banco">Banco</label>
                                <input type="text" class="form-control" id="banco_banco" name="banco_banco">
                                <label for="num_comprobante">Número de Cheque</label>
                                <input type="text" class="form-control" id="num_comprobante"  name="num_comprobante">
                            </div>
                            <div id="efectivoDesc" class="form-group" style="display: none;">
                                <label for="presupuest_banco">Valor</label>
                                <input type="number" class="form-control" id="presupuest_banco" step="0.01" name="presupuest_banco">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3" id="tarjetaFields" class="form-group" style="display: none;">
                            <label for="tarjeta">Tarjetas</label>
                            <select class="form-control" id="tarjeta" name="tarjeta">
                                @foreach($tarjetas as $tarjeta)
                                    <option value="{{ $tarjeta->numero }}">{{ $tarjeta->numero }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md">
                            <label for="formFileMultiple" class="form-label">Adjuntar foto bolsa</label>
                            <input class=" subirimagen form-control" type="file" id="filePicker"
                                placeholder="foto" name="FileCedula" value="0" onchange="imgsize()"
                                onkeyup="imgsize()" accept=".png" required>
                            <textarea style="display:none;" name="foto" id="base64textarea" placeholder="Base64 will appear here"
                                cols="50" rows="15"></textarea>
                            <br>
                            <center><img id="img1" class="rounded" src="" border="1"
                                    style="width: 50%;">
                            </center>
                            <script>                                            
                                var handleFileSelect = function(evt) {
                                    var files = evt.target.files;
                                    var file = files[0];
                                    if (files && file) {
                                        var reader = new FileReader();
                                        reader.onload = function(readerEvt) {
                                            var binaryString = readerEvt.target.result;
                                            document.getElementById("base64textarea").value = btoa(binaryString);
                                            document.getElementById("img1").src = "data:image/png;base64," + btoa(binaryString);

                                        };
                                        reader.readAsBinaryString(file);
                                    }
                                };
                                if (window.File && window.FileReader && window.FileList && window.Blob) {
                                    document.getElementById('filePicker').addEventListener('change', handleFileSelect, false);

                                } else {
                                    alert('The File APIs are not fully supported in this browser.');
                                }
                            </script>
                        </div>
                        <br>
                        <button class="btn btn-primary" type="submit">Crear Registro</button>
                    </form>

                    <script>
                        // JavaScript to show/hide fields based on forma_pago selection
                        const formaPagoSelect = document.getElementById('forma_pago');
                        const bancoSelect = document.getElementById('banco_options');
                        const creditoFields = document.getElementById('creditoFields');
                        const bancoFields = document.getElementById('bancoFields');
                        
                        const tarjetaFields = document.getElementById('tarjetaFields');
                        const bancoDesc = document.getElementById('bancoDesc');
                        const efectivoDesc= document.getElementById('efectivoDesc');

                        formaPagoSelect.addEventListener('change', (event) => {
                            creditoFields.style.display = event.target.value === 'credito' ? 'block' : 'none';
                            bancoFields.style.display = event.target.value === 'banco' ? 'block' : 'none';
                            tarjetaFields.style.display = event.target.value === 'tarjeta_credito' ? 'block' : 'none';
                        });
                        bancoSelect.addEventListener('change', (event) => {
                            bancoDesc.style.display = event.target.value === 'cheque' ? 'block' : 'none';
                            efectivoDesc.style.display = event.target.value === 'efectivo' ? 'block' : 'none';
                        });
                    </script>
                    <hr class="mb-4">                    
                </div>
            </div>
        
    </div>
    </div>
    </br>
    
</div>

    <style>
        .campo input {
            margin-bottom: 10px;
        }
        
        table {
            font-family: arial, sans-serif;
            background-color: white;
            text-align: left;
            border-collapse: collapse;
            width: 100%;
        }
        .table th {
            max-width: 100px; /* Establece el ancho máximo deseado */
            text-overflow: ellipsis; /* Agrega puntos suspensivos (...) si el contenido es demasiado largo */
            white-space: nowrap; /* Evita que el texto se divida en varias líneas */
        }
        th,
        td {
            padding: 1px;

        }
        

        thead {
            background-color: #246355;
            border-bottom: solid 5px #0F362D;
            color: white;
        }

        #theadtotal {
            background-color: #1b6453;
            border-bottom: solid 2.5px #268c74;
            border-top: solid 2.5px #268c74;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #ddd;
        }

        tr:hover td {
            background-color: #369681;
            color: white;
        }

        #imagenesPrevias {
            display: center;
            flex-wrap: wrap;
        }

        #imagenesPrevias img {
            max-width: 75%;
            height: auto;
            margin: 5px;
            border: 1px solid;
        }
        .divider {
        width: 15px;
        }
    </style>
@endsection