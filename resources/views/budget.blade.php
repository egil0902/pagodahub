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
                            <p for="cars" class="card-text">Sucursal</p>
                            <select class="form-control" name="AD_Org_ID" id="AD_Org_ID">
                                @if (isset($orgs))
                                    @if ($orgs)
                                        @foreach ($orgs as $org)
                                            @if($org->id!=0)
                                                <option value="{{ $org->Name }}">{{ $org->Name }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                            </select>
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
                        <div class="col-md-6 mb-3">
                            <label for="numero">Número de cheques: </label>
                            <input type="number" id="numero" name="numero" onkeyup="agregarCampos()">
                        </div>
                        <div id="container_cheques"></div>
                        <script>
                            function agregarCampos() {
                                const numero = document.getElementById("numero").value;
                                const container = document.getElementById("container_cheques");

                                // Limpia cualquier contenido previo
                                container.innerHTML = "";

                                // Crea y agrega los nuevos campos
                                for (let i = 1; i <= numero; i++) {
                                    const div = document.createElement("div");
                                    div.className = "campo";

                                    const label1 = document.createElement("label");
                                    label1.textContent = `N° Cheque ${i}: `;
                                    const input1 = document.createElement("input");
                                    input1.type = "text";
                                    input1.name = `n_cheque_${i}`;
                                    input1.id = `n_cheque_${i}`;

                                    const label3 = document.createElement("label");
                                    label3.textContent = `Banco ${i}: `;
                                    const input3 = document.createElement("input");
                                    input3.type = "text";
                                    input3.name = `banco_${i}`;
                                    input3.id = `banco_${i}`;

                                    div.appendChild(label1);
                                    div.innerHTML += '&nbsp;';
                                    div.appendChild(input1);
                                    div.innerHTML += '&nbsp;&nbsp;';
                                    div.appendChild(label3);
                                    div.innerHTML += '&nbsp;';
                                    div.appendChild(input3);

                                    container.appendChild(div);
                                    container.appendChild(document.createElement("br"));
                                }
                            }
                        </script>
                        
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
                @livewire('App\Http\Livewire\BudgetSearch', ['orgs' => $orgs])
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