@extends('layouts.app')
@section('title', 'Page Title')


@section('content')
<div class="p-2 m-0 border-0 bd-example">
    <div class="d-flex">
        
        <!-- Formulario de búsqueda por proveedor -->
        <!--<div class="container w-auto m-0 pl-0">
            <div class="card">
                <div class="card-header">Filtrar facturas</div>
                <div class="card-body">
                    <!--<form name="provider" id="provider" method="post" action="{{ route('factures.searchByProvider') }}" >
                        <div class="form-group">
                            @csrf
                            <div class="input-group">
                                <input  type="text" class="form-control" placeholder="" aria-label="" aria-describedby="" spellcheck="false" name="provider">
                                <button class="btn btn-outline-secondary mt-1" type="submit" id="button-addon2">Buscar proveedor</button>
                            </div>
                        </div>
                    </form>
                    <form name="provider" id="provider" method="post" action="{{ route('factures.credit') }}">
                        <div class="form-group w-auto">
                            @csrf
                            <button class=" w-100 btn btn-outline-secondary m-0" type="submit" id="button-addon2">Mostrar facturas sin pagar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
-->

        <div style="padding-top: 20px;">
        Presupuesto restante para el dia: {{$presupuesto}}
        </div>
        
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <br>
    @livewire('App\Http\Livewire\FactureFilter', ['orgs' => $orgs])

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
        .form-group {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        label {
            font-weight: bold;
        }

        input[type="checkbox"],
        input[type="text"] {
            margin-top: 5px;
        }

        button {
            margin-top: 10px;
        }
    </style>
@endsection
