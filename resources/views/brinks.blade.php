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

                 
                <div class="card-header">Banco supervisor</div>
                <div class="card-body">
                    <!-- Formulario para envio-->
                    <form name="provider" id="provider" method="post" action="{{route( 'Brink.import' )}}">
                        <div class=" col-md-6 mb-3">
                            <label for="today">Fecha de hoy</label>
                            <input type="today" class="form-control" date-format="mm/dd/yyyy"
                                id="today" name="today" placeholder="" value="<?php echo date("Y-m-d"); ?>" readonly >
                                
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="start_date">Fecha Inicial</label>
                            <input type="date" class="form-control" id="startDate" name="startDate" min="{{ date('Y-m-d', strtotime('-30 days')) }}" max="{{ date('Y-m-d') }}" onchange="validateStartDate()" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="end_date">Fecha Final</label>
                            <input type="date" class="form-control" id="endDate" name="endDate" min="" max="{{ date('Y-m-d') }}" readonly required>
                        </div>
                        

                        <script>
                            function validateStartDate() {
                                var startDate = new Date(document.getElementById('startDate').value);
                                setEndDate(startDate);
                            }

                            function setEndDate(startDate) {
                                var endDate = new Date(startDate);
                                endDate.setDate(startDate.getDate() + 2 ); // Avanza 3 días desde la fecha inicial
                                document.getElementById('endDate').min = startDate.toISOString().split('T')[0];
                                document.getElementById('endDate').removeAttribute('readonly');
                            }
                        </script>
                        <div class="card-body">
                            <p for="cars" class="card-text">Sucursal</p>
                            <select class="form-control" name="AD_Org_ID" id="AD_Org_ID">
                                <option value="0">*</option>
                                @if (isset($orgs))
                                    @if (isset($orgs->records))
                                        @foreach ($orgs->records as $org)
                                            <option
                                                {{ isset($request->AD_Org_ID) ? ($request->AD_Org_ID == $org->id ? __('selected') : __('')) : __('') }}
                                                value="{{ $org->id }}">{{ $org->Name }}</option>
                                        @endforeach                                    
                                    @else
                                        @foreach ($orgs as $org)
                                            <option
                                                {{ isset($request->AD_Org_ID) ? ($request->AD_Org_ID == $org->id ? __('selected') : __('')) : __('') }}
                                                value="{{ $org->id }}">{{ $org->Name }}</option>
                                        @endforeach
                                    @endif
                                @endif
                            </select>
                        </div>
                        <input type="hidden" id="orgNameHidden" name="orgNameHidden" value="">
                        <script>
                            document.getElementById('AD_Org_ID').addEventListener('change', function() {
                                var selectedOption = this.options[this.selectedIndex];
                                var orgName = selectedOption.textContent;
                                document.getElementById('orgNameHidden').value = orgName;
                            });
                        </script>

                        <div class="form-group w-auto">
                            @csrf
                            <button class=" w-100 btn btn-outline-secondary m-0" type="submit" id="button-addon2">Importar</button>
                        </div>
                    </form>
                    <hr class="mb-4">
                        <script>
                            function validarFormulario() {
                                                // Obtener valores de los campos
                                                alert('Validación ejecutada.'); 
                                                const observaciones = document.getElementById('observaciones').value;
                                                const fileCedula = document.getElementById('filePicker').value;

                                                // Validar que los campos no estén vacíos
                                                if (observaciones.trim() === '') {
                                                    alert('Por favor, ingrese observaciones.');
                                                    return false; // Evita enviar el formulario
                                                }

                                                if (fileCedula.trim() === '') {
                                                    alert('Por favor, adjunte los reportes.');
                                                    return false; // Evita enviar el formulario
                                                }

                                                // Validar que se haya seleccionado una imagen
                                                const imgInput = document.getElementById('filePicker');
                                                if (imgInput.files.length === 0) {
                                                    alert('Por favor, seleccione una imagen.');
                                                    return false; // Evitfa enviar el formulario
                                                }

                                                // Si todo está bien, permite enviar el formulario
                                                return true;
                                            }
                        </script>
                        @if(isset($fecha_dia))
                        <form name="save" id="save" method="post" action="{{ route('Brink.store') }}">
                                    @csrf
                                    <input type="hidden" name="fecha_dia" value="{{ $fecha_dia }}">
                                    
                                    <input type="hidden" name="fecha_cierre" value="{{ $fecha_cierre }}">
                                    <input type="hidden" name="sucursal" value="{{ $sucursal }}">
                                    <div align="center" style='width:90%!important; padding-left:10%'>
                                        <table class="table table-borderless ">
                                            <thead id="miTablaPersonalizada">
                                                <tr>
                                                    <th>
                                                        <p class="card-text">Descripción</p>
                                                    </th>
                                                    <th>
                                                        <h5 align="center" class="mb-0 fw-bold" id="Montosistema_t">
                                                            Sub-Total
                                                        </h5>
                                                    </th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    
                                                <tr>
                                                    <td>Brink</td>
                                                    <td>
                                                    <input type="hidden" id="mult10" value="1">
                                                        <input name="requestBrink" id="requestBrink" style="margin-left: 25%;" value="{{ number_format($requestBrink, 2, '.', '') }}" onchange="calOne()" readonly
                                                            type="number" class="text-center form-control w-50" step="0.01">
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>Sencillo</td>
                                                    <td>
                                                    <input type="hidden" id="mult10" value="1">
                                                        <input name="sencillo" id="sencillo" style="margin-left: 25%;" value="{{ number_format($sencillo, 2, '.', '') }}" onchange="calOne()" readonly
                                                            type="number" class="text-center form-control w-50" step="0.01">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Dinero Gerencia</td>
                                                    <td>
                                                    <input type="hidden" id="mult11" value="1">
                                                        <input name="gerencia" id="gerencia" style="margin-left: 25%;" value="{{ number_format($gerencia, 2, '.', '') }}" onchange="calOne()" readonly
                                                            type="number" class="text-center  form-control w-50" step="0.01">
                                                        </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>Pago de Facturas</td>
                                                    <td>
                                                        <input name="payment" id="payment" style="margin-left: 25%;" value="{{ number_format($payment, 2, '.', '') }}" onchange="calOne()" readonly
                                                            type="number" class="text-center  form-control w-50" step="0.01">
                                                        </td>
                                                    
                                                </tr>
                                                
                                                <tr>
                                                    <td>Inicio banco</td>
                                                    <td>
                                                    <input type="hidden" id="mult14" value="1">
                                                        <input name="start" id="start" style="margin-left: 25%;" value="{{ number_format($start, 2, '.', '') }}" onchange="calOne()" readonly
                                                            type="number" class="text-center  form-control w-50" step="0.01">
                                                        </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>Total caja</td>
                                                    <td><input type="hidden" id="mult12" value="1">
                                                        <input name="cajas" id="cajas" style="margin-left: 25%;" value="{{ number_format($cajas, 2, '.', '') }}" onchange="calOne()" readonly
                                                            type="number" class="text-center  form-control w-50" step="0.01"></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>Total</td>
                                                    <td align="center">
                                                        <span name="BrinkresultColumn" id="BrinkresultColumn" step="0.01">{{ number_format($start+$requestBrink+$sencillo-$cajas-$payment-$gerencia, 2, '.', '') }}</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                        <div class="col-md">
                                            <h4>Observaciones:</h4>
                                            <textarea style="width:100%;" class="long-textarea" id="observaciones" name="observaciones" required></textarea>
                                        </div>
                                        <div class="col-md">
                                            <label for="formFileMultiple" class="form-label">Por favor adjunte los reportes</label>
                                            <input class="subirimagen form-control" type="file" id="filePicker" placeholder="Recibo" name="FileCedula" value="0" accept=".png">
                                            <textarea style="display:none;" name="foto" id="base64textarea" placeholder="Base64 will appear here" cols="50" rows="15"></textarea>
                                            <br>
                                            <center>
                                                <img id="img1" class="rounded" src="" border="1" style="width: 50%;">
                                            </center>
                                        </div>
                                        
                                        <div class="col-12" style="display: flex">
                                            @if(!isset($brink))
                                                <div class="col-4">
                                                    <button class="w-100 btn btn-outline-secondary m-0" type="button" onclick="submitForm('{{ route('Brink.store') }}')">Guardar</button>
                                                </div>
                                                <div class="col-4">                                                    
                                            </div>
                                            @else
                                                <div class="col-4">
                                                    <button class="w-100 btn btn-outline-secondary m-0" type="button" onclick="submitForm('{{ route('Brink.update') }}')">Actualizar</button>
                                                </div>
                                                    <div class="col-4">                                                    
                                                </div>
                                            @endif
                                        </div>
                                    </form>

                                    <script>
                                        

                                        window.submitForm = function(action) {
                                            document.getElementById('save').action = action;
                                            document.getElementById('save').submit();
                                            document.getElementById('save').onsubmit = function() {
                                                return validarFormulario();
                                            };
                                        };
                                        
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
                            </form>
                        @endif
                
                        </div>
            </div>
        <div class="card">
            <div class="card-header">
                Listado Banco supervisor
            </div>
            <div class="card-body">
                @livewire('App\Http\Livewire\BrinkSearch', ['orgs' => $orgs])
            </div>
        </div>
    </div>
    </div>
    </br>
    
</div>

    <style>
        
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