@extends('layouts.app')
@section('title', 'Page Title')


@section('content')
<div class="p-2 m-0 border-0 bd-example">
    <div class="d-flex">
        
        <!-- Formulario de búsqueda por proveedor -->
        <div class="container w-auto m-0 pl-0">
            <div class="card">
                <div class="card-header">Filtrar facturas</div>
                <div class="card-body">
                    <form name="provider" id="provider" method="post" action="{{ route('factures.searchByProvider') }}" >
                        <div class="form-group">
                            @csrf
                            <div class="input-group">
                                <input  type="text" class="form-control" placeholder="" aria-label="" aria-describedby="" spellcheck="false" name="provider">
                                <button class="btn btn-outline-secondary mt-1" type="submit" id="button-addon2">Buscar proveedor</button>
                            </div>
                        </div>
                    </form>
                    <!-- Formulario para mostrar facturas a crédito -->
                    <form name="provider" id="provider" method="post" action="{{ route('factures.credit') }}">
                        <div class="form-group w-auto">
                            @csrf
                            <button class=" w-100 btn btn-outline-secondary m-0" type="submit" id="button-addon2">Mostrar facturas sin pagar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div style="padding-top: 20px;">
        Presupuesto restante para el dia: {{$presupuesto}}
        </div>
        
    </div>
    <br>
    <div>
        <form name="imprimirCheque" id="imprimirCheque" method="post" action="{{ route('facture-pdf') }}">

            @csrf
            <div class="form-group">
                <input type="hidden" name="facturas_ids" id="facturas_ids" value="">
                <div>
                    <label for="pagoPresupuesto">Descontar del presupuesto del día?</label>
                    <input type="checkbox" name="pagoPresupuesto" id="pagoPresupuesto" value="true" checked onchange="togglePagoPresupuesto(this)">
                </div>

                <!--<div>
                    <label for="pagoValor">¿Desea pagar un monto?</label>
                    --><input type="hidden" name="pagoValor" id="pagoValor" value="true" onchange="togglePagoParcial(this)">
                <!--</div>
                <div>
                    <label for="monto">Monto:</label>
                    --><input type="hidden" name="monto" id="monto" maxlength="10" value="0" disabled>
                <!--</div>-->
                    <input type="hidden" name="factura_ids" id="factura_ids" value="">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                        Pagar facturas
                    </button>
                            
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

                <!-- Código HTML para el modal personalizado -->
                <div class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p>Va a pagar lo siguiente.</p>
                                <!-- Agrega aquí la lógica para mostrar la información que deseas -->
                                <tr>
                                    <!--variable pagos-->
                                </tr>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="confirmar">Confirmar</button>
                                <button type="button" class="btn btn-secondary" id="cancelar" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById("imprimirCheque").addEventListener("submit", function(event) {
                    event.preventDefault();

                    // Obtén los checkboxes seleccionados
                    var checkboxes = document.querySelectorAll('input[name="factura_ids[]"]:checked');

                    // Obtén los IDs de las facturas seleccionadas
                    var selectedIds = [];
                    checkboxes.forEach(function(checkbox) {
                        selectedIds.push(checkbox.value);
                    });

                    // Asigna los IDs al campo oculto
                    document.getElementById('factura_ids').value = selectedIds.join(',');

                    // Mostrar el modal personalizado
                    $('.modal').modal('show');

                    // Obtener el elemento <ul> para agregar los elementos de la lista
                    var listaPagos = document.createElement('ul');
                    listaPagos.classList.add('list-group');

                    // Recorrer el arreglo `pagos` y agregar elementos <li> a la lista
                    pagos.forEach(function(pago) {
                        var listItem = document.createElement('li');
                        listItem.classList.add('list-group-item');
                        listItem.textContent = '# Factura: ' + pago.fact_id + ' Valor: ' + pago.total;
                        listaPagos.appendChild(listItem);
                    });

                    // Obtener el elemento <div> del modal para agregar la lista de pagos
                    var modalBody = document.querySelector('.modal-body');
                    modalBody.innerHTML = 'Vas a pagar lo siguiente:';
                    modalBody.appendChild(listaPagos);

                    // Manejar el evento de confirmación
                    document.getElementById("confirmar").addEventListener("click", function() {
                        
                            if(pagos.length){

                                event.target.submit();
                                pagos.forEach(function(pago) {
                                    var row = document.getElementById('row' + pago.fact_id)
                                    row.style.display = "none";
                                });
                                pagos=[];
                            }
                            
                            $('.modal').modal('hide');
                        });

                        // Manejar el evento de cancelación
                        document.getElementById("cancelar").addEventListener("click", function() {
                            $('.modal').modal('hide');

                        });
                    });

                </script>
            </div>
        </form>
        <br/>
        <script>
            function togglePagoParcial(checkbox) {
                if (checkbox.checked) {
                    checkbox.value = "true";
                    document.getElementById('monto').disabled = false;
                } else {
                    checkbox.value = "false";
                    document.getElementById('monto').disabled = true;
                }
            }

            function togglePagoPresupuesto(checkbox) {
                if (checkbox.checked) {
                    checkbox.value = "true";
                } else {
                    checkbox.value = "false";
                }
            }

            function confirmarPago() {
                // Enviar el formulario
                document.getElementById('provider').submit();
            }
        </script>
    </div>

        <div>
            <table>
                <thead>
                    <tr>
                        <th># Factura</th>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>Medio de pago</th>
                        <th>Abono</th>
                        <th>Valor Deuda</th>
                        <th></th>
                        <th>
                            <input type="checkbox" id="selectAllCheckbox" onclick="toggleSelectAll(this)">
                        </th>
                        <script>
                            function toggleSelectAll(checkbox) {
                                var checkboxes = document.querySelectorAll('input[data-checkbox]');

                                if(checkbox.checked===true){
                                    
                                    var totalElement = document.getElementById('totalCancelar');
                                    var total = parseFloat(totalElement.innerText) || 0;
                                    total = parseFloat(0);
                                    totalElement.innerText = total.toFixed(2);
                                }
                                for (var i = 0; i < checkboxes.length; i++) {
                                    checkboxes[i].checked = checkbox.checked;
                                    toggleSelectToPay(checkboxes[i]);
                                }
                                if(checkbox.checked===false){
                                    
                                    var totalElement = document.getElementById('totalCancelar');
                                    var total = parseFloat(totalElement.innerText) || 0;
                                    total = parseFloat(0);
                                    totalElement.innerText = total.toFixed(2);
                                }
                            }
                        </script>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($facturas as $factura)
                    <tr name="row{{$factura->id_compra}}" id="row{{$factura->id_compra}}">
                        <td name="id{{$factura->id_compra}}" id="id{{$factura->id_compra}}">{{$factura->id_compra}}</td>
                        <td>{{$factura->fecha}}</td>
                        <td>{{$factura->proveedor}}</td>
                        <td>{{$factura->medio_de_pago?"Contado":"Crédito"}}</td>
                        <td>{{$factura->monto_abonado}}</td>
                        <td name="total{{$factura->id_compra}}" id="total{{$factura->id_compra}}">{{$factura->Total_compra- $factura->monto_abonado}}</td>
                        <td>
                        <form action="{{ route('factures.eliminar') }}" method="post" id="deleteForm">
                            @csrf
                            @method('DELETE')
                            <input type='hidden' name="id" value='{{$factura->id}}'>
                            <button type="button" class="btn btn-outline-danger" onclick="showConfirmationPopup()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"></path>
                                </svg>
                            </button>
                        </form>

                        <script>
                            function showConfirmationPopup() {
                                // Muestra el popup de confirmación (puedes usar librerías como Bootstrap o implementar tu propio popup)
                                // Aquí hay un ejemplo de cómo mostrar un popup simple utilizando JavaScript nativo:
                                var confirmed = confirm("¿Estás seguro de que deseas eliminar esta factura?");
                                
                                if (confirmed) {
                                    // Si el usuario confirma, envía el formulario
                                    document.getElementById("deleteForm").submit();
                                }
                            }
                        </script>

                        </td>
                        <td>
                            <input type="hidden" name="totalPagar{{$factura->id_compra}}" id="totalPagar{{$factura->id_compra}}" value="{{$factura->Total_compra >= 0 ? $factura->monto_abonado : $factura->Total_compra}}">
                            <input type="checkbox" name="factura_ids[]" value="{{$factura->id_compra}}" onchange="toggleSelectToPay(this)" data-checkbox>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>Total a pagar</td>
                        <td><span id="totalCancelar">0</span></td>
                    </tr>
                </tbody>
            </table>
            <script>
                var pagos = [];

                function toggleSelectToPay(checkbox) {
                    var totalElement = document.getElementById('totalCancelar');
                    var total = parseFloat(totalElement.innerText) || 0;
                    var facturaTotal = document.getElementById('totalPagar' + checkbox.value).innerText;
                    var fact_id = document.getElementById('id' + checkbox.value).innerText;
                    var totalValue = parseFloat(document.getElementById('total' + checkbox.value).innerText);
                    console.log(totalValue)
                    if (checkbox.checked) {
                        total += parseFloat(totalValue);
                        pagos.push({ fact_id: fact_id, total: totalValue });
                    } else {
                        total -= parseFloat(totalValue);
                        pagos = pagos.filter(function(pago) {
                            return pago.fact_id !== fact_id;
                        });
                    }
                    
                    totalElement.innerText = total.toFixed(2);
                }
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
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    
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
