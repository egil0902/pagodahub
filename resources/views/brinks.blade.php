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
                            <input type="date" class="form-control" id="endDate" name="endDate" min="" max="" readonly required>
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
                                document.getElementById('endDate').max = endDate.toISOString().split('T')[0];
                                document.getElementById('endDate').removeAttribute('readonly');
                                document.getElementById('endDate').value = endDate.toISOString().split('T')[0];
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
                    @php
                        $x_oneamt = 0;
                        $x_fiveamt = 0;
                        $x_tenamt = 0;
                        $x_twentyamt = 0;
                        $rollo1 = 0;
                        $rollo25 = 0;
                        $rollo50 = 0;
                        $gerencia = 0;
                    @endphp
                    @if(!isset($brink))
                        @if(isset($closecashsumlist))
                            @if ($closecashsumlist->{'records-size'} > 0)
                                @foreach ($closecashsumlist->records as $data)
                                    @php
                                        $x_oneamt +=$data->x_oneamt;
                                        $x_fiveamt +=$data->x_fiveamt;
                                        $x_tenamt +=$data->x_tenamt;
                                        $x_twentyamt +=$data->x_twentyamt;
                                        $rollo1 +=0;
                                        $rollo25 +=0;
                                        $rollo50 +=0;
                                        $gerencia +=$data->x_oneamt;
                                    @endphp
                                @endforeach
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
                                                        <th>
                                                            <h5 align="center" class="mb-0 fw-bold" id="Montosistema_t">
                                                            Cantidad
                                                            </h5>
                                                        </th>
                                                        <th>
                                                            <h5 align="center" class="mb-0 fw-bold" id="Montosistema_t">
                                                                Totales
                                                            </h5>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>$1 *</td>
                                                        <td>
                                                            <input name="x_sistema1" id="x_sistema1" style="margin-left: 25%;" value='0' onchange="calOne(1,1)"
                                                                type="number" class="text-center form-control w-50" >
                                                        </td>
                                                        <td align="center">
                                                            <span id="sumColumn1">{{$x_oneamt}}</span>
                                                        </td>
                                                        <td align="center">
                                                            <span id="resultColumn1">{{$x_oneamt}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>$5 *</td>
                                                        <td><input name="x_sistema2" id="x_sistema2" style="margin-left: 25%;" value='0' onchange="calOne(2,5)"
                                                                type="number" class="text-center  form-control w-50" ></td>
                                                        <td align="center">
                                                        <span id="sumColumn2">{{$x_fiveamt}}
                                                        </td>
                                                        <td align="center">
                                                        <span id="resultColumn2">{{$x_fiveamt*5}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>$10 *</td>
                                                        <td >
                                                            <input name="x_sistema3" id="x_sistema3" style="margin-left: 25%;" value='0' onchange="calOne(3,10)"
                                                                type="number" class="text-center  form-control w-50" >
                                                                
                                                        </td>
                                                        <td align="center">
                                                        <span id="sumColumn3">{{$x_tenamt}}
                                                        </td>
                                                        <td align="center">
                                                        <span id="resultColumn3">{{$x_tenamt*10}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>$20 *</td>
                                                        <td><input name="x_sistema4" id="x_sistema4" style="margin-left: 25%;" value='0' onchange="calOne(4,20)"
                                                                type="number" class="text-center  form-control w-50" ></td>
                                                        <td align="center">
                                                        <span id="sumColumn4">{{$x_twentyamt}}
                                                        </td>
                                                        <td align="center">
                                                        <span id="resultColumn4">{{$x_twentyamt*20}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Rollos 0.10</td>
                                                        <td><input name="x_sistema5" id="x_sistema5" style="margin-left: 25%;" value='0' onchange="calOne(5,0.10)"
                                                                type="number" class="text-center  form-control w-50" ></td>
                                                        <td align="center">
                                                        <span id="sumColumn5">0</span>
                                                        </td>
                                                        <td align="center">
                                                        <span id="resultColumn5">0</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Rollos 0.25</td>
                                                        <td><input name="x_sistema9" id="x_sistema9" style="margin-left: 25%;" value='0' onchange="calOne(9,0.25)"
                                                                type="number" class="text-center  form-control w-50" ></td>
                                                        <td align="center">
                                                        <span id="sumColumn9">0</span>
                                                        </td>
                                                        <td align="center">
                                                        <span id="resultColumn9">0</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Rollos 0.50</td>
                                                        <td><input name="x_sistema10" id="x_sistema10" style="margin-left: 25%;" value='0' onchange="calOne(10,0.50)"
                                                                type="number" class="text-center  form-control w-50" ></td>
                                                        <td align="center">
                                                        <span id="sumColumn10">0</span>
                                                        </td>
                                                        <td align="center">
                                                        <span id="resultColumn10">0</span>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $sencillo = 0;
                                                    @endphp

                                                    @foreach ($list as $item)
                                                        @php
                                                            // Obtén el valor de SencilloSupervisoraFiscalizadora
                                                            $value = $item->SencilloSupervisoraFiscalizadora;
                                                            
                                                            // Si el valor es mayor que cero, suma al total
                                                            if ($value > 0) {
                                                                $sencillo += $value;
                                                            }
                                                        @endphp

                                                    @endforeach
                                                    
                                                    <tr>
                                                            <td>Sencillo</td>
                                                            <td>
                                                                <input name="x_sistema6" id="x_sistema6" style="margin-left: 25%;" value="0" onchange="calOne(6,1)"
                                                                    type="number" class="text-center form-control w-50">
                                                            </td>
                                                            <td align="center">
                                                                <span id="sumColumn6">0</span>
                                                            </td>
                                                            <td align="center">
                                                                <span id="resultColumn6">{{ $sencillo}}</span>
                                                            </td>
                                                        </tr>
                                                    @foreach ($permisos->records as $user)
                                                        @foreach ($user->PAGODAHUB_closecash as $acceso)
                                                            @if($acceso->Name  == 'bank.gerency')
                                                                <tr>
                                                                    <td>Dinero Gerencia</td>
                                                                    <td><input name="x_sistema7" id="x_sistema7" style="margin-left: 25%;" value='0' onchange="calOne(7,1)"
                                                                            type="number" class="text-center  form-control w-50" ></td>
                                                                    <td align="center">
                                                                    <span id="sumColumn7">0</span>
                                                                    </td>
                                                                    <td align="center">
                                                                    <span id="resultColumn7">0</span>
                                                                    </td>
                                                                </tr>
                                                            @break
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                    
                                                    <tr>
                                                        <td>Total caja</td>
                                                        <td><input name="x_sistema8" id="x_sistema8" style="margin-left: 25%;" value='0' onchange="calOne(8,1)"
                                                                type="number" class="text-center  form-control w-50" ></td>
                                                        <td align="center">
                                                        <span id="sumColumn8">{{$caja->SubTotal}}</span>
                                                        </td>
                                                        <td align="center">
                                                        <span id="resultColumn8">{{$caja->SubTotal}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <input type="hidden" name="BrinkresultColumn" id="BrinkresultColumnF" value="0">
                                                        <input type="hidden" name="QuantityresultColumn" id="QuantityresultColumnF" value="0">
                                                        <input type="hidden" name="TotalresultColumn" id="TotalresultColumnF" value="0">
                                                        <td>Total</td>
                                                        <td align="center">
                                                            <span name="BrinkresultColumn" id="BrinkresultColumn">0.00</span>
                                                        </td>
                                                        <td align="center">
                                                            <span name="QuantityresultColumn" id="QuantityresultColumn">0.00</span>
                                                        </td>
                                                        <td>
                                                            <span name="TotalresultColumn"id="TotalresultColumn">0.00</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <script>
                                                function calOne(index,mult) {
                                                    // Obtener el valor ingresado en el input
                                                    var inputValue = parseFloat(document.getElementById('x_sistema' + index).value);

                                                    // Obtener el valor de {{$data->x_oneamt}}
                                                    var xOneamtValue = parseFloat(document.getElementById('sumColumn' + index).textContent);

                                                    // Calcular la suma
                                                    var sum = inputValue + xOneamtValue;

                                                    // Actualizar el valor en la columna
                                                    document.getElementById('resultColumn' + index).textContent = sum*mult;

                                                    // Recalcular el total
                                                    calculateTotal();

                                                }

                                                function calculateTotal() {
                                                    var totalSum = 0;
                                                    var totalBrink=0;
                                                    var totalQ=0;
                                                    for (let index = 1; index <= 8; index++) {
                                                        if(index<7){
                                                            totalSum += parseFloat(document.getElementById('resultColumn' + index).textContent);
                                                            totalBrink += parseFloat(document.getElementById('x_sistema' + index).value);
                                                            totalQ += parseFloat(document.getElementById('sumColumn' + index).textContent);
                                                        }else{
                                                            totalSum -= parseFloat(document.getElementById('resultColumn' + index).textContent);
                                                            totalBrink -= parseFloat(document.getElementById('x_sistema' + index).value);
                                                            totalQ -= parseFloat(document.getElementById('sumColumn' + index).textContent);
                                                        }
                                                    }
                                                    // Actualizar el total
                                                    document.getElementById('BrinkresultColumn').textContent = totalBrink;
                                                    document.getElementById('QuantityresultColumn').textContent = totalQ;
                                                    document.getElementById('TotalresultColumn').textContent = totalSum;
                                                    document.getElementById('BrinkresultColumnF').value = totalBrink;
                                                    document.getElementById('QuantityresultColumnF').value = totalQ;
                                                    document.getElementById('TotalresultColumnF').value = totalSum;
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
                                
                            @endif
                        @endif
                    @else
                        @if(isset($closecashsumlist))
                            @if ($closecashsumlist->{'records-size'} > 0)
                                @foreach ($closecashsumlist->records as $data)
                                    @php
                                        $x_oneamt +=$data->x_oneamt;
                                        $x_fiveamt +=$data->x_fiveamt;
                                        $x_tenamt +=$data->x_tenamt;
                                        $x_twentyamt +=$data->x_twentyamt;
                                        $rollo1 +=0;
                                        $rollo25 +=0;
                                        $rollo50 +=0;
                                        $gerencia +=$data->x_oneamt;
                                    @endphp
                                @endforeach
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
                                                        <th>
                                                            <h5 align="center" class="mb-0 fw-bold" id="Montosistema_t">
                                                            Cantidad
                                                            </h5>
                                                            

                                                        </th>
                                                        <th>
                                                            <h5 align="center" class="mb-0 fw-bold" id="Montosistema_t">
                                                                Totales
                                                            </h5>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>$1 *</td>
                                                        <td>
                                                            <input name="x_sistema1" id="x_sistema1" style="margin-left: 25%;" value='{{$brink->billete_1}}' onchange="calOne(1,1)"
                                                                type="number" class="text-center form-control w-50" >
                                                        </td>
                                                        <td align="center">
                                                            <span id="sumColumn1">{{$x_oneamt}}</span>
                                                        </td>
                                                        <td align="center">
                                                            <span id="resultColumn1">{{$x_oneamt+$brink->billete_1}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>$5 *</td>
                                                        <td><input name="x_sistema2" id="x_sistema2" style="margin-left: 25%;" value='{{$brink->billete_5}}' onchange="calOne(2,5)"
                                                                type="number" class="text-center  form-control w-50" ></td>
                                                        <td align="center">
                                                        <span id="sumColumn2">{{$x_fiveamt}}
                                                        </td>
                                                        <td align="center">
                                                        <span id="resultColumn2">{{($x_fiveamt+$brink->billete_5)*5}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>$10 *</td>
                                                        <td >
                                                            <input name="x_sistema3" id="x_sistema3" style="margin-left: 25%;" value='{{$brink->billete_10}}' onchange="calOne(3,10)"
                                                                type="number" class="text-center  form-control w-50" >
                                                                
                                                        </td>
                                                        <td align="center">
                                                        <span id="sumColumn3">{{$x_tenamt}}
                                                        </td>
                                                        <td align="center">
                                                        <span id="resultColumn3">{{($x_tenamt+$brink->billete_10)*10}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>$20 *</td>
                                                        <td><input name="x_sistema4" id="x_sistema4" style="margin-left: 25%;" value='{{$brink->billete_20}}' onchange="calOne(4,20)"
                                                                type="number" class="text-center  form-control w-50" ></td>
                                                        <td align="center">
                                                        <span id="sumColumn4">{{$x_twentyamt}}
                                                        </td>
                                                        <td align="center">
                                                        <span id="resultColumn4">{{($x_twentyamt+$brink->billete_20)*20}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Rollos 0.10</td>
                                                        <td><input name="x_sistema5" id="x_sistema5" style="margin-left: 25%;" value='{{$brink->rollos_10}}' onchange="calOne(5,0.10)"
                                                                type="number" class="text-center  form-control w-50" ></td>
                                                        <td align="center">
                                                        <span id="sumColumn5">0</span>
                                                        </td>
                                                        <td align="center">
                                                        <span id="resultColumn5">0</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Rollos 0.25</td>
                                                        <td><input name="x_sistema9" id="x_sistema9" style="margin-left: 25%;" value='{{$brink->rollos_25}}' onchange="calOne(9,0.25)"
                                                                type="number" class="text-center  form-control w-50" ></td>
                                                        <td align="center">
                                                        <span id="sumColumn9">0</span>
                                                        </td>
                                                        <td align="center">
                                                        <span id="resultColumn9">0</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Rollos 0.50</td>
                                                        <td><input name="x_sistema10" id="x_sistema10" style="margin-left: 25%;" value='{{$brink->rollos}}' onchange="calOne(10,0.50)"
                                                                type="number" class="text-center  form-control w-50" ></td>
                                                        <td align="center">
                                                        <span id="sumColumn10">0</span>
                                                        </td>
                                                        <td align="center">
                                                        <span id="resultColumn10">0</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sencillo</td>
                                                        <td><input name="x_sistema6" id="x_sistema6" style="margin-left: 25%;" value='{{$brink->sencillo}}' onchange="calOne(6,1)"
                                                                type="number" class="text-center  form-control w-50" ></td>
                                                        <td align="center">
                                                        <span id="sumColumn6">0</span>
                                                        </td>
                                                        <td align="center">
                                                        @php
                                                            $sencillo = 0;
                                                        @endphp

                                                        @foreach ($list as $item)
                                                            @php
                                                                // Obtén el valor de SencilloSupervisoraFiscalizadora
                                                                $value = $item->SencilloSupervisoraFiscalizadora;
                                                                
                                                                // Si el valor es mayor que cero, suma al total
                                                                if ($value > 0) {
                                                                    $sencillo += $value;
                                                                }
                                                            @endphp

                                                        @endforeach
                                                        <span id="resultColumn6">{{$sencillo+$brink->sencillo}}</span>
                                                        </td>
                                                    </tr>
                                                    @foreach ($permisos->records as $user)
                                                        @foreach ($user->PAGODAHUB_closecash as $acceso)
                                                            @if($acceso->Name  == 'bank.gerency')
                                                                <tr>
                                                                    <td>Dinero Gerencia</td>
                                                                    <td><input name="x_sistema7" id="x_sistema7" style="margin-left: 25%;" value='{{$brink->dinero_gerencia}}' onchange="calOne(7,1)"
                                                                            type="number" class="text-center  form-control w-50" ></td>
                                                                    <td align="center">
                                                                    <span id="sumColumn7">0</span>
                                                                    </td>
                                                                    <td align="center">
                                                                    <span id="resultColumn7">{{$brink->dinero_gerencia}}</span>
                                                                    </td>
                                                                </tr>
                                                            @break
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                    
                                                    <tr>
                                                        <td>Total caja</td>
                                                        <td><input name="x_sistema8" id="x_sistema8" style="margin-left: 25%;" value='{{$brink->total_caja}}' onchange="calOne(8,1)"
                                                                type="number" class="text-center  form-control w-50" ></td>
                                                        <td align="center">
                                                        <span id="sumColumn8">{{$caja->SubTotal}}</span>
                                                        </td>
                                                        <td align="center">
                                                        <span id="resultColumn8">{{$brink->total_caja+$caja->SubTotal}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <input type="hidden" name="BrinkresultColumn" id="BrinkresultColumnF" value="{{$brink->total_brink}}">
                                                        <input type="hidden" name="QuantityresultColumn" id="QuantityresultColumnF" value="{{$brink->total_quantity}}">
                                                        <input type="hidden" name="TotalresultColumn" id="TotalresultColumnF" value="{{$brink->total}}">
                                                        <td>Total</td>
                                                        <td align="center">
                                                            <span id="BrinkresultColumn">{{$brink->total_brink}}</span>
                                                        </td>
                                                        <td align="center">
                                                            <span id="QuantityresultColumn">{{$brink->total_quantity}}</span>
                                                        </td>
                                                        <td>
                                                            <span id="TotalresultColumn">{{$brink->total}}</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <script>
                                                function calOne(index,mult) {
                                                    // Obtener el valor ingresado en el input
                                                    var inputValue = parseFloat(document.getElementById('x_sistema' + index).value);

                                                    // Obtener el valor de {{$data->x_oneamt}}
                                                    var xOneamtValue = parseFloat(document.getElementById('sumColumn' + index).textContent);

                                                    // Calcular la suma
                                                    var sum = inputValue + xOneamtValue;

                                                    // Actualizar el valor en la columna
                                                    document.getElementById('resultColumn' + index).textContent = sum*mult;

                                                    // Recalcular el total
                                                    calculateTotal();

                                                }

                                                function calculateTotal() {
                                                    var totalSum = 0;
                                                    var totalBrink=0;
                                                    var totalQ=0;
                                                    for (let index = 1; index <= 8; index++) {
                                                        if(index<7){
                                                            totalSum += parseFloat(document.getElementById('resultColumn' + index).textContent);
                                                            totalBrink += parseFloat(document.getElementById('x_sistema' + index).value);
                                                            totalQ += parseFloat(document.getElementById('sumColumn' + index).textContent);
                                                        }else{
                                                            totalSum -= parseFloat(document.getElementById('resultColumn' + index).textContent);
                                                            totalBrink -= parseFloat(document.getElementById('x_sistema' + index).value);
                                                            totalQ -= parseFloat(document.getElementById('sumColumn' + index).textContent);
                                                        }
                                                    }
                                                    // Actualizar el total
                                                    document.getElementById('BrinkresultColumn').textContent = totalBrink;
                                                    document.getElementById('QuantityresultColumn').textContent = totalQ;
                                                    document.getElementById('TotalresultColumn').textContent = totalSum;
                                                    document.getElementById('BrinkresultColumnF').value = totalBrink;
                                                    document.getElementById('QuantityresultColumnF').value = totalQ;
                                                    document.getElementById('TotalresultColumnF').value = totalSum;
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
                                
                            @endif
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