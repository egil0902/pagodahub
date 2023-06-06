@extends('layouts.app')
@section('title', 'Page Title')


@section('content')
<div class="p-2 m-0 border-0 bd-example">
    <div class="d-flex">
        <!-- Formulario de búsqueda por proveedor -->
        <form name="provider" id="provider" method="post" action="{{ route('factures.searchByProvider') }}" class="mr-2">
            <div class="form-group">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="" spellcheck="false" name="provider">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buscar proveedor</button>
                </div>
            </div>
        </form>
        <div class="divider"></div>
        <!-- Formulario para mostrar facturas a crédito -->
        <form name="provider" id="provider" method="post" action="{{ route('factures.credit') }}">
            <div class="form-group">
                @csrf
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Mostrar facturas por pagar</button>
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
                    <th>Valor Deuda</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($facturas as $factura)
                <tr>
                    <td>{{$factura->id_compra}}</td>
                    <td>{{$factura->fecha}}</td>
                    <td>{{$factura->proveedor}}</td>
                    <td>{{$factura->monto_abonado}}</td>
                    <td>{{$factura->medio_de_pago?"Contado":"Crédito"}}</td>
                    <td>{{$factura->Total_compra>=0?$factura->monto_abonado:$factura->Total_compra}}</td>
                    <td>
                        
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
                    <td>
                        <input type="checkbox" name="factura_ids[]" value="{{$factura->id_compra}}">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Formulario para imprimir facturas -->
        <form name="provider" id="provider" method="get" action="{{ route('facture-pdf') }}">
            @csrf
            <div class="form-group">
                <input type="hidden" name="factura_ids" id="factura_ids" value="">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                    Imprimir en cheque
                </button>
            </div>
        </form>
        <form name="provider" id="provider" method="post" action="{{ route('factures.pagar') }}">
            @csrf
            <div class="form-group">
                <input type="hidden" name="facturas_ids" id="facturas_ids" value="">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                    Cambiar estado a pagada
                </button>
            </div>
        </form>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Escucha el evento de cambio en los checkboxes
                $('input[name="factura_ids[]"]').change(function() {
                    // Obtén los IDs de las facturas seleccionadas
                    var selectedIds = [];
                    $('input[name="factura_ids[]"]:checked').each(function() {
                        selectedIds.push($(this).val());
                    });

                    // Asigna los IDs al campo oculto
                    $('#factura_ids').val(selectedIds.join(','));
                    $('#facturas_ids').val(selectedIds.join(','));
                });
            });

            // Función para deseleccionar todos los checkboxes
            function deselectAllCheckboxes() {
                $('input[name="factura_ids[]"]').prop('checked', false);
            }
        </script>
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
