<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        
    </title>
</head>
<body>

    <div class="p-2 m-0 border-0 bd-example">
        
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                <div class="col">                
                    <h4>Presupuesto inicial: {{isset($presupuesto)?($presupuesto+$carton):0 }}
                    </h4>
                    <h4>Carton: {{$carton}}
                        <input class="w-100 form-control" type="number" name="carton" id="carton" value="0" 
                            min="0" step="1" onchange="sumapresupuesto();" >
                    </h4>
                </div>
                
            </div>
            @foreach ($comprasdeldia as $ind =>$data)
            @if($data->budget!==null)
                <div class="form-group w-50">
                    @csrf            
                    </div>
                    <div class="card">
                        
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                            
                            <div class="col">
                                <h4>Comprador: {{ $data->buyer }}
                                    </h4>
                            </div>
                        </div>
                        <div class="card-header">
                            Lista de productos
                        </div>
                        <br>
                        <center>                    
                            <div class="p-4 m-0 border-0">
                                
                                    <div class="table-responsive table-responsive-sm">
                                        <table name="table[]" class="table table-bordered border-success">
                                            <thead>
                                                <tr>
                                                    <th style="max-width: 50px;">#</th>
                                                    <th>Producto</th>
                                                    <th>Unidad</th>
                                                    <th>Cantidad</th>
                                                    <th>Cantidad factura</th>
                                                    <th>Diferencia</th>
                                                    <th>Precio</th>
                                                    <!---<th>Medio de pago</th>--->
                                                    <th>Total</th>
                                                    <!---<th>Metodo de Pago</th>--->
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $totalCompra = 0;
                                                $totalRecibido= 0;
                                                
                                            @endphp
                                                @foreach (json_decode($data->product) as $index => $product)

                                                    @if ($loop->index < count(json_decode($data->product)) )
                                                        <tr>
                                                            <td style="max-width: 50px;">{{ $index + 1 }}</td>
                                                            <td>
                                                                {{$product}}
                                                            </td>
                                                            <td>
                                                                {{ json_decode($data->unit)[$index] }}
                                                            </td>
                                                            <td>
                                                                {{ isset(json_decode($data->quantity)[$index]) ? json_decode($data->quantity)[$index] : '0' }}
                                                            </td>
                                                            <td>
                                                                {{json_decode($data->quantity)[$index]-$quantity[$index]}}
                                                            </td>
                                                            <td>
                                                                {{$quantity[$index]}}
                                                            </td>                                                            
                                                            <td>
                                                                {{$price[$index]}}
                                                            </td>
                                                            <td>
                                                            @php
                                                                $totalCompra += $price[$index]*(json_decode($data->quantity)[$index]-$quantity[$index]);
                                                                $totalRecibido +=json_decode($data->quantity)[$index]*$price[$index];
                                                            @endphp
                                                                {{$price[$index]*(json_decode($data->quantity)[$index]-$quantity[$index])}}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                            
                                            <tr>
                                                <th COLSPAN=5> Total en factura</th>
                                                <th>                                                    
                                                </th>                                                
                                                <th>
                                                </th>
                                                <th>
                                                {{$totalCompra}}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th COLSPAN=5> Total Recibido</th>
                                                <th>                                                    
                                                </th>                                                
                                                <th>
                                                </th>
                                                <th>
                                                    {{$totalRecibido}}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th COLSPAN=5> Diferencia (mercancia recibida - en factura)</th>                                                
                                                <th>
                                                </th>
                                                <th>
                                                </th>
                                                <th>
                                                {{$totalCompra-$totalRecibido}}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th COLSPAN=5> Total a entregar (Vuelto)</th>                                                
                                                <th>
                                                </th>                                                
                                                <th>
                                                </th>
                                                <th>
                                                    {{ $carton+$presupuesto-$totalCompra }}

                                                </th>
                                            </tr>
                                            
                                            <script>
                                                var metodoSeleccionado=false
                                                function activarAbono(numero){
                                                    var elements_market = document.getElementsByName('market[]');
                                                    var metodo=elements_market[numero].querySelectorAll('[name="metodo"]');
                                                    var abono=elements_market[numero].querySelectorAll('[name="abono"]');
                                                    // Obtener el valor seleccionado en el método de pago
                                                    metodoSeleccionado = metodo[0].value;
                                                    
                                                    // Verificar el valor seleccionado y establecer la visibilidad del elemento "abono"
                                                    if (metodoSeleccionado === 'false') { // Si el método de pago es "Credito"
                                                        abono[0].style.display = 'block'; // Mostrar el elemento "abono"
                                                    } else {
                                                        abono[0].style.display = 'none'; // Ocultar el elemento "abono"
                                                    }

                                                }
                                                function sumadiferencia(numero) {
                                                    try {
                                                        var elements_market = document.getElementsByName('market[]');
                                                        var sum_differenceFactura = 0;
                                                        var elements_quantity = elements_market[numero].querySelectorAll('[name="quantity[]"]');
                                                        var elements_differenceFactura =elements_market[numero].querySelectorAll('[name="differenceFactura[]"]');
                                                        var elements_difference = elements_market[numero].querySelectorAll('[name="difference[]"]');
                                                        var elements_price = elements_market[numero].querySelectorAll('[name="price[]"]');
                                                   

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
                                                        //var tables = elements_market[numero].querySelectorAll('[name="table[]"]');
                                                        
                                                        var presupuesto=parseFloat(document.getElementById('presupuesto').value);
                                                        var abono=parseFloat(elements_market[numero].querySelectorAll('[name="abono"]')[0].value);
                                                        var carton=parseFloat(document.getElementById('carton').value);
                                                        var cart = elements_market[numero].querySelectorAll('[name="cart"]')[0];
                                                        var vuelto_entregado=parseFloat(document.getElementById('vuelto_entregado').value);
                                                        var vuelto_p = elements_market[numero].querySelectorAll('[name="vuelto_p"]')[0];
                                                        vuelto_p.value= vuelto_entregado.toFixed(2);
                                                        cart.value= carton.toFixed(2);
                                                        presupuesto= presupuesto;
                                                        sumaTotal(elements_market[numero],presupuesto);
                                                        
                                                    
                                                }
                                                    catch (error) {
                                                        console.log(error)
                                                        
                                                    }
                                                }
                                                function sumadiferenciaUpdate(numero,vuelto,viejoTotal,medioPago) {
                                                    try {
                                                        var elements_market = document.getElementById('market'+numero);
                                                        console.log(elements_market)
                                                    
                                                        var sum_differenceFactura = 0;
                                                        var elements_differenceFactura =elements_market.querySelectorAll('[name="differenceFactura[]"]');
                                                        var elements_price = elements_market.querySelectorAll('[name="price[]"]');
                                                        var elements_mult = elements_market.querySelectorAll('[name="mult[]"]');
                                                        var nuevoTotal=0;
                                                        for (var i = 0; i < elements_differenceFactura.length; i++) {
                                                            var differenceFactura = parseFloat(elements_differenceFactura[i].value);
                                                            var price = parseFloat(elements_price[i].value);  
                                                            nuevoTotal=differenceFactura*price;                                             
                                                            elements_mult[i].value=nuevoTotal;
                                                            
                                                        }
                                                        var total= elements_market.querySelectorAll('[name="sumdifac"]');
                                                        total[0].value=nuevoTotal;
                                                        if(medioPago){
                                                        var vueltoNuevo= elements_market.querySelectorAll('[name="pfinal"]');
                                                        vueltoNuevo[0].value=vuelto-(nuevoTotal-viejoTotal);
                                                        }
                                                        // Call the sumaTotal() function
                                                        //var tables = elements_market[numero].querySelectorAll('[name="table[]"]');
                                                        
                                                    }
                                                    catch (error) {
                                                        console.log(error)
                                                        
                                                    }
                                                }
                                                function sumaTotal(table,presupuesto) {
                                                    var sum_differenceFactura = 0;
                                                    var sum_difference = 0;
                                                    var sum_price = 0;
                                                    var sum_compra= 0;

                                                    var abono=table.querySelectorAll('[name="abono"]')[0];
                                                    var elements_differenceFactura = table.querySelectorAll('input[name="differenceFactura[]"]');
                                                    var elements_price = table.querySelectorAll('input[name="price[]"]');
                                                    var elements_compra = table.querySelectorAll('input[name="quantity[]"]');
                                                    var elements_mult = table.querySelectorAll('input[name="mult[]"]');
                                                    
                                                    var diff=0
                                                    for (var j = 0; j < elements_differenceFactura.length; j++) {
                                                        var differenceFactura = parseFloat(elements_differenceFactura[j].value);
                                                        var price = parseFloat(elements_price[j].value);
                                                        var diffCompra = parseFloat(elements_compra[j].value);
                                                        sum_differenceFactura += differenceFactura * price;
                                                        sum_compra+=diffCompra*price;
                                                        var mult=differenceFactura*price;
                                                        elements_mult[j].value=mult.toFixed(2);
                                                        sum_difference=sum_differenceFactura-sum_compra;
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
                                                    var answer = presupuesto.toFixed(2) - sum_differenceFactura.toFixed(2);    
                                                    if(metodoSeleccionado){
                                                        abono.value;
                                                        
                                                        totalFinalInput.value = presupuesto.toFixed(2)- abono.value;
                                                    }else{
                                                        totalFinalInput.value = answer.toFixed(2);
                                                    }
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
                                                    /*
                                                    var sumDifferenceInput = table.querySelector('#sumdif');
                                                    
                                                    sumDifferenceInput.value = sum_difference.toFixed(2);
                                                    */
                                                    var sumPriceInput = table.querySelector('#sumpre');
                                                    sumPriceInput.value = sum_price.toFixed(2);
                                                }
                                            </script>
                                        </table>
                                        <br>
                                    </div>
                            
                            </div>
                        </center> 
                        <br>
                    </div>
            @endif 
            @endforeach
            
        </div>
        <style>
            .centrado {
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }

    table {
        font-family: Arial, sans-serif;
        background-color: white;
        text-align: left;
        border-collapse: collapse;
        width: 100%;
    }

    table th,
    table td {
        padding: 7px;
    }

    table thead {
        background-color: #246355;
        border-bottom: 5px solid #0F362D;
        color: white;
    }

    table th {
        max-width: 100px;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-size:15px;
    }

    table tr:nth-child(even) {
        background-color: #ddd;
    }

    table tr:hover td {
        background-color: #369681;
        color: white;
    }

    table thead th[colspan="12"],
    table thead th[colspan="5"],
    table thead th[colspan="3"] {
        padding-top: 10px;
        padding-bottom: 10px;
    }

    table thead th[colspan="12"],
    table thead th[colspan="5"],
    table thead th[colspan="3"],
    table td[colspan="2"] {
        text-align: center;
    }

    table td[colspan="2"] {
        font-weight: bold;
    }

    table tr td:first-child {
        font-weight: bold;
    }

    table tr:last-child td {
        font-weight: bold;
    }

    .table-divider {
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
</body>
