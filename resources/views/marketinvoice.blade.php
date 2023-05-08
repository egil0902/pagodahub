@extends('layouts.app')
@section('title', 'Page Title')


@section('content')
    <div class="p-2 m-0 border-0 bd-example">

    
        <form name="market" id="market" method="post" action="{{ route('market.day') }}">
                <div class="form-group w-50 "style="padding-left: 200px;">

                    @csrf
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" placeholder="" aria-label="" aria-describedby=""
                            spellcheck="false" data-ms-editor="true" name="day">
                        <button class="btn btn-outline-secondary" type="" id="button-addon2">Buscar</button>
                    </div>

                </div>
        </form>
        <form name="market" id="market" method="post" action="{{ route('market.day') }}">
        <div class="form-group w-50">

            @csrf
            

            </div>
            <div class="card">
                <div class="card-header">
                    Facturas
                </div>
                <br>
                <center>

                    
                    <div class="p-4 m-0 border-0">
                        @foreach ($comprasdeldia as $data)
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                                <div class="col">{{--  {{ $data->id }} --}}
                                    <h4>Numero de factura:
                                        <input class="w-100 form-control" type="number" name="NFactura"
                                        id="NFactura" value=""
                                        required onchange="" step="" min="0">
                                    </h4>
                                </div>
                                <div class="col">
                                    <h4>Comprador: {{ $data->buyer }}</h4>
                                </div>
                                <div class="col">
                                    <h4>Proveedor: 
                                        <input class="w-100 form-control" type="text" name="proveedor"
                                        id="proveedor" value=""
                                        required onchange="">
                                    </h4>
                                    
                                </div>
                                <div class="col">
                                    <h4>abono: 
                                        <input class="w-100 form-control" type="text" name="abono"
                                        id="abono" value=""
                                        required onchange="">
                                    </h4>
                                    
                                </div>
                                <div class="col">
                                    <h4>metodo de pago: 
                                        <select class="form-control unit" list="opciones"  name="metodo" id="metodo">
                                        <option value="Sacos">Efectivo</option>
                                        <option value="Libras">Credito</option>
                                    </select>
                                    </h4>
                                    
                                </div>
                            </div>
                            {{-- {{ $data }} --}}
                            <div class="table-responsive">
                                <table class="table table-bordered border-success">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Producto</th>
                                            <th>Unidad</th>
                                            <th>Cantidad</th>
                                            <th>Cantidad factura</th>
                                            <th>Diferencia</th>
                                            <th>Precio</th>
                                            <!---<th>Metodo de Pago</th>--->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (json_decode($data->product) as $index => $product)
                                            @if ($loop->index < count(json_decode($data->product)) - 1)
                                                <tr>
                                                    <td> <input class="border-0 bg-transparent" type="text"
                                                            name="index[]" value="{{ $index + 1 }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input class="border-0 bg-transparent" type="text"
                                                            name="product[]" value="{{ $product }}"
                                                            data-product-value="{{ $product }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input class="border-0 bg-transparent" type="text" name="unit[]"
                                                            value=" {{ json_decode($data->unit)[$index] }}"
                                                            data-unit-value="{{ json_decode($data->unit)[$index] }}"
                                                            readonly>
                                                    </td>
                                                    <td>
                                                        <input class="border-0 bg-transparent" type="number"
                                                            name="quantity[]"
                                                            id="quantity{{ $index + 1 }}{{ $product }}"
                                                            value="{{ json_decode($data->quantity)[$index] }}"
                                                            data-quantity-value="{{ json_decode($data->quantity)[$index] }}"
                                                            readonly>
                                                    </td>
                                                    <td>
                                                        <input class="w-100 " type="number" name="differenceFactura[]"
                                                            id="differenceFactura{{ $index + 1 }}" value=""
                                                            required onchange="sumadiferencia();" step="0.01" min="0">
                                                    </td>
                                                    <td>
                                                        <input class="w-100 border-0 bg-transparent" type="number"
                                                            id="difference{{ $index + 1 }}" name="difference[]"
                                                            value="" readonly>
                                                    </td>
                                                    <script>
                                                        // Obtener las entradas numéricas
                                                        const quantity{{ $index + 1 }} = document.getElementById('quantity{{ $index + 1 }}{{ $product }}');
                                                        const differenceFactura{{ $index + 1 }} = document.getElementById('differenceFactura{{ $index + 1 }}');
                                                        const difference{{ $index + 1 }} = document.getElementById('difference{{ $index + 1 }}');

                                                        // Agregar un evento input a la entrada differenceFactura
                                                        differenceFactura{{ $index + 1 }}.addEventListener('input', function() {
                                                            // Obtener los valores de las entradas numéricas
                                                            const quantityValue{{ $index + 1 }} = quantity{{ $index + 1 }}.value;
                                                            const differenceFacturaValue{{ $index + 1 }} = differenceFactura{{ $index + 1 }}.value;

                                                            // Calcular la diferencia
                                                            const differenceValue{{ $index + 1 }} = quantityValue{{ $index + 1 }} -differenceFacturaValue{{ $index + 1 }};

                                                            // Mostrar el resultado en la entrada difference
                                                            difference{{ $index + 1 }}.value = differenceValue{{ $index + 1 }};
                                                            sumadiferencia();
                                                        });
                                                    </script>
                                                    <td>
                                                        <input class="w-100 " type="number" name="price[]" value=""
                                                            data-price-value="" onchange="sumadiferencia();" step="0.01" min="0" required>
                                                    </td>
                                                    <!---<td>
                                                        <select class="w-100" name="paymentoption[]"
                                                            onChange="toggleTable(this)" required>
                                                            <option value="Efectivo"
                                                                data-option-value="{{ $index }}">
                                                                Efectivo</option>
                                                            <option value="Credito"
                                                                data-option-value="{{ $index }}">
                                                                Credito
                                                            </option>
                                                        </select>
                                                    </td>--->
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                    <tr>
                                        <th COLSPAN=8></th>
                                    </tr>
                                    <tr>
                                        <th COLSPAN=3> Totales</th>
                                        <th>
                                            <input class="border-0 bg-transparent" type="number" name="sumquan"
                                                id="sumquan" value="" readonly>
                                        </th>
                                        <th>
                                            <input class="border-0 bg-transparent" type="number" name="sumdifac"
                                                id="sumdifac" value="" readonly>
                                        </th>
                                        <th>
                                            <input class="border-0 bg-transparent" type="number" name="sumdif"
                                                id="sumdif" value="" readonly>
                                        </th>
                                        <th>
                                            <input class="border-0 bg-transparent" type="number" name="sumpre"
                                                id="sumpre" value="" readonly>
                                        </th>
                                        <!---<th>
                                        </th>--->
                                    </tr>
                                    <script>
                                        function sumadiferencia() {
                                            var sum_quantity = 0;
                                            var sum_difference = 0;
                                            var sum_price = 0;
                                            var sum_differenceFactura = 0;
                                            var elements = document.getElementsByName('index[]');


                                            var elements_quantity = document.getElementsByName('quantity[]');
                                            var elements_differenceFactura = document.getElementsByName('differenceFactura[]');
                                            var elements_difference = document.getElementsByName('difference[]');
                                            var elements_price = document.getElementsByName('price[]');
                                            for (var i = 0; i < elements.length; i++) {

                                                var x_quantity = parseFloat(elements_quantity[i].value);
                                                var x_differenceFactura = parseFloat(elements_differenceFactura[i].value);
                                                var x_difference = parseFloat(elements_difference[i].value);
                                                var x_price = parseFloat(elements_price[i].value);

                                                sum_quantity = sum_quantity + x_quantity;
                                                sum_differenceFactura = sum_differenceFactura + x_differenceFactura;
                                                sum_difference = sum_difference + x_difference;
                                                sum_price = sum_price + x_price;

                                                document.getElementById("sumquan").value = sum_quantity.toFixed(2);
                                                document.getElementById("sumdifac").value = sum_differenceFactura.toFixed(2);
                                                document.getElementById("sumdif").value = sum_difference.toFixed(2);
                                                document.getElementById("sumpre").value = sum_price.toFixed(2);
                                            }
                                        }
                                    </script>
                                </table>
                            </div>
                            <div class="container">
                                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">
                                    <div class="col">
                                        <h3>Total de registros: {{ count(json_decode($data->product)) - 1 }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 m-0 border-0">
                                <input class="form-control" type="file" id="formFile" name="" multiple
                                    onchange="mostrarImagenesPrevias()">
                                <br>
                                <center>
                                    <div id="imagenesPrevias"></div>
                                    {{-- <textarea style="" name="Fileclosecash" id="base64textarea" placeholder="Base64 will appear here"
                                        cols="50" rows="15"></textarea> --}}
                                </center>

                                <script>
                                    function mostrarImagenesPrevias() {
                                        var archivos = document.querySelector('#formFile').files;
                                        var imagenesPreviasDiv = document.querySelector('#imagenesPrevias');

                                        for (var i = 0; i < archivos.length; i++) {
                                            var archivo = archivos[i];
                                            var lector = new FileReader();

                                            lector.onload = (function(archivo) {
                                                return function(e) {
                                                    var imagenPrevia = document.createElement('img');
                                                    var archivoimg = document.createElement('textarea');
                                                    imagenPrevia.src = e.target.result;
                                                    archivoimg.name = "archivosimg[]";
                                                    archivoimg.value = e.target.result;
                                                    archivoimg.style.display = "none";
                                                    imagenesPreviasDiv.appendChild(imagenPrevia);
                                                    imagenesPreviasDiv.appendChild(archivoimg);
                                                };
                                            })(archivo);
                                            lector.readAsDataURL(archivo);
                                        }
                                    }
                                </script>
                            </div>
                            <button type="submit" class="btn btn-outline-success w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z">
                                    </path>
                                    <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z">
                                    </path>
                                </svg>
                                Guardar
                            </button>
                            <br>
                            <br>
                        @endforeach
                    </div>
                </center>

                <div class="p-4 m-0 border-0">
                    <div class="card border-success">
                        <h5 class="card-header">Lista de productos a credito</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered border-success">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Numero de factura</th>
                                            <th>Abono</th>
                                            <th>Cantidad</th>
                                            <th>Cantidad factura</th>
                                            <th>Diferencia</th>
                                            <th>Precio</th>
                                            <th>Metodo de Pago</th>
                                        </tr>
                                    </thead>

                                    <tbody id="table-container">

                                    </tbody>

                                </table>
                            </div>
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
                                        var differenceFacturas = document.getElementsByName("differenceFactura[]");
                                        var differences = document.getElementsByName("difference[]");
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
                                            <td>${differenceFacturas[i].value}</td>
                                            <td>${differences[i].value}</td>
                                            <td>${prices[i].value}</td>
                                            <td>Credito</td>
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

                
                <br>
            </div>
        </form>
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
    </style>
@endsection
