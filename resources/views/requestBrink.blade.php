@extends('layouts.app')
@section('title', 'Page Title')


@section('content')
<div class="p-2 m-0 border-0 bd-example">
    <div class="d-flex">
        
        <!-- Formulario de búsqueda por proveedor -->
        <div class="container">
            @if (session('mensaje'))
                <div class="alert alert-success">{{ session('mensaje') }}</div>
            @endif
            <div class="card">
                <div class="card-header">Solicitud Brink</div>
                <div class="card-body">
                    <!-- Formulario para envio-->
                    <form name="provider" id="provider" method="post" action="{{ route('requestBrink.store') }}">
                        <div class=" col-md-6 mb-3">
                            <label for="date">Fecha </label>
                            <input type="date" class="form-control" date-format="mm/dd/yyyy"
                                id="date" name="date" placeholder="" value="<?php echo date("Y-m-d"); ?>" readOnly>
                                <div class="text-danger" id="Ddate" style="display:none">
                                        Campo requerido
                                    </div>
                        </div>

                        <div align="center" style='width:90%!important; padding-left:10%'>
                            <table class="table table-borderless ">
                                <thead id="miTablaPersonalizada">
                                    <tr>
                                        <th>
                                            <p class="card-text">Billetes</p>
                                        </th>
                                        <th>
                                            <h5 align="center" class="mb-0 fw-bold" id="Montosistema_t">
                                                Cantidad
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
                                        <td>
                                        <input type="hidden" id="mult4" value="20">
                                            <input name="x_sistema4" id="x_sistema4" style="margin-left: 25%;" value='0' onchange="calOne()"
                                                type="number" class="text-center  form-control w-50" ></td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Rollos 0.01</td>
                                        <td>
                                        <input type="hidden" id="mult5" value="0.01">
                                        <input name="x_sistema5" id="x_sistema5" style="margin-left: 25%;" value='0' onchange="calOne()"
                                                type="number" class="text-center  form-control w-50" ></td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Rollos 0.05</td>
                                        <td>
                                        <input type="hidden" id="mult6" value="0.05">
                                        <input name="x_sistema6" id="x_sistema6" style="margin-left: 25%;" value='0' onchange="calOne()"
                                                type="number" class="text-center  form-control w-50" ></td>
                            
                                    </tr>
                                    <tr>
                                        <td>Rollos 0.10</td>
                                        <td>
                                        <input type="hidden" id="mult7" value="0.1">
                                        <input name="x_sistema7" id="x_sistema7" style="margin-left: 25%;" value='0' onchange="calOne()"
                                                type="number" class="text-center  form-control w-50" ></td>
                            
                                    </tr>
                                    <tr>
                                        <td>Rollos 0.25</td>
                                        <td>
                                        <input type="hidden" id="mult8" value="0.25">
                                        <input name="x_sistema8" id="x_sistema8" style="margin-left: 25%;" value='0' onchange="calOne()"
                                                type="number" class="text-center  form-control w-50" ></td>
                            
                                    </tr>
                                    <tr>
                                        <td>Rollos 0.50</td>
                                        <td>
                                        <input type="hidden" id="mult9" value="0.5">
                                        <input name="x_sistema9" id="x_sistema9" style="margin-left: 25%;" value='0' onchange="calOne()"
                                                type="number" class="text-center  form-control w-50" ></td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <input type="hidden" name="BrinkresultColumn" id="BrinkresultColumnF" value="0">
                                        <input type="hidden" name="QuantityresultColumn" id="QuantityresultColumnF" value="0">
                                        <input type="hidden" name="TotalresultColumn" id="TotalresultColumnF" value="0">
                                        <td>Total</td>
                                        <td align="center">
                                            <span id="BrinkresultColumn">0</span>
                                        </td>                                        
                                    </tr>
                                </tbody>
                                <script>
                                    function calOne() {
                                    // Obtener el valor ingresado en el input
                                    var totalBrink = 0;
                                    for (let index = 1; index < 10; index++) {
                                        var inputValue = parseFloat(document.getElementById('x_sistema' + index).value);
                                        var mult = parseFloat(document.getElementById('mult' + index).value);
                                        totalBrink += inputValue * mult;
                                        
                                    }

                                    // Redondear totalBrink a 2 decimales
                                    totalBrink = totalBrink.toFixed(2);

                                    // Actualizar el total
                                    document.getElementById('BrinkresultColumn').textContent = totalBrink;
                                    document.getElementById('BrinkresultColumnF').value = totalBrink;
                                }

                                </script>
                                
                            </table>
                            <h4>Observaciones:</h4>
                                                <textarea style="width:100%;" class="long-textarea" id="observaciones" name="observaciones" ></textarea>
                        </div>

                        <hr class="mb-4">
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
                        <hr class="mb-4">
                        <div class="form-group w-auto">
                            @csrf
                            <button class=" w-100 btn btn-outline-secondary m-0" type="submit" id="button-addon2">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>        
    </div>
    </br>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Lista de solicitudes a Brink
            </div>
            <div class="card-body">
                @livewire('App\Http\Livewire\RequestBrinkSearch')
            </div>
        </div>
    </div>
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