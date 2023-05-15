@extends('layouts.app')
@section('title', 'Page Title')


@section('content')
<div class="p-2 m-0 border-0 bd-example">
    <div class="d-flex">
        <form name="provider" id="provider" method="post" action="{{ route('factures.searchByProvider') }}"
            class="mr-2">
            <div class="form-group">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby=""
                        spellcheck="false" name="provider">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buscar proveedor</button>
                </div>
            </div>
        </form>
        <div class="divider"></div> <!-- Agregamos una separación -->
        <form name="provider" id="provider" method="post" action="{{ route('factures.credit') }}">
            <div class="form-group">
                @csrf
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Mostrar facturas a
                    crédito</button>
            </div>
        </form>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th># factura</th>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Abono</th>
                    <th>Medio de pago</th>
                    <th>Valor total</th>                   
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($facturas as $factura)
                <tr>
                {{$factura->id}}
                    <td>{{$factura->id_compra}}</td>
                    <td>{{$factura->fecha}}</td>
                    <td>{{$factura->proveedor}}</td>
                    <td>{{$factura->monto_abonado}}</td>
                    <td>{{$factura->medio_de_pago?"Credito":"Contado"}}</td>
                    <td>{{$factura->total}}</td>
                    <td>
                    <form action="{{ route('factures.borrar', $factura->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Borrar</button>
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
