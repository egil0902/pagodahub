@extends('layouts.app')
@section('title', 'Page Title')


@section('content')
<div class="p-2 m-0 border-0 bd-example">
    <div class="d-flex">
        <!-- Formulario de búsqueda por proveedor -->
        <div class="container">
            <div class="card">
                <div class="card-header">Filtrar facturas</div>
                <div class="card-body">
                    <form name="provider" id="provider" method="post" action="{{ route('factures.searchByProvider') }}" class="mr-2">
                        <div class="form-group">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="" spellcheck="false" name="provider">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buscar proveedor</button>
                            </div>
                        </div>
                    </form>
                    <!-- Formulario para mostrar facturas a crédito -->
                    <form name="provider" id="provider" method="post" action="{{ route('factures.credit') }}">
                        <div class="form-group w-auto">
                            @csrf
                            <button class=" w-100 btn btn-outline-secondary" type="submit" id="button-addon2">Mostrar facturas sin pagar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="container">
            <form name="factures" id="factures" method="post" action="{{ route('factures.resume') }}">
                    <div class="form-group ">

                        @csrf
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" placeholder="" aria-label="" aria-describedby=""
                                spellcheck="false" data-ms-editor="true" name="day" required>
                            <button class="btn btn-outline-secondary" type="" id="button-addon2">Resumen del dia</button>
                        </div>

                    </div>
            </form>
        </div>
        <div class="container">
        Presupuesto restante para el dia: {{$presupuesto}}
        </div>
    </div>
</br>
    
    <div>
        <table>
            <thead>
                <tr>
                    <th># Factura</th>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Medio de pago</th>
                    <th>Valor abonado</th>
                    <th>Total</th>
                    <th>Valor Deuda</th>
                    <th>Pagada?</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($facturas as $factura)
                <tr>
                    <td>{{$factura->id_compra}}</td>
                    <td>{{$factura->fecha}}</td>
                    <td>{{$factura->proveedor}}</td>
                    <td>{{$factura->medio_de_pago?"Contado":"Crédito"}}</td>
                    <td>{{$factura->monto_abonado}}</td>
                    <td>{{$factura->total}}</td>
                    <td>{{$factura->medio_de_pago?0:($factura->Total_compra-$factura->monto_abonado)}}</td>
                    <td>{{$factura->pagada?"Si":"No"}}</td>
                    <!--<td>
                        <form action="{{ route('factures.borrar', $factura->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"></path>
                                </svg>
                            </button>
                        </form>
                    </td>
                    -->
                    <td>
                        <form action="{{route('factures.show', $factura->id) }}" method="post">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-outline-primary" data-bs-toggle="modal">
                                Ver
                            </button>
                        </form>
                        
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        
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
