@extends('layouts.app')
@section('title', 'Page Title')


@if (session('mensaje'))
    <div class="alert alert-success">{{ session('mensaje') }}</div>
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
                            <input type="date" class="form-control" id="startDate" name="startDate" min="{{ date('Y-m-d', strtotime('-15 days')) }}" max="{{ date('Y-m-d') }}" onchange="validateStartDate()" required>
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
                                    @if ($orgs->{'records-size'} > 0)
                                        @foreach ($orgs->records as $org)
                                            <option
                                                {{ isset($request->AD_Org_ID) ? ($request->AD_Org_ID == $org->id ? __('selected') : __('')) : __('') }}
                                                value="{{ $org->id }}">{{ $org->Name }}</option>
                                        @endforeach
                                    @endif
                                @endif
                            </select>
                        </div>
                        <div class="form-group w-auto">
                            @csrf
                            <button class=" w-100 btn btn-outline-secondary m-0" type="submit" id="button-addon2">Importar</button>
                        </div>
                    </form>
                    <hr class="mb-4">
                    @if($request!=='')
                        @if(!isset($brink))
                            
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
                                                                <p class="card-text">Billetes</p>
                                                            </th>
                                                            <th>
                                                                <h5 align="center" class="mb-0 fw-bold" id="Montosistema_t">
                                                                    Brinks
                                                                </h5>
                                                            </th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>$1 *</td>
                                                            <td>
                                                                <input type="hidden" id="mult1" value="1">
                                                                <input name="x_sistema1" id="x_sistema1" style="margin-left: 25%;" value='0' onchange="calOne()"
                                                                    type="number" class="text-center form-control w-50" >
                                                            </td>
                                            
                                                        </tr>
                                                        <tr>
                                                            <td>$5 *</td>
                                                            <td>
                                                                <input type="hidden" id="mult2" value="5">
                                                                <input name="x_sistema2" id="x_sistema2" style="margin-left: 25%;" value='0' onchange="calOne()"
                                                                    type="number" class="text-center  form-control w-50" ></td>
                                                        
                                                        </tr>
                                                        <tr>
                                                            <td>$10 *</td>
                                                            <td >
                                                            <input type="hidden" id="mult3" value="10">
                                                                <input name="x_sistema3" id="x_sistema3" style="margin-left: 25%;" value='0' onchange="calOne()"
                                                                    type="number" class="text-center  form-control w-50" >
                                                                    
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>$20 *</td>
                                                            <td><input type="hidden" id="mult4" value="20">
                                                                <input name="x_sistema4" id="x_sistema4" style="margin-left: 25%;" value='0' onchange="calOne()"
                                                                    type="number" class="text-center  form-control w-50" >
                                                                </td>
                                                
                                                        </tr>
                                                        <tr>
                                                            <td>Rollos 0.01</td>
                                                            <td>
                                                                <input type="hidden" id="mult11" value="0.01">
                                                                <input name="x_sistema11" id="x_sistema11" style="margin-left: 25%;" value='0' onchange="calOne()"
                                                                    type="number" class="text-center  form-control w-50" >
                                                                </td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <td>Rollos 0.05</td>
                                                            <td>
                                                            <input type="hidden" id="mult12" value="0.05">
                                                            <input name="x_sistema12" id="x_sistema12" style="margin-left: 25%;" value='0' onchange="calOne()"
                                                                    type="number" class="text-center  form-control w-50" >
                                                                </td>
                                                
                                                        </tr>
                                                        <tr>
                                                            <td>Rollos 0.10</td>
                                                            <td><input type="hidden" id="mult5" value="0.1">
                                                                <input name="x_sistema5" id="x_sistema5" style="margin-left: 25%;" value='0' onchange="calOne()"
                                                                    type="number" class="text-center  form-control w-50" ></td>
                                                    
                                                        </tr>
                                                        <tr>
                                                            <td>Rollos 0.25</td>
                                                            <td><input type="hidden" id="mult9" value="0.25">
                                                                <input name="x_sistema9" id="x_sistema9" style="margin-left: 25%;" value='0' onchange="calOne()"
                                                                    type="number" class="text-center  form-control w-50" >
                                                                </td>
                                                
                                                        </tr>
                                                        <tr>
                                                            <td>Rollos 0.50</td>
                                                            <td>
                                                            <input type="hidden" id="mult10" value="0.5">
                                                                <input name="x_sistema10" id="x_sistema10" style="margin-left: 25%;" value='0' onchange="calOne()"
                                                                    type="number" class="text-center  form-control w-50" >
                                                                </td>
                                        
                                                        </tr>
                                                        
                                                        <tr>
                                                                <td>Sencillo</td>
                                                                <td>
                                                                <input type="hidden" id="mult6" value="1">
                                                                    <input name="x_sistema6" id="x_sistema6" style="margin-left: 25%;" value="0" onchange="calOne()"
                                                                        type="number" class="text-center form-control w-50">
                                                                </td>
                                                            </tr>
                                                        @foreach ($permisos->records as $user)
                                                            @foreach ($user->PAGODAHUB_closecash as $acceso)
                                                                @if($acceso->Name  == 'bank.gerency')
                                                                    <tr>
                                                                        <td>Dinero Gerencia</td>
                                                                        <td>
                                                                        <input type="hidden" id="mult7" value="1">
                                                                            <input name="x_sistema7" id="x_sistema7" style="margin-left: 25%;" value='0' onchange="calOne()"
                                                                                type="number" class="text-center  form-control w-50" >
                                                                            </td>
                                                                        
                                                                    </tr>
                                                                @break
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                        
                                                        <tr>
                                                            <td>Total caja</td>
                                                            <td><input type="hidden" id="mult8" value="1">
                                                                <input name="x_sistema8" id="x_sistema8" style="margin-left: 25%;" value='0' onchange="calOne()"
                                                                    type="number" class="text-center  form-control w-50" ></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <input type="hidden" name="BrinkresultColumn" id="BrinkresultColumnF" value="0">
                                                            <input type="hidden" name="QuantityresultColumn" id="QuantityresultColumnF" value="0">
                                                            <input type="hidden" name="TotalresultColumn" id="TotalresultColumnF" value="0">
                                                            <td>Total</td>
                                                            <td align="center">
                                                                <span name="BrinkresultColumn" id="BrinkresultColumn">0.00</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <script>
                                                    function calOne() {
                                                    // Obtener el valor ingresado en el input
                                                    var totalBrink = 0;
                                                    for (let index = 1; index < 13; index++) {
                                                        var inputValue = parseFloat(document.getElementById('x_sistema' + index).value);
                                                        var mult = parseFloat(document.getElementById('mult' + index).value);
                                                        if (index != 7 && index != 8) {
                                                            totalBrink += inputValue * mult;
                                                        } else {
                                                            // Verificar si el elemento con id 'x_sistema7' existe antes de usarlo
                                                            var element = document.getElementById('x_sistema7');
                                                            if (element) {
                                                                totalBrink -= inputValue * mult;
                                                            }
                                                        }
                                                    }

                                                    // Redondear totalBrink a 2 decimales
                                                    totalBrink = totalBrink.toFixed(2);

                                                    // Actualizar el total
                                                    document.getElementById('BrinkresultColumn').textContent = totalBrink;
                                                    document.getElementById('BrinkresultColumnF').value = totalBrink;
                                                }

                                                </script>
                                                <div class="col-md">
                                                    <label for="formFileMultiple" class="form-label">Por favor adjunte los
                                                        reportes</label>
                                                    <input class=" subirimagen form-control" type="file" id="filePicker"
                                                        placeholder="Recibo" name="FileCedula" value="0" onchange="imgsize()"
                                                        onkeyup="imgsize()" accept=".png">
                                                    <textarea style="display:none;" name="foto" id="base64textarea" placeholder="Base64 will appear here"
                                                        cols="50" rows="15"></textarea>
                                                    <br>
                                                    <center><img id="img1" class="rounded" src="" border="1"
                                                            style="width: 50%;">
                                                    </center>
                                                </div>
                                                <hr class="mb-4">
                                                
                                                <div class="col-12" style="display: flex">
                                                    <div class="col-4">
                                                        <button class="w-100 btn btn-outline-secondary m-0" type="button" onclick="submitForm('{{ route('Brink.store') }}')">Guardar</button>
                                                    </div>
                                                    <div class="col-4">

                                                    </div>
                                                    <div class="col-4">
                                                        <button class="w-100 btn btn-outline-secondary m-0" type="button" onclick="submitForm('{{ route('Brink.imprimir') }}')">Imprimir</button>
                                                    </div>
                                                </div>
                                            </form>

                                            <script>
                                                window.submitForm = function(action) {
                                                    document.getElementById('save').action = action;
                                                    document.getElementById('save').submit();
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
                        @else
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
                                                    <p class="card-text">Billetes</p>
                                                </th>
                                                <th>
                                                    <h5 align="center" class="mb-0 fw-bold" id="Montosistema_t">
                                                        Brinks
                                                    </h5>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>$1 *</td>
                                                <td>
                                                    <input name="x_sistema1" id="x_sistema1" style="margin-left: 25%;" value='{{$brink->billete_1}}' onchange="calOne()"
                                                        type="number" class="text-center form-control w-50" >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>$5 *</td>
                                                <td><input name="x_sistema2" id="x_sistema2" style="margin-left: 25%;" value='{{$brink->billete_5}}' onchange="calOne()"
                                                        type="number" class="text-center  form-control w-50" ></td>
                                                
                                            </tr>
                                            <tr>
                                                <td>$10 *</td>
                                                <td >
                                                    <input name="x_sistema3" id="x_sistema3" style="margin-left: 25%;" value='{{$brink->billete_10}}' onchange="calOne()"
                                                        type="number" class="text-center  form-control w-50" >
                                                        
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>$20 *</td>
                                                <td><input name="x_sistema4" id="x_sistema4" style="margin-left: 25%;" value='{{$brink->billete_20}}' onchange="calOne()"
                                                        type="number" class="text-center  form-control w-50" ></td>
                                                
                                            </tr>
                                            <tr>
                                                <td>Rollos 0.01</td>
                                                <td><input name="x_sistema11" id="x_sistema11" style="margin-left: 25%;" value='{{$brink->rollos_01}}' onchange="calOne()"
                                                        type="number" class="text-center  form-control w-50" ></td>
                                                
                                            </tr>
                                            <tr>
                                                <td>Rollos 0.05</td>
                                                <td><input name="x_sistema12" id="x_sistema12" style="margin-left: 25%;" value='{{$brink->rollos_05}}' onchange="calOne()"
                                                        type="number" class="text-center  form-control w-50" ></td>
                                    
                                            </tr>
                                            <tr>
                                                <td>Rollos 0.10</td>
                                                <td><input name="x_sistema5" id="x_sistema5" style="margin-left: 25%;" value='{{$brink->rollos_10}}' onchange="calOne()"
                                                        type="number" class="text-center  form-control w-50" ></td>
                                    
                                            </tr>
                                            <tr>
                                                <td>Rollos 0.25</td>
                                                <td><input name="x_sistema9" id="x_sistema9" style="margin-left: 25%;" value='{{$brink->rollos_25}}' onchange="calOne()"
                                                        type="number" class="text-center  form-control w-50" ></td>
                                    
                                            </tr>
                                            <tr>
                                                <td>Rollos 0.50</td>
                                                <td><input name="x_sistema10" id="x_sistema10" style="margin-left: 25%;" value='{{$brink->rollos}}' onchange="calOne()"
                                                        type="number" class="text-center  form-control w-50" ></td>
                                    
                                            </tr>
                                            <tr>
                                                <td>Sencillo</td>
                                                <td><input name="x_sistema6" id="x_sistema6" style="margin-left: 25%;" value='{{$brink->sencillo}}' onchange="calOne()"
                                                        type="number" class="text-center  form-control w-50" ></td>
                                                
                                            </tr>
                                            @foreach ($permisos->records as $user)
                                                @foreach ($user->PAGODAHUB_closecash as $acceso)
                                                    @if($acceso->Name  == 'bank.gerency')
                                                        <tr>
                                                            <td>Dinero Gerencia</td>
                                                            <td><input name="x_sistema7" id="x_sistema7" style="margin-left: 25%;" value='{{$brink->dinero_gerencia}}' onchange="calOne()"
                                                                    type="number" class="text-center  form-control w-50" ></td>
                                                    
                                                        </tr>
                                                    @break
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            
                                            <tr>
                                                <td>Total caja</td>
                                                <td><input name="x_sistema8" id="x_sistema8" style="margin-left: 25%;" value='{{$brink->total_caja}}' onchange="calOne()"
                                                        type="number" class="text-center  form-control w-50" ></td>
                                                
                                            </tr>
                                            <tr>
                                                <input type="hidden" name="BrinkresultColumn" id="BrinkresultColumnF" value="{{$brink->total_brink}}">
                                                <input type="hidden" name="QuantityresultColumn" id="QuantityresultColumnF" value="{{$brink->total_quantity}}">
                                                <input type="hidden" name="TotalresultColumn" id="TotalresultColumnF" value="{{$brink->total}}">
                                                <td>Total</td>
                                                <td align="center">
                                                    <span id="BrinkresultColumn">{{$brink->total_brink}}</span>
                                                </td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                    <script>
                                        function calOne() {
                                            // Obtener el valor ingresado en el input
                                            var inputValue = parseFloat(document.getElementById('x_sistema' + index).value)*mult;
                                            
                                            if(index!=7&&index!=8){
                                                totalBrink += inputValue;
                                            }else{
                                                totalBrink -= inputValue;
                                            }
                                            // Actualizar el total
                                            document.getElementById('BrinkresultColumn').textContent = totalBrink;
                                            document.getElementById('BrinkresultColumnF').value = totalBrink;

                                        }
                                    </script>
                                    <div class="col-md">
                                    <label for="formFileMultiple" class="form-label">Por favor adjunte los
                                    reportes</label>
                                <input class=" subirimagen form-control" type="file" id="filePicker"
                                    placeholder="Recibo" name="FileCedula" value="0" onchange="imgsize()"
                                    onkeyup="imgsize()" accept=".png">
                                <textarea style="display:none;" name="foto" id="base64textarea" placeholder="Base64 will appear here"
                                    cols="50" rows="15">{{ $brink->foto }}</textarea>
                                <br>
                                <center><img id="img1" class="rounded"
                                        src="data:image/png;base64,{{ $brink->foto }}"
                                        border="1" style="width: 50%;">
                                </center>
                                    </div>
                                    <hr class="mb-4">
                                    
                                    <div class="col-12" style="display: flex">
                                        <div class="col-4">
                                            <button class="w-100 btn btn-outline-secondary m-0" type="button" onclick="submitForm('{{ route('Brink.update') }}')">Actualizar</button>
                                        </div>
                                        <div class="col-4">

                                        </div>
                                        <div class="col-4">
                                            <button class="w-100 btn btn-outline-secondary m-0" type="button" onclick="submitForm('{{ route('Brink.imprimir') }}')">Imprimir</button>
                                        </div>
                                    </div>
                                </form>

                                <script>
                                    window.submitForm = function(action) {
                                        document.getElementById('save').action = action;
                                        document.getElementById('save').submit();
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
                    @endif
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