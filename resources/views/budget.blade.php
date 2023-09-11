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

                 
                <div class="card-header">Creacion de presupuestos</div>
                <div class="card-body">
                    <!-- Formulario para envio-->
                    <form name="provider" id="provider" method="post" action="{{route( 'budget.create' )}}">
                        <div class=" col-md-6 mb-3">
                            <label for="date">Fecha</label>
                            <input type="date" class="form-control" date-format="mm/dd/yyyy"
                                id="date" name="date" placeholder="" value="<?php echo date("Y-m-d"); ?>">
                                
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="recibe">Responsable que recibe </label>
                            <input type="text" class="form-control" id="recibe" name="recibe" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="entrega">Responsable que entrega </label>
                            <input type="text" class="form-control" id="entrega" name="entrega" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="presupuesto">Presupuesto </label>
                            <input type="number" class="form-control" id="presupuesto" name="presupuesto"  step="0.01" required>
                        </div>
                        
                        <div class="form-group w-auto">
                            @csrf
                            <button class=" w-100 btn btn-outline-secondary m-0" type="submit" id="button-addon2">Crear registro</button>
                        </div>
                    </form>
                    <hr class="mb-4">                    
                </div>
            </div>
        <div class="card">
            <div class="card-header">
                Lista de presupuestos
            </div>
            <div class="card-body">
                @livewire('App\Http\Livewire\BudgetSearch')
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