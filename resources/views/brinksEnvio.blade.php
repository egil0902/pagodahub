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
                <div class="card-header">Envio bancos</div>
                <div class="card-body">
                    <!-- Formulario para envio-->
                    <form name="provider" id="provider" method="post" action="{{ route('Brink.brinkStore') }}">
                        <div class=" col-md-6 mb-3">
                            <label for="date">Fecha </label>
                            <input type="date" class="form-control" date-format="mm/dd/yyyy"
                                id="date" name="date" placeholder="" value=""   max="<?php echo date("Y-m-d"); ?>" required>
                                <div class="text-danger" id="Ddate" style="display:none">
                                        Campo requerido
                                    </div>
                        </div> 
                        <div class="col-md-6 mb-3">
                            <label for="Banco">Banco </label>
                            <input type="text" class="form-control " id="Banco" name="Banco" placeholder=""  required>
                            <div class="text-danger" style="display:none" id="DBanco">
                                Campo requerido
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Monto">Monto </label>
                            <input type="number" class="form-control" id="Monto" name="Monto" placeholder="" required >
                            <div class="text-danger" style="display:none" id="DMonto">
                                Campo requerido
                            </div>
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
                Lista de envios a banco
            </div>
            <div class="card-body">
                @livewire('App\Http\Livewire\BrinkSendSearch')
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