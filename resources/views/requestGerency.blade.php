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
                <div class="card-header">Solicitud de gerencia</div>
                <div class="card-body">
                    <!-- Formulario para envio-->
                    <form name="provider" id="provider" method="post" action="{{ route('requestGerency.store') }}">
                        <div class=" col-md-6 mb-3">
                            <label for="date">Fecha </label>
                            <input type="date" class="form-control" date-format="mm/dd/yyyy"
                                id="date" name="date" placeholder="" value="<?php echo date("Y-m-d"); ?>"   readonly required>
                                <div class="text-danger" id="Ddate" style="display:none">
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
                Lista de solicitudes de gerencia
            </div>
            <div class="card-body">
                @livewire('App\Http\Livewire\requestGerencySearch')
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