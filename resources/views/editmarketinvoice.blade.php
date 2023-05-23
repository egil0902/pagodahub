@extends('layouts.app')
@section('title', 'Page Title')


@section('content')
@if(session('refresh'))
    <script>
        window.location.reload();
    </script>
@endif
<div class="p-2 m-0 border-0 bd-example">
	    @foreach ($comprasdeldia as $data)   
        <form name="market" id="market" method="post" action="{{ route('factures.update',$data->id) }}">
        <div class="form-group w-50">
            @csrf
            @method('GET')          
            </div>
            <div class="card">
                <div class="card-header">
                    Facturas
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                                <div class="col"> 
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <input type="hidden" name="fecha_registro" value="{{ $data->shoppingday }}">
                                    <h4>Numero de factura:
                                        <input class="w-100 form-control" type="number" name="NFactura"
                                        id="NFactura" value="{{ $data->id_compra }}"
                                        required onchange="" step="" min="0">
                                    </h4>
                                </div>
                                <div class="col">
                                    <h4>Comprador: 
                                        <br/> 
                                        {{ $data->buyer }}</h4>
                                </div>
                                <div class="col">
                                    <h4>Proveedor: 
                                        <input class="w-100 form-control" type="text" name="proveedor"
                                        id="proveedor" value="{{ $data->proveedor }}"
                                        required onchange="">
                                    </h4>
                                    
                                </div>
                                <div class="col">
                                    <h4>abono: 
                                        <input class="w-100 form-control" type="text" name="abono"
                                        id="abono" value="{{ $data->monto_abonado }}"
                                        onchange="">
                                    </h4>
                                    
                                </div>
                                <div class="col">
                                    <h4>metodo de pago: 
                                        <select class="form-control unit" list="opciones"  name="metodo" id="metodo"
                                        value="{{ $data->medio_de_pago }}">
                                        <option value="true">Efectivo</option>
                                        <option value="false">Credito</option>
                                    </select>
                                    </h4>
                                    <h4>presupuesto: 
                                        <input class="w-100 form-control" type="text" name="presupuesto"
                                        id="presupuesto" value="{{ $data->budget }} " readonly>
                                    </h4>
                                </div>
                                <div class="col">
                                    <h4>Carton: 
                                        <input class="w-100 form-control" type="text" name="carton"
                                        id="carton" value="{{ $data->carton }}"
                                        onchange="">
                                    </h4>                                    
                                </div>
                                
                            </div>
                <br>
                <center>                    
                    <div class="p-4 m-0 border-0">
                        
                            <div class="table-responsive table-responsive-sm">
                                <table class="table table-bordered border-success">
                                    <thead>
                                        <tr>
                                            <th style="max-width: 50px;">#</th>
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

                                            @if ($loop->index < count(json_decode($data->product)) )
                                                <tr>
                                                     <td style="max-width: 50px;">{{ $index + 1 }}</td>
                                                    <td>
                                                        <input class="border-0 bg-transparent" type="text"
                                                            name="product[]" 
                                                            id="product{{ $index + 1 }}"
                                                            value="{{ $product }}"
                                                            data-product-value="{{ $product }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input class="border-0 bg-transparent" type="text" name="unit[]"
                                                            id="unit{{ $index + 1 }}"
                                                            value=" {{ json_decode($data->unit)[$index] }}"
                                                            data-unit-value="{{ json_decode($data->unit)[$index] }}"
                                                            readonly>
                                                    </td>
                                                    <td>
                                                        <input class="border-0 bg-transparent" type="number"
                                                            name="quantity[]"
                                                            id="quantity{{ $index + 1 }}{{ $product }}"
                                                            value="{{ isset(json_decode($data->quantity)[$index]) ? json_decode($data->quantity)[$index] : '0' }}"
                                                            data-quantity-value="{{ isset(json_decode($data->quantity)[$index]) ? json_decode($data->quantity)[$index] : '0' }}"
                                                            readonly>
                                                    </td>
                                                    <td>
                                                        <input class="w-100 " type="number" name="differenceFactura[]"
                                                            id="differenceFactura{{ $index + 1 }}" value="{{ isset(json_decode($data->factured_quantity)[$index]) ? json_decode($data->factured_quantity)[$index] : '0' }}"
                                                            required onchange="sumadiferencia();" step="0.01" min="0">
                                                    </td>
                                                    <td>
                                                        <input class="w-100 border-0 bg-transparent" type="number"
                                                            id="difference{{ $index + 1 }}" name="difference[]"
                                                            value="" 
                                                            readonly>
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
                                                        <input class="w-100 " type="number" name="price[]" 
                                                        value="{{ isset(json_decode($data->price)[$index]) ? json_decode($data->price)[$index] : '0' }}"
                                                            data-price-value="" onchange="sumadiferencia();" step="0.01" min="0" required>
                                                    </td>                                                    
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                    <tr>
                                        <th COLSPAN=8></th>
                                    </tr>
                                    <tr>
                                        <th COLSPAN=3> Total facturado</th>
                                        <th>
                                            
                                        </th>
                                        <th>
                                            <input class="border-0 bg-transparent total-difference-factura" type="number" name="sumdifac" value="0" readonly>

                                        </th>
                                        <th>
                                        </th>
                                        <th>
                                        </th>
                                        <!---<th>
                                        </th>--->
                                    </tr>
                                    <tr>
                                        <th COLSPAN=3> Total comprado</th>
                                        <th>
                                            
                                        </th>
                                        <th>
                                            <input class="border-0 bg-transparent total-difference-compra" type="Tcompra" name="Tcompra" value="0" readonly>

                                        </th>
                                        <th>
                                        </th>
                                        <th>
                                        </th>
                                        <!---<th>
                                        </th>--->
                                    </tr>
                                    <tr>
                                        <th COLSPAN=3> diferencia</th>
                                        <th>
                                            
                                        </th>
                                        <th>
                                            <input class="border-0 bg-transparent total-difference-diff" type="number" name="diff" value="0" readonly>

                                        </th>
                                        <th>
                                        </th>
                                        <th>
                                        </th>
                                        <!---<th>
                                        </th>--->
                                    </tr>
                                    <tr>
                                        <th COLSPAN=3> Presupuesto final</th>
                                        <th>
                                            
                                        </th>
                                        <th>
                                            <input class="border-0 bg-transparent total-difference-final" type="number" name="pfinal" value="{{ $data->budget }}" readonly>

                                        </th>
                                        <th>
                                        </th>
                                        <th>
                                        </th>
                                        <!---<th>
                                        </th>--->
                                    </tr>
                                    
                                    <script>
                                        function sumadiferencia() {
                                            try {
                                                
                                            
                                            var sum_differenceFactura = 0;
                                            var elements_quantity = document.getElementsByName('quantity[]');
                                            var elements_differenceFactura = document.getElementsByName('differenceFactura[]');
                                            var elements_difference = document.getElementsByName('difference[]');
                                            var elements_price = document.getElementsByName('price[]');
                                           

                                            for (var i = 0; i < elements_quantity.length; i++) {
                                                var quantity = parseFloat(elements_quantity[i].value);
                                                var differenceFactura = parseFloat(elements_differenceFactura[i].value);
                                                var difference = quantity - differenceFactura;
                                                if(difference==null){
                                                    elements_difference[i].value =0.0;
                                                }else{
                                                elements_difference[i].value = difference.toFixed(2);
                                                }
                                            }

                                            
                                            // Call the sumaTotal() function
                                            var tables = document.getElementsByTagName('table');
                                            
                                            for (var i = 0; i < tables.length; i++) {
                                                var presupuesto=parseFloat(document.getElementsByName('presupuesto')[i].value);
                                                var abono=parseFloat(document.getElementsByName('abono')[i].value);
                                                var carton=parseFloat(document.getElementsByName('carton')[i].value);
                                                presupuesto= presupuesto+carton-abono;
                                                sumaTotal(tables[i],presupuesto);
                                            }
                                        }
                                            catch (error) {
                                                console.log("🚀 ~ file: marketinvoice.blade.php:206 ~ sumadiferencia ~ error:", error)
                                                
                                            }
                                        }
                                        function sumaTotal(table,presupuesto) {
                                            var sum_differenceFactura = 0;
                                            var sum_difference = 0;
                                            var sum_price = 0;
                                            var sum_compra= 0;
                                            
                                            var elements_differenceFactura = table.querySelectorAll('input[name="differenceFactura[]"]');
                                            var elements_price = table.querySelectorAll('input[name="price[]"]');
                                            var elements_compra = table.querySelectorAll('input[name="quantity[]"]');
                                            var diff=0
                                            for (var j = 0; j < elements_differenceFactura.length; j++) {
                                                var differenceFactura = parseFloat(elements_differenceFactura[j].value);
                                                var price = parseFloat(elements_price[j].value);
                                                var diffCompra = parseFloat(elements_compra[j].value);
                                                sum_differenceFactura += differenceFactura * price;
                                                sum_compra+=diffCompra*price;
                                                sum_difference=sum_compra-sum_differenceFactura;
                                            }

                                            var totalDifferenceFacturaInput = table.querySelector('.total-difference-factura');
                                            totalDifferenceFacturaInput.value = sum_differenceFactura.toFixed(2);

                                            var totalDifferenceCompraInput = table.querySelector('.total-difference-compra');
                                            totalDifferenceCompraInput.value = sum_compra.toFixed(2);

                                            var totalDifferenceInput = table.querySelector('.total-difference-diff');
                                            totalDifferenceInput.value = sum_difference.toFixed(2);

                                            var totalFinalInput = table.querySelector('.total-difference-final');
                                            var total=totalFinalInput.value
                                            var attributeValue = "{{ $data->budget }}"
                                            totalFinalInput.value = presupuesto.toFixed(2) - sum_compra.toFixed(2);

                                            // Update other total values if needed
                                            // ...

                                            // Example: Update total sum of differences and prices
                                            var elements_difference = table.querySelectorAll('input[name="difference[]"]');
                                            var elements_quantity = table.querySelectorAll('input[name="quantity[]"]');


                                            for (var l = 0; l < elements_price.length; l++) {
                                                var quantity = parseFloat(elements_quantity[l].value);
                                                var price = parseFloat(elements_price[l].value);
                                                sum_price += price;
                                            }

                                            var sumDifferenceInput = table.querySelector('#sumdif');
                                            
                                            sumDifferenceInput.value = sum_difference.toFixed(2);

                                            var sumPriceInput = table.querySelector('#sumpre');
                                            sumPriceInput.value = sum_price.toFixed(2);
                                        }
                                    </script>
                                </table>
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
                                Modificar
                            </button>
                            <br>
                            <br>
                       
                    </div>
                </center> 
                <br>
            </div>
        </form>
        @endforeach
        <script>
            // Función que se ejecuta cuando la página ha cargado completamente
            document.addEventListener("DOMContentLoaded", function(event) {
                sumadiferencia();
            });
        </script>
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
    </style>
@endsection
