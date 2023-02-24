@extends('layouts.app')
@section('title', 'Page Title')


@section('content')
    <div class="p-5 m-0 border-0 bd-example">
        <div class="card">
            <div class="card-header">
                Facturas
            </div>
            <br>
            <center>
                <div class="form-group w-50">
                    <form name="market" id="market" method="post" action="{{ route('market.day') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" placeholder="" aria-label="" aria-describedby=""
                                spellcheck="false" data-ms-editor="true" name="day">
                            <button class="btn btn-outline-secondary" type="" id="button-addon2">Buscar</button>
                        </div>
                    </form>
                </div>
                <div class="p-4 m-0 border-0" style="width:100%; border:1px solid black;">


                    @foreach ($comprasdeldia as $data)
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                            <div class="col">
                                <h4>Numero de factura: {{ $data->id }}</h4>
                            </div>
                            <div class="col">
                                <h4>Comprador: {{ $data->buyer }}</h4>
                            </div>
                            <div class="col">
                                <h4>Proveedor: xxxxxxxxxx</h4>
                            </div>
                        </div>

                        {{-- {{ $data }} --}}

                        <table class="table table-bordered border-success">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Unidad</th>
                                    <th>Cantidad</th>
                                    <th>Diferencia</th>
                                    <th>Precio</th>
                                    <th>Metodo de Pago</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (json_decode($data->product) as $index => $product)
                                    @if ($loop->index < count(json_decode($data->product)) - 1)
                                        <tr>
                                            <td> <input class="form-control w-75 border-0 bg-transparent" type="text"
                                                    name="index[]" value="{{ $index + 1 }}" readonly> </td>
                                            <td>
                                                {{-- <input class="form-control w-75 border-0 bg-transparent" type="text"
                                                    name="product[]" value="{{ $product }}" readonly> --}}
                                                <input class="form-control w-75 border-0 bg-transparent" type="text"
                                                    name="product[]" value="{{ $product }}"
                                                    data-product-value="{{ $product }}" readonly>
                                            </td>
                                            <td>
                                                {{-- <input class="form-control w-75 border-0 bg-transparent" type="text"
                                                    name="unit[]" value=" {{ json_decode($data->unit)[$index] }}" readonly> --}}
                                                <input class="form-control w-75 border-0 bg-transparent" type="text"
                                                    name="unit[]" value=" {{ json_decode($data->unit)[$index] }}"
                                                    data-unit-value="{{ json_decode($data->unit)[$index] }}" readonly>
                                            </td>
                                            <td>
                                                {{-- <input class="form-control w-75 border-0 bg-transparent" type="number"
                                                    name="quantity[]" value="{{ json_decode($data->quantity)[$index] }}"
                                                    readonly> --}}
                                                <input class="form-control w-75 border-0 bg-transparent" type="number"
                                                    name="quantity[]" value="{{ json_decode($data->quantity)[$index] }}"
                                                    data-quantity-value="{{ json_decode($data->quantity)[$index] }}"
                                                    readonly>
                                            </td>
                                            <td>
                                                <input class="form-control w-100 " type="number" name="difference[]"
                                                    value="" required>
                                            </td>
                                            <td>
                                                {{-- <input class="form-control w-100" type="number" name="price[]"
                                                    value="" required> --}}
                                                <input class="form-control w-100 " type="number" name="price[]"
                                                    value="" data-price-value="" required>
                                            </td>
                                            <td>
                                                <select class="form-select w-100" name="paymentoption[]"
                                                    onChange="toggleTable(this)" required>
                                                    <option value="Efectivo" data-option-value="{{ $index }}">
                                                        Efectivo</option>
                                                    <option value="Credito" data-option-value="{{ $index }}">Credito
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="container">
                            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">
                                <div class="col">
                                    <h3>Total de registros: {{ count(json_decode($data->product)) - 1 }}</h3>
                                </div>
                            </div>
                        </div>
                    @endforeach


                    <br>
                    <div class="mb-3">
                        <input class="form-control" type="file" id="formFile" multiple>
                    </div>
                    <br>
                </div>
            </center>

            <div class="p-4 m-0 border-0">
                <div class="card border-primary">
                    <h5 class="card-header">Lista de productos a credito</h5>
                    <div class="card-body">
                        <table class="table table-bordered border-success">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Unidad</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>

                            <tbody id="table-container">

                            </tbody>
                        </table>
                        {{-- <script>
                            function toggleTable(selectElement) {
                                var tableContainer = document.getElementById("table-container");
                                var selectedValue = selectElement.options[selectElement.selectedIndex].value;

                                if (selectedValue === "Credito") {
                                    // Agregar tabla de crédito
                                    var newTable = document.createElement("table");
                                    newTable.innerHTML =
                                        `<tbody>  <tr>    <td>Dato1</td>    <td>Dato2</td>    <td>Dato3</td>    <td>Dato4</td>  </tr></tbody>`;
                                    tableContainer.appendChild(newTable);
                                } else {
                                    // Eliminar tabla de crédito si existe
                                    var creditTable = tableContainer.querySelector("table");
                                    if (creditTable) {
                                        tableContainer.removeChild(creditTable);
                                    }
                                }
                            }
                        </script> --}}
                        <script>
                            function toggleTable(selectElement) {
                                var tableContainer = document.getElementById("table-container");
                                var selectedValue = selectElement.options[selectElement.selectedIndex].value;
                                const selectedOption = selectElement.options[selectElement.selectedIndex];
                                const optionValue = selectedOption.dataset.optionValue;
                                console.log(selectedValue);
                                console.log(optionValue);
                                if (selectedValue === "Credito") {
                                    // Agregar tabla de crédito
                                    var newTable = document.createElement("tr");
                                    // Obtener los valores de los input existentes
                                    var indexs = document.getElementsByName("index[]");
                                    var products = document.getElementsByName("product[]");
                                    var units = document.getElementsByName("unit[]");
                                    var quantities = document.getElementsByName("quantity[]");
                                    var prices = document.getElementsByName("price[]");

                                    // Construir el contenido de la tabla con los valores obtenidos
                                    var tableContent = "";
                                    var i = optionValue;
                                    newTable.id = optionValue;
                                    tableContent +=
                                        `
                                            <td>${indexs[i].value}</td>
                                            <td>${products[i].value}</td>
                                            <td>${units[i].value}</td>
                                            <td>${quantities[i].value}</td>
                                            <td>${prices[i].value}</td>
                                        `;

                                    // Insertar el contenido de la tabla en el elemento nuevo
                                    newTable.innerHTML = `<tbody>${tableContent}</tbody>`;
                                    tableContainer.appendChild(newTable);
                                } else {
                                    // Eliminar tabla de crédito si existe var creditTable = tableContainer.querySelector("table");

                                    var creditTable = document.getElementById(optionValue);
                                    console.log(creditTable);
                                    if (creditTable) {
                                        tableContainer.removeChild(creditTable);
                                    }
                                }
                            }
                        </script>

                        <br>
                        <a href="#" class="btn btn-primary">imprimir factura credito</a>
                    </div>
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
    </style>
@endsection
