<div>
<div>
        <form name="imprimirCheque" id="imprimirCheque" method="post" action="{{ route('facture-pdf') }}">

            @csrf
            <div class="form-group">
                <input type="hidden" name="facturas_ids" id="facturas_ids" value="">
                <div>
                    <label for="pagoPresupuesto">Descontar del presupuesto del día?</label>
                    <input type="checkbox" name="pagoPresupuesto" id="pagoPresupuesto" value="true" checked onchange="togglePagoPresupuesto(this)">
                </div>
                <div>
                    <label for="pagoParcial">Es un pago parcial?</label>
                    <input type="checkbox" name="pagoParcial" id="pagoParcial" value="false"  onchange="togglePagoParcial(this)">
                    <div  id="montoVal" style="display: none;">
                        <label for="montoParcial">Monto:</label>
                        <input type="number" id="montoParcial" name="montoParcial" value="0.00" style="height: 30px;">
                    </div>
                </div>
                <div id="myDiv" style="display: none;">
                    <div>
                        <label for="metodoPago">Seleccione una opción:</label>
                        <select id="metodoPago" name="metodoPago" style="height: 30px;" onchange="toggleFechaCampo(this)">
                        <option value="Cheque" selected>Cheque</option>
                        <option value="Transacciones">Transacciones bancarias</option>
                        <option value="Otro">Otro</option>
                        <option value="Dia anterior">Presupuesto anterior</option>
                        </select>
                    </div>
                    <div id="campoFecha" style="display: none;">
                        <label for="fecha">Seleccione una fecha:</label>
                        <input type="date" id="fechaPago" name="fechaPago" style="height: 30px;" max="<?= date("Y-m-d") ?>">
                    </div>
                    <div>
                        <label for="codigo">Código:</label>
                        <input type="text" id="codigo" name="codigo" value="" style="height: 30px;">
                    </div>
                    <div id="campoBanco" >
                        <label for="banco">Banco</label>
                        <input type="text" id="banco" name="banco" value="" style="height: 30px;">
                    </div>
                </div>

                <!--<div>
                    <label for="pagoValor">¿Desea pagar un monto?</label>
                    --><input type="hidden" name="pagoValor" id="pagoValor" value="true" >
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
                    document.getElementById("pagoPresupuesto").value = "true";
                    document.getElementById("imprimirCheque").addEventListener("submit", function(event) {
                    event.preventDefault();
                    
                    // Obtén los checkboxes seleccionados
                    var checkboxes = document.querySelectorAll('input[name="factura_ids[]"]:checked');

                    // Obtén los IDs de las facturas seleccionadas
                    var selectedIds = [];
                    checkboxes.forEach(function(checkbox) {
                        selectedIds.push(checkbox.value);
                    });
                    if (document.getElementById("pagoParcial").value&&selectedIds.length>1) {
                        // La validación falló, mostrar un mensaje de advertencia
                        alert("¡No puede hacer un pago parcial de mas de una factura a la vez!");
                        return; // Terminar el proceso
                    }
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
                console.log(document.getElementById('montoVal'))
                if (checkbox.checked) {
                    checkbox.value = "true";
                    document.getElementById('montoVal').style.display = "block";
                } else {
                    checkbox.value = "false";
                    document.getElementById('montoVal').style.display = "none";
                }
            }   
            function toggleFechaCampo(selectElement) {
                var campoFecha = document.getElementById("campoFecha");
                var campoBanco = document.getElementById("campoBanco");
                // Obtener el valor seleccionado del select
                var selectedOption = selectElement.options[selectElement.selectedIndex].value;
                var elementoRequerido = document.getElementById("fechaPago");

                // Si el valor seleccionado es "Dia anterior", mostrar el campo de selección de fecha, de lo contrario, ocultarlo
                if (selectedOption === "Dia anterior") {
                    campoFecha.style.display = "block";                    
                    elementoRequerido.setAttribute("required", "required"); 
                    campoBanco.style.display = "none"; 
                }else if(selectedOption === "Cheque"||selectedOption === "Transacciones"){
                    campoFecha.style.display = "none"; 
                    campoBanco.style.display = "block"; 
                }
                else{
                    campoFecha.style.display = "none"; 
                    campoBanco.style.display = "none";                    
                    elementoRequerido.removeAttribute("required");

                }
            }
            function togglePagoPresupuesto(checkbox) {
                var myDiv = document.getElementById("myDiv");
                var elementoRequerido = document.getElementById("codigo");
                if (checkbox.checked) {
                    checkbox.value = "true";
                    myDiv.style.display = "none";
                    elementoRequerido.removeAttribute("required");
                } else {
                    checkbox.value = "false";
                    myDiv.style.display = "flex";
                    elementoRequerido.setAttribute("required", "required");
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
                    <th>
                        <div class="input-group" style="width:60%">
                            <span class="input-group-text" id="basic-addon3"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></span>
                            <input type="text" class="form-control" placeholder="# factura" wire:model="id_compra"
                                aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </th>
                    <th>
                        <div class="input-group" style="width:75%">
                            <span class="input-group-text" id="basic-addon2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-calendar3" viewBox="0 0 16 16">
                                    <path
                                        d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                                    <path
                                        d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                </svg>
                            </span>
                            <input type="date" class="form-control" placeholder="fecha" wire:model="fecha"
                                aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </th>
                    <th>
                        <div class="input-group" style="width:70%">
                            <span class="input-group-text" id="basic-addon3"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></span>
                            <input type="text" class="form-control" placeholder="nombre proveedor" wire:model="proveedor"
                                aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </th>
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
                    <td>${{$factura->monto_abonado}}</td>
                    <td name="total{{$factura->id_compra}}" id="total{{$factura->id_compra}}">${{$factura->Total_compra- $factura->monto_abonado}}</td>
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
                var element = document.getElementById('total' + checkbox.value);
                var contentWithDollarSign = element.innerText;
                var contentWithoutDollarSign = contentWithDollarSign.replace('$', ''); // Elimina el signo de dólar
                var totalValue = parseFloat(contentWithoutDollarSign);
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
</div>
<style>
    tr,td{
        text-align:center;
    }
    .centered-th {
    }
</style>
