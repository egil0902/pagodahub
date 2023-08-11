@extends('layouts.app')
@section('title', 'Page Title')


@section('content')
@if(session('refresh'))
    <script>
        window.location.reload();
    </script>
@endif
@if (session('mensaje'))
    <div class="alert alert-warning">{{ session('mensaje') }}</div>
@endif

    <div class="p-2 m-0 border-0 bd-example">
        <form name="market" id="market" method="get" action="{{ route('market.day', ['day' => 'monday']) }}">
                <div class="form-group w-50 "style="padding-left: 200px;">

                    @csrf
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" placeholder="" aria-label="" aria-describedby=""
                            spellcheck="false" data-ms-editor="true" name="day">
                        <button class="btn btn-outline-secondary" type="" id="button-addon2">Buscar</button>
                    </div>

                </div>
        </form>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                <div class="col">                
                    <h4>Presupuesto: 
                        <input class="w-100 form-control" type="text" name="presupuesto"
                        id="presupuesto" value="{{isset($presupuesto)?($presupuesto+$carton):0 }} " readonly>
                    </h4>
                </div>
                <div class="col">
                    <h4>Carton: {{$carton}}
                        <input class="w-100 form-control" type="number" name="carton" id="carton" value="0" 
                            min="0" step="1" onchange="sumapresupuesto();" >

                        
                        <input class="w-100 form-control" type="hidden" name="anterior"
                        id="anterior" value="{{$carton}}">
                        <script>
                            function sumapresupuesto(){
                                var carton=parseFloat(document.getElementById('carton').value);
                                var anterior=parseFloat(document.getElementById('anterior').value);
                                
                                if(carton){
                                    var presupuesto={{$presupuesto}}+{{$carton}};
                                    presupuesto=presupuesto+carton;
                                    document.getElementById('anterior').value=carton;
                                    document.getElementById('presupuesto').value=presupuesto;
                                }
                                sumadiferencia(0)
                            }
                        </script>
                    </h4>
                </div>
                <div class="col">
                    <h4>Vuelto entregado: 
                        <input class="w-100 form-control" type="text" name="vuelto_entregado"
                        id="vuelto_entregado" value="{{isset($vuelto)?($vuelto):0 }} "  onchange="sumapresupuesto();" >
                    </h4>
                </div>
                
            </div>
            @foreach ($comprasdeldia as $ind =>$data)
            @if($data->budget!==null)
                <form name="market[]" id="market{{$ind}}" method="post" action="{{ route('factures.store') }}">
                <div class="form-group w-50">
                    @csrf            
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Lista de productos
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                            <div class="col"> 
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="hidden" name="pres" value="{{ isset($presupuesto)?$presupuesto:0 }}">
                                <input type="hidden" name="cart" value="{{$carton}}">
                                <input type="hidden" name="vuelto_p" value="{{$vuelto}}">
                                <input type="hidden" name="fecha_registro" value="{{ $data->shoppingday }}">
                                <h4>Numero de factura:
                                    <input class="w-100 form-control" type="number" name="NFactura"
                                    id="NFactura" value=""
                                    required onchange="" step="" min="0">
                                </h4>
                            </div>
                            <div class="col">
                                <h4>Comprador: 
                                    <br/> 
                                    <input class="w-100 form-control" type="text" name="comprador"
                                    id="comprador" value="{{ $data->buyer }}" readonly
                                    required onchange="">
                                    </h4>
                            </div>
                            <div class="col">
                                <h4>Proveedor: 
                                    <input class="w-100 form-control" type="text" name="proveedor"
                                    id="proveedor" value=""
                                    required onchange="">
                                </h4>
                                
                            </div>
                            <div class="col">
                                <h4>Abono: 
                                    <input class="w-100 form-control" type="text" name="abono"
                                    id="abono" value="0" style="display: none;" onchange="sumadiferencia({{$ind}});"
                                    >
                                </h4>
                                
                            </div>
                            <div class="col">
                                <h4>Método de pago: 
                                    <select class="form-control unit" list="opciones"  name="metodo" id="metodo"
                                    onchange="activarAbono({{$ind}});">
                                    <option value="true">Efectivo</option>
                                    <option value="false">Credito</option>
                                </select>
                                </h4>
                            </div>
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
                                                @foreach (json_decode($data->product) as $index => $product)

                                                    @if ($loop->index < count(json_decode($data->product)) )
                                                        <tr>
                                                            <td style="max-width: 50px;">{{ $index + 1 }}</td>
                                                            <td>
                                                                <input class="border-0 bg-transparent" type="text"
                                                                    name="product[]{{$ind}}" 
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
                                                                    id="differenceFactura{{ $index + 1 }}" value="0"
                                                                    required onchange="sumadiferencia({{$ind}});" step="0.000001" min="0">
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
                                                                    sumadiferencia({{$ind}});
                                                                });
                                                            </script>
                                                            <td>
                                                                <input class="w-100 " type="number" name="price[]" value="0"
                                                                    data-price-value="" onchange="sumadiferencia({{$ind}});" step="0.000001" min="0" required>
                                                            </td>
                                                            <td>
                                                                <input class="w-100 border-0 bg-transparent" type="number"
                                                                    id="mult{{ $index + 1 }}" name="mult[]"
                                                                    value="" readonly>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                            
                                            <tr>
                                                <th COLSPAN=3> Total en factura</th>
                                                <th>
                                                    
                                                </th>
                                                <th>
                                                    <input class="border-0 bg-transparent total-difference-factura" type="number" name="sumdifac" value="0" readonly>

                                                </th>
                                                <th>
                                                </th>
                                                <th>
                                                </th>
                                                <th>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th COLSPAN=3> Total Recibido</th>
                                                <th>
                                                    
                                                </th>
                                                <th>
                                                    <input class="border-0 bg-transparent total-difference-compra" type="Tcompra" name="Tcompra" value="0" readonly>

                                                </th>
                                                <th>
                                                </th>
                                                <th>
                                                </th>
                                                <th>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th COLSPAN=3> Diferencia (mercancia recibida - en factura)</th>
                                                <th>
                                                    
                                                </th>
                                                <th>
                                                    <input class="border-0 bg-transparent total-difference-diff" type="number" name="diff" value="0" readonly>

                                                </th>
                                                <th>
                                                </th>
                                                <th>
                                                </th>
                                                <th>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th COLSPAN=3> Total a entregar (Vuelto)</th>
                                                <th>
                                                    
                                                </th>
                                                <th>
                                                    <input class="border-0 bg-transparent total-difference-final" type="number" name="pfinal" value="{{ $presupuesto+$carton }}" readonly>

                                                </th>
                                                <th>
                                                </th>
                                                <th>
                                                </th>
                                                <th>
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
                                                            elements_difference[i].value = difference.toFixed(6);
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
                                                        cart.value= carton.toFixed(6);
                                                        presupuesto= presupuesto;
                                                        sumaTotal(elements_market[numero],presupuesto);
                                                        
                                                    
                                                }
                                                    catch (error) {
                                                        console.log(error)
                                                        
                                                    }
                                                }
                                                function sumadiferenciaUpdate(numero,vuelto,viejoTotal) {
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

                                                        var vueltoNuevo= elements_market.querySelectorAll('[name="pfinal"]');
                                                        vueltoNuevo[0].value=vuelto-(nuevoTotal-viejoTotal);
                                                        
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
                                                        elements_mult[j].value=mult.toFixed(6);
                                                        sum_difference=sum_differenceFactura-sum_compra;
                                                    }

                                                    var totalDifferenceFacturaInput = table.querySelector('.total-difference-factura');
                                                    totalDifferenceFacturaInput.value = sum_differenceFactura.toFixed(6);
                                                    
                                                    var totalDifferenceCompraInput = table.querySelector('.total-difference-compra');
                                                    totalDifferenceCompraInput.value = sum_compra.toFixed(6);

                                                    var totalDifferenceInput = table.querySelector('.total-difference-diff');
                                                    totalDifferenceInput.value = sum_difference.toFixed(6);

                                                    var totalFinalInput = table.querySelector('.total-difference-final');
                                                    var total=totalFinalInput.value
                                                    var attributeValue = "{{ $data->budget }}"
                                                    var answer = presupuesto.toFixed(6) - sum_differenceFactura.toFixed(6);    
                                                    if(metodoSeleccionado){
                                                        abono.value;
                                                        
                                                        totalFinalInput.value = presupuesto.toFixed(6)- abono.value;
                                                    }else{
                                                        totalFinalInput.value = answer.toFixed(6);
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
                                                    
                                                    sumDifferenceInput.value = sum_difference.toFixed(6);
                                                    */
                                                    var sumPriceInput = table.querySelector('#sumpre');
                                                    sumPriceInput.value = sum_price.toFixed(6);
                                                }
                                            </script>
                                        </table>
                                        <br>
                                        <h4>Observaciones:</h4>
                                        <textarea class="long-textarea" id="observaciones" name="observaciones"></textarea>
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
                            
                            </div>
                        </center> 
                        <br>
                    </div>
                </form>
                
                @foreach ($facturas as $ind2 =>$dataf)
                
                @if($dataf->id_market==$data->id)
                
                    <form name="market[]" id="market{{$dataf->id_compra}}" method="post" action="{{ route('factures.update') }}">
                        <div class="form-group w-50">
                            @csrf            
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    Factura
                                </div>
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                                    <div class="col"> 
                                        <input type="hidden" name="id" value="{{ $dataf->id }}">
                                        <input type="hidden" name="pres" value="{{ isset($presupuesto)?$presupuesto:0 }}">
                                        <input type="hidden" name="cart" value="isset($carton)?$carton:0">
                                        <input type="hidden" name="fecha_registro" value="{{ $dataf->shoppingday }}">
                                        <h4>Numero de factura:
                                        <input class="w-100 form-control" type="number" name="NFactura" id="NFactura{{$ind2}}" value="{{$dataf->id_compra}}" readonly required onchange="" step="" min="0">
                                        </h4>
                                    </div>
                                    <div class="col">
                                        <h4>Comprador: 
                                            <br/> 
                                            {{ $dataf->buyer }}</h4>
                                    </div>
                                    <div class="col">
                                        <h4>Proveedor: 
                                            <input class="w-100 form-control" type="text" name="proveedor"
                                            id="proveedor" value="{{$dataf->proveedor}}" readonly
                                            required onchange="">
                                        </h4>
                                        
                                    </div>
                                    <div class="col">
                                        <h4>abono: 
                                            <input class="w-100 form-control" type="text" name="abono"
                                            id="abono" value="{{$dataf->monto_abonado}}" readonly
                                            >
                                        </h4>
                                        
                                    </div>
                                    
                                    <div class="col">
                                        <h4>Método de pago:
                                        <select class="form-control unit" list="opciones" name="metodo" id="metodo" onchange="activarAbono({{$ind2}});">
                                            <option value="true" {{$dataf->medio_de_pago+1 === 2 ? 'selected' : ''}}>Efectivo</option>
                                            <option value="false" {{$dataf->medio_de_pago+1 === 1 ? 'selected' : ''}}>Crédito</option>
                                        </select>
                                        </h4>
                                    </div>
                                    
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
                                                            <th>Cantidad factura</th>
                                                            <!--<th>Diferencia</th>-->
                                                            <th>Precio</th>
                                                            <!---<th>Medio de pago</th>--->
                                                            <th>Total</th>
                                                            <!---<th>Metodo de Pago</th>--->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach (json_decode($dataf->product) as $index => $product)

                                                            @if ($loop->index < count(json_decode($dataf->product)) )
                                                                <tr>
                                                                    <td style="max-width: 50px;">{{ $index + 1 }}</td>
                                                                    <td>
                                                                        <input class="border-0 bg-transparent" type="text"
                                                                            name="product[]{{$ind2}}" 
                                                                            id="product{{ $index + 1 }}"
                                                                            value="{{ $product }}"
                                                                            data-product-value="{{ $product }}" readonly>
                                                                    </td>
                                                                    <td>
                                                                        <input class="border-0 bg-transparent" type="text" name="unit[]"
                                                                            id="unit{{ $index + 1 }}"
                                                                            value=" {{ json_decode($dataf->units)[$index] }}"
                                                                            data-unit-value="{{ json_decode($dataf->units)[$index] }}"
                                                                            readonly>
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input class="w-100 " type="number" name="differenceFactura[]"
                                                                            id="differenceFactura{{ $index + 1 }}" value="{{json_decode($dataf->Factured_quantity)[$index]}}" 
                                                                            required onchange="sumadiferenciaUpdate({{$dataf->id_compra}},{{ $dataf->vuelto }},{{ $dataf->Total_compra }});" step="0.000001" min="0">
                                                                    </td>
                                                                    <script>
                                                                        // Obtener las entradas numéricas
                                                                        const cuantity{{ $index + 1 }} = document.getElementById('quantity{{ $index + 1 }}{{ $product }}');
                                                                        const diferenceFactura{{ $index + 1 }} = document.getElementById('differenceFactura{{ $index + 1 }}');
                                                                        const diference{{ $index + 1 }} = document.getElementById('difference{{ $index + 1 }}');

                                                                        // Agregar un evento input a la entrada differenceFactura
                                                                        diferenceFactura{{ $index + 1 }}.addEventListener('input', function() {
                                                                            // Obtener los valores de las entradas numéricas
                                                                            const quantityValue{{ $index + 1 }} = cuantity{{ $index + 1 }}.value;
                                                                            const diferenceFacturaValue{{ $index + 1 }} = diferenceFactura{{ $index + 1 }}.value;

                                                                            // Calcular la diferencia
                                                                            const differenceValue{{ $index + 1 }} = quantityValue{{ $index + 1 }} -diferenceFacturaValue{{ $index + 1 }};

                                                                            // Mostrar el resultado en la entrada difference
                                                                            difference{{ $index + 1 }}.value = differenceValue{{ $index + 1 }};
                                                                            sumadiferenciaUpdate({{$dataf->id_compra}},{{ $dataf->vuelto }},{{ $dataf->Total_compra }});
                                                                        });
                                                                    </script>
                                                                    <td>
                                                                        <input class="w-100 " type="number" name="price[]" value="{{json_decode($dataf->price)[$index]}}"
                                                                            data-price-value="" onchange="sumadiferenciaUpdate({{$dataf->id_compra}},{{ $dataf->vuelto }},{{ $dataf->Total_compra }});" step="0.000001" min="0" required >
                                                                    </td>
                                                                    <td>
                                                                        <input class="w-100 border-0 bg-transparent" type="number"
                                                                            id="mult{{ $index + 1 }}" name="mult[]"
                                                                            value="{{json_decode($dataf->price)[$index]*json_decode($dataf->Factured_quantity)[$index]}}" readonly>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                    <tr>
                                                        <th COLSPAN=3> Total en factura</th>
                                                        <th>
                                                            
                                                        </th>
                                                        <th>
                                                            <input class="border-0 bg-transparent total-difference-factura" type="number" name="sumdifac" value="{{ $dataf->Total_compra }}" readonly>

                                                        </th>
                                                        <th>
                                                        </th>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <th COLSPAN=3>Vuelto</th>
                                                        <th>
                                                            
                                                        </th>
                                                        <th>
                                                            <input class="border-0 bg-transparent total-difference-final" type="number" name="pfinal" value="{{ $dataf->vuelto }}" readonly>

                                                        </th>
                                                        <th>
                                                        </th>
                                                    </tr>
                                                </table>
                                                <h4>Observaciones:</h4>
                                                <textarea class="long-textarea" id="observaciones" name="observaciones" readonly>{{$dataf->descripcion}}</textarea>
                                            </div>
                                            
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-outline-success w-100" onclick="showConfirmationEditPopup(event)" data-compra="{{$dataf->id_compra}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"></path>
                                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"></path>
                                                </svg>
                                                Actualizar {{$dataf->id_compra}}
                                            </button>

                                            <script>
                                                function showConfirmationPopup(event) {
                                                    event.preventDefault();
                                                    var compra = event.target.dataset.borrar;
                                                    var confirmed = confirm("¿Estás seguro de que deseas eliminar la factura " + compra + "?");
                                                    if (confirmed) {
                                                        document.getElementById("borrar" + compra).submit();
                                                    }
                                                }
                                                function showConfirmationEditPopup(event) {
                                                    event.preventDefault();
                                                    var compra = event.target.dataset.compra;
                                                    var confirmed = confirm("¿Estás seguro de que deseas actualizar la factura " + compra + "?");
                                                    console.log("🚀 ~ file: marketinvoice.blade.php:636 ~ showConfirmationEditPopup ~ compra:", compra)
                                                    if (confirmed) {
                                                        document.getElementById("market" + compra).submit();
                                                    }
                                                }

                                            </script>
                                    
                                    </div>
                                </center> 
                            </div>
                    </form>
                    <form action="{{ route('factures.borrar', $dataf->id) }}" id='borrar{{$dataf->id_compra}}' method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100" onclick="showConfirmationPopup(event)"  data-borrar="{{$dataf->id_compra}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"></path>
                            </svg>
                            Borrar {{$dataf->id_compra}}
                        </button>
                    </form> 
                    <br>
                @endif   
                @endforeach
            @endif 
            @endforeach
            
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
            .long-textarea {
                width: 100%;
                height: 150px;
                resize: vertical; /* Permite redimensionar verticalmente */
            }
        </style>
@endsection
