@extends('layouts.app')
@section('title', 'Page Title')


@section('content')
<div class="p-2 m-0 border-0 bd-example">
    <div class="d-flex">
        <!-- Formulario de búsqueda por proveedor -->
        <div class="container">
            <div class="card">
                <div class="card-header">Solicitud supervisor</div>
                <div class="card-body">
                    <!-- Formulario para envio-->
                    <form name="provider" id="provider" method="post" action="{{ print(0) }}">
                        <div class=" col-md-6 mb-3">
                            <label for="today">Fecha de hoy</label>
                            <input type="today" class="form-control" date-format="mm/dd/yyyy"
                                id="today" name="today" placeholder="" value="<?php echo date("Y-m-d"); ?>" readonly >
                                
                        </div>
                        <div class=" col-md-6 mb-3">
                            <label for="date">Fecha del cierre</label>
                            <input type="date" class="form-control" date-format="mm/dd/yyyy"id="date"
                             name="date" placeholder="" value=""   max="<?php echo date("Y-m-d"); ?>" required >
                            
                        </div> 
                        <div class="form-group w-auto">
                            @csrf
                            <button class=" w-100 btn btn-outline-secondary m-0" type="submit" id="button-addon2">Importar</button>
                        </div>
                    </form>
                    <hr class="mb-4">
                    <form name="save" id="save" method="post" action="{{ print(0) }}">
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
                                        <th>
                                            <h5 align="center" class="mb-0 fw-bold" id="Montosistema_t">
                                               Brinks
                                            </h5>
                                            
                                            <input hidden name="efectivo_sistema"
                                                value="">

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
                                        <td> <input name="x_oneamtSistema" value=""style="margin-left: 25%;"
                                                type="number" class="text-center  form-control w-50" placeholder="0"></td>
                                        <td align="center">
                                            123
                                        </td>
                                        <td align="center">
                                            123
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>$5 *</td>
                                        <td><input name="x_fiveamtSistema" value=""style="margin-left: 25%;"
                                                type="number" class="text-center  form-control w-50" placeholder="0"></td>
                                        <td align="center">
                                            
                                        </td>
                                        <td align="center">
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>$10 *</td>
                                        <td >
                                            <input name="x_tenamtSistema" value=""style="margin-left: 25%;"
                                                type="number" class="text-center  form-control w-50" placeholder="0">
                                                
                                        </td>
                                        <td align="center">
                                            xxx
                                        </td>
                                        <td align="center">
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>$20 *</td>
                                        <td><input name="x_twentyamtSistema" value=""style="margin-left: 25%;"
                                                type="number" class="text-center  form-control w-50" placeholder="0"></td>
                                        <td align="center">
                                            xxx
                                        </td>
                                        <td align="center">
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Rollos</td>
                                        <td><input name="x_fiftyamtSistema" value=""style="margin-left: 25%;"
                                                type="number" class="text-center  form-control w-50" placeholder="0"></td>
                                        <td align="center">
                                           
                                        </td>
                                        <td align="center">
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sencillo</td>
                                        <td><input name="x_hundredamtSistema" value=""style="margin-left: 25%;"
                                                type="number" class="text-center  form-control w-50" placeholder="0"></td>
                                        <td align="center">
                                           
                                        </td>
                                        <td align="center">
                                            
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Total</td>
                                        <td align="center">
                                            0000
                                        </td>
                                        <td align="center">
                                           0000
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-md">
                                <label>Adjuntar Foto </label>
                                <input class=" subirimagen form-control" type="file" id="filePicker"
                                    placeholder="Foto" name="" value="0" accept=".png, .jpg, .jpeg" required>
                                <textarea style="display:none;" name="foto" id="base64textarea" placeholder="Base64 will appear here"
                                    cols="50" rows="15"></textarea>
                            </div>
                            <hr class="mb-4">
                            
                            <div class="col-12" style='display:flex'>
                                <div  class="col-4" >
                                    <button class=" w-100 btn btn-outline-secondary m-0" tyme="submit" id="button-addon2">Guardar</button>
                                </div>
                                <div  class="col-4" >
                                    
                                </div>
                                <div  class="col-4">
                                    <button class=" w-100 btn btn-outline-secondary m-0" type="submit" id="button-addon2">Imprimir</button>                       
                                </div>
                            </div>
                        </div>
                    </form>
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