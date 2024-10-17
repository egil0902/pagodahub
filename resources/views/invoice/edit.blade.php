@extends('layouts.app')
@section('title', 'Page Title')


@if (session('mensaje'))
    <div class="alert alert-success">{{ session('mensaje') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
@section('content')
<div class="p-2 m-0 border-0 bd-example">
    <div class="d-flex">
        <!-- Formulario de búsqueda por proveedor -->
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h4>Facturas</h4>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('invoice.index') }}" class="btn btn-primary font-weight-bold">Listado</a>
                            </div>
                        </div>
                <div class="card-body">
                    <!-- Formulario para envio-->
                    @foreach($orgs as $org)
                        @if($org->Name=="Mañanitas")
                            Presupuesto de banco para Mañanitas: Efectivo {{$pbankME}} loteria {{$pbankML}} cheque {{$pbankMC}}
                            <br>
                        @elseif($org->Name=="La Doña")
                            Presupuesto de banco para La Doña: Efectivo {{$pbankDE}} loteria {{$pbankDL}} cheque {{$pbankDC}}
                            <br>
                        @endif
                    @endforeach
                    
                    <form name="provider" id="provider" method="post" action="{{ route('invoice.update') }}" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{$invoice->id}}">
                        @csrf
                        @method('POST')
                        <div class="col-md-6 mb-3">
                            <p for="cars" class="card-text">Sucursal</p>
                            <select class="form-control" name="AD_Org_ID" id="AD_Org_ID">
                                @if (isset($orgs))
                                    @if ($orgs)
                                        @foreach ($orgs as $org)
                                            @if($org->id!=0)
                                                <option value="{{ $org->Name }}" {{ $org->Name == $invoice->sucursal ? 'selected' : '' }}>{{ $org->Name }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fecha_ingreso">Fecha de Ingreso</label>
                            <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" placeholder="" value="{{$invoice->fecha_ingreso}}" required>
                            <div class="text-danger" style="display:none" id="DFechaIngreso">
                                Campo obligatorio.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exampleDataList" class="form-label">Chequeador</label>
                            <input class="form-control product" list="chequeador" id="field_chequeador" name="check"
                                placeholder="Escribe para buscar..." value="{{$invoice->chequeador}}" required>
                            <div class="text-danger" style="display:none" id="DChequeador">
                                Campo obligatorio.
                            </div>
                            <datalist id="chequeador">
                                @foreach ($checkers as $check)
                                    <option value="{{ $check->name }}"></option>
                                @endforeach
                            </datalist>
                        </div>
                        <div class="col-md-6 mb-3">

                            <label for="responsable_ingreso">Responsable</label>
                            <input class="form-control product" list="responsable_ingreso" id="field_responsable_ingreso" name="responsable_ingreso"
                                placeholder="Escribe para buscar..." value="{{$invoice->responsable_ingreso}}" required>
                            <div class="text-danger" style="display:none" id="DResponsableIngreso">
                                Campo obligatorio.
                            </div>
                            <datalist id="responsable_ingreso">
                                @foreach ($responsables as $check)
                                    <option value="{{ $check->name }}"></option>
                                @endforeach
                            </datalist>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="proveedor">Proveedor</label>
                            <input class="form-control proveedor" list="chequeador" id="field_proveedor" name="proveedor"
                                placeholder="Escribe para buscar..." value="{{$invoice->proveedor}}" required>
                            <div class="text-danger" style="display:none" id="DProveedor">
                                Campo obligatorio.
                            </div>
                            <datalist id="proveedor">
                                @foreach ($providers as $proveedor)
                                    <option value="{{ $proveedor->name }}"></option>
                                @endforeach
                            </datalist>
                        </div>
            <!-- Cambio por eduardo gil para agregar el monto total y que calcule lo demas segun eso --> 
            <div class="col-md-6 mb-3">
                            <label class="h3" for="total_factura">Total Factura</label>
                            <input type="number" class="form-control h3" id="total_factura" name="total_factura" step="0.01" value="{{$invoice->total_factura}}" required>
                            <div class="text-danger" style="display:none" id="DTotalFactura">
                                Campo obligatorio.
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="monto_total">Monto Exento</label>
                            <input type="number" class="form-control" id="monto_total" name="monto_total" step="0.01" value="{{$invoice->monto_total}}" required>
                        </div>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                // Función para calcular el ITBMS y actualizar los campos
                                function calcularITBMS(monto, porcentaje, campoResultado) {
                                    const montoITBMS = monto * porcentaje;
                                    $(campoResultado).val(montoITBMS.toFixed(2));
                                }
                 // Función para calcular la base imponible, el exento segun el total de la factura y el monto de itbms
                                function fillITBMSBase(montoitbms, porcentaje, campoResultado) {
                                    const baseimponible = montoitbms / porcentaje;
                                    $(campoResultado).val(baseimponible.toFixed(2));
                                }
                                function fillExempt() {
                    const monto7 = parseFloat($('#monto_7').val()) || 0;
                                    const montoimpuesto7 = parseFloat($('#monto_impuesto_7').val()) || 0;
                                const monto10 = parseFloat($('#monto_10').val()) || 0;  
                                    const montoimpuesto10 = parseFloat($('#monto_impuesto_10').val()) || 0;
                                const monto15 = parseFloat($('#monto_15').val()) || 0;
                                    const montoimpuesto15 = parseFloat($('#monto_impuesto_15').val()) || 0;

                    const total_factura = parseFloat($('#total_factura').val()) || 0;
                    const exempt = total_factura - monto7-montoimpuesto7 - monto10-montoimpuesto10 - monto15-montoimpuesto15;
                    $('#monto_total').val(exempt.toFixed(2));

                }

                                // Escucha los cambios en los campos de monto y realiza los cálculos
                                $('#monto_7').on('input', function() {
                                    const monto = parseFloat($(this).val());
                                    const porcentaje = 0.07;
                                    calcularITBMS(monto, porcentaje, '#monto_impuesto_7');
                                });

                                $('#monto_10').on('input', function() {
                                    const monto = parseFloat($(this).val());
                                    const porcentaje = 0.10;
                                    calcularITBMS(monto, porcentaje, '#monto_impuesto_10');
                                });

                                $('#monto_15').on('input', function() {
                                    const monto = parseFloat($(this).val());
                                    const porcentaje = 0.15;
                                    calcularITBMS(monto, porcentaje, '#monto_impuesto_15');
                                });
                $('#monto_impuesto_7').on('input', function() {
                                    const monto = parseFloat($(this).val());
                                    const porcentaje = 0.07;
                                    fillITBMSBase(monto, porcentaje, '#monto_7');
                                    fillExempt();
                                });
                                $('#monto_impuesto_10').on('input', function() {
                                    const monto = parseFloat($(this).val());
                                    const porcentaje = 0.10;
                                    fillITBMSBase(monto, porcentaje, '#monto_10');
                                    fillExempt();
                                });
                                $('#monto_impuesto_15').on('input', function() {
                                    const monto = parseFloat($(this).val());
                                    const porcentaje = 0.15;
                                    fillITBMSBase(monto, porcentaje, '#monto_15');
                                    fillExempt();
                                });

                            });
                        </script>

                        <div class="col-md-6 mb-3">
                            <label for="monto_7">Monto al que aplica ITBMS del 7%</label>
                            <input type="number" class="form-control" id="monto_7" name="monto_7" step="0.01" value="{{$invoice->monto_7}}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="monto_impuesto_7">ITBMS7%</label>
                            <input type="number" class="form-control" id="monto_impuesto_7" name="monto_impuesto_7" value="{{$invoice->monto_impuesto_7}}" step="0.01">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="monto_10">Monto al que aplica ITBMS del 10%</label>
                            <input type="number" class="form-control" id="monto_10" name="monto_10" step="0.01" value="{{$invoice->monto_10}}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="monto_impuesto_10">ITBMS10%</label>
                            <input type="number" class="form-control" id="monto_impuesto_10" name="monto_impuesto_10" value="{{$invoice->monto_impuesto_10}}" step="0.01">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="monto_15">Monto al que aplica ITBMS del 15%</label>
                            <input type="number" class="form-control" id="monto_15" name="monto_15" step="0.01" value="{{$invoice->monto_15}}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="monto_impuesto_15">ITBMS15%</label>
                            <input type="number" class="form-control" id="monto_impuesto_15" name="monto_impuesto_15" value="{{$invoice->monto_impuesto_15}}" step="0.01">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="devolucion">Devolucion</label>
                            <input type="number" class="form-control" id="devolucion" name="devolucion" step="0.01" value="{{$invoice->devolucion}}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fecha_pago">Fecha de Pago</label>
                            <input type="date" class="form-control" id="fecha_pago" name="fecha_pago" placeholder="" value="{{$invoice->fecha_pago}}" required>
                        </div>
                        <div class="col-md-6 mb-1 d-flex justify-content-start">
                            <button type="button" class="btn btn-primary btn-block my-1 btn-agregar-forma-pago" >Agregar forma de pago</button>
                        </div>
                        <div class="col-md-6 mb-3" id="container-forma-pago-fija">
                            <div id="forma-pago-fija" class="forma-pago-fija" style="background-color: #0c0c0c14; padding: 10px; margin: 5px 0;">
                                <div class="col-md-12 mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label for="forma_pago">Forma de Pago</label>
                                        <button type="button" class="btn btn-danger btn-block my-1 btn-eliminar-forma-pago d-none" style="width: 100px !important;">Eliminar</button>
                                    </div>
                                    <select class="form-control forma-pago" id="forma_pago" name="forma_pago[]" unique-id="fija" required>
                                        <option value="" disabled selected>Selecciona una forma de pago</option>
                                        <option value="credito">Crédito</option>
                                        <option value="banco">Banco</option>
                                        <option value="caja">Caja</option>
                                        <option value="tarjeta_credito">Tarjeta de Crédito</option>
                                    </select>
                                </div>

                                <!-- Fields for displaying based on forma_pago selection -->
                                <div class="col-md-12 mb-3 credito-fields fields" id="creditoFields" class="form-group" style="display: none;">
                                    <label for="credito_options">Opciones para Crédito</label>
                                    <select class="form-control" id="credito_options" name="credito_options">
                                        <option value="cheque">Cheque</option>
                                        <option value="ach">ACH</option>
                                    </select>
                                    <label for="banco_credito">Banco</label>
                                    <input type="text" class="form-control text" id="banco_credito" name="banco_credito">
                                    <label for="num_comprobante_credito">Número de Comprobante</label>
                                    <input type="text" class="form-control text" id="num_comprobante_credito" name="num_comprobante_credito">
                                    <div id="valorCreditoDesc" class="form-group">
                                        <label for="valor_credito">Valor en Crédito</label>
                                        <input type="number" class="form-control number monto-forma-pago" id="valor_credito" value=0  step="0.01" name="valor_credito">
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3 banco-fields fields" id="bancoFields" class="form-group" style="display: none;">
                                    <label>Opciones para Banco</label>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="banco_efectivo" desc-fields="efectivo" name="banco_options[]" value="efectivo" unique-id="fija">
                                        <label class="form-check-label" for="banco_efectivo">Efectivo</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="banco_loteria" desc-fields="loteria" name="banco_options[]" value="loteria" unique-id="fija">
                                        <label class="form-check-label" for="banco_loteria">Lotería</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="banco_cheque" desc-fields="cheque" name="banco_options[]" value="cheque" unique-id="fija">
                                        <label class="form-check-label" for="banco_cheque">Cheque</label>
                                    </div>
                                    <div id="bancoDesc" class="form-group cheque-desc-fields desc-fields" style="display: none;">
                                        <label for="banco_banco">Banco</label>
                                        <input type="text" class="form-control text" id="banco_banco" name="banco_banco">
                                        <label for="num_comprobante">Número de Cheque</label>
                                        <input type="text" class="form-control text" id="num_comprobante"  name="num_comprobante">
                                        <label for="cheque_banco">Valor cheque</label>
                                        <input type="number" class="form-control number monto-forma-pago" id="cheque_banco" value=0 step="0.01" name="cheque_banco">
                                    </div>
                                    <div id="efectivoDesc" class="form-group efectivo-desc-fields desc-fields" style="display: none;">
                                        <label for="presupuest_banco">Valor en efectivo</label>
                                        <input type="number" class="form-control number monto-forma-pago" id="presupuest_banco" value=0  step="0.01" name="presupuest_banco">
                                    </div>
                                    <div id="loteriaDesc" class="form-group loteria-desc-fields desc-fields" style="display: none;">
                                        <label for="loteria_banco">Valor loteria</label>
                                        <input type="number" class="form-control number monto-forma-pago" id="loteria_banco" value=0  step="0.01" name="loteria_banco">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 tarjeta-fields fields" id="tarjetaFields" class="form-group" style="display: none;">
                                    <label for="tarjeta">Tarjetas</label>
                                    <select class="form-control" id="tarjeta" name="tarjeta">
                                        @foreach($tarjetas as $tarjeta)
                                            <option value="{{ $tarjeta->numero }}">{{ $tarjeta->numero }}</option>
                                        @endforeach
                                    </select>
                                    <div id="valorTarjetaDesc" class="form-group">
                                        <label for="valor_tarjeta">Valor en Tarjeta</label>
                                        <input type="number" class="form-control number monto-forma-pago" id="valor_tarjeta" value=0  step="0.01" name="valor_tarjeta">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 caja-fields fields" id="cajaFields" class="form-group" style="display: none;">
                                    <div id="valorCajaDesc" class="form-group">
                                        <label for="valor_caja">Valor en Caja</label>
                                        <input type="number" class="form-control number monto-forma-pago" id="valor_caja" value=0  step="0.01" name="valor_caja">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3" id="container-forma-pago-multiple">  
                        </div>
                        <div class="col-md">
                            <label for="formFileMultiple" class="form-label">Adjuntar foto bolsa</label>
                            <input class=" subirimagen form-control" type="file" id="filePicker"
                                placeholder="foto" name="FileCedula" value="0" onchange="imgsize()"
                                onkeyup="imgsize()" accept=".png" required>
                            <textarea style="display:none;" name="foto" id="base64textarea" placeholder="Base64 will appear here"
                                cols="50" rows="15"></textarea>
                            <br><center><img id="img1" class="rounded" src="" border="1"
                                    style="width: 50%;">
                            </center>
                            <label for="pdf">Selecciona un archivo PDF:</label><br>
                            <input type="file" name="pdf" id="pdf" accept=".pdf">
                            
                            <script>                                            
                                var handleFileSelect = function(evt) {
                                    var files = evt.target.files;
                                    var file = files[0];
                                    if (files && file) {
                                        var reader = new FileReader();
                                        reader.onload = function(readerEvt) {
                                            var binaryString = readerEvt.target.result;
                                            document.getElementById("base64textarea").value = btoa(binaryString);
                                            document.getElementById("img1").src = "data:image/png;base64," + btoa(binaryString);

                                        };
                                        reader.readAsBinaryString(file);
                                    }
                                };
                                if (window.File && window.FileReader && window.FileList && window.Blob) {
                                    document.getElementById('filePicker').addEventListener('change', handleFileSelect, false);

                                } else {
                                    alert('The File APIs are not fully supported in this browser.');
                                }
                            </script>
                            <script>
                                function showHideSections() {
                                    var efectivoChecked = document.getElementById('banco_efectivo').checked;
                                    var loteriaChecked = document.getElementById('banco_loteria').checked;
                                    var chequeChecked = document.getElementById('banco_cheque').checked;

                                    var efectivoDesc = document.getElementById('efectivoDesc');
                                    var loteriaDesc = document.getElementById('loteriaDesc');
                                    var bancoDesc = document.getElementById('bancoDesc');

                                    if (efectivoChecked) {
                                        efectivoDesc.style.display = 'block';
                                    } else {
                                        efectivoDesc.style.display = 'none';
                                    }

                                    if (loteriaChecked) {
                                        loteriaDesc.style.display = 'block';
                                    } else {
                                        loteriaDesc.style.display = 'none';
                                    }

                                    if (chequeChecked) {
                                        bancoDesc.style.display = 'block';
                                    } else {
                                        bancoDesc.style.display = 'none';
                                    }
                                }

                                // Agrega un evento "change" a los checkboxes para llamar a showHideSections cuando cambien.
                                /*var checkboxes = document.querySelectorAll('.form-check-input');
                                checkboxes.forEach(function(checkbox) {
                                    checkbox.addEventListener('change', showHideSections);
                                });*/

                                // Llama a showHideSections inicialmente para que las secciones se muestren u oculten según el estado inicial de los checkboxes.
                                //showHideSections();
                            </script>
                            

                        </div>
                        <div class="col-md">
                        <h4>Observaciones:</h4>
                                                <textarea style="width:100%;" class="long-textarea" id="observaciones" name="observaciones" >{{$invoice->observaciones}}</textarea>
                        </div>
                        <br>
                        <button class="btn btn-primary" type="button" onclick="calcularMontos()">Actualizar</button>

                    </form>
                    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirmación de Pago</h5>                                    
                                </div>
                                <div class="modal-body">
                                    Se va a pagar lo siguiente: <span id="totalAmount"></span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="confirmModal" onclick="closeModal()">Cancelar</button>
                                    <button type="button" class="btn btn-primary" onclick="enviarFormulario()">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="notificacionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Notificación</h5>                                    
                                </div>
                                <div class="modal-body" id="texto-notificacion">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="notificacionModal" onclick="closeModal()">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>

                        function closeModal() {
                            $('.modal').modal('hide');
                        }

                        function calcularMontos() {

                            if(!validateForm()){
                                $('#texto-notificacion').text('Faltan campos por ingresar');
                                $('#notificacionModal').modal('show');
                                return;
                            }

                            const fieldFormaPago = $('.monto-forma-pago');
                            var montoFormaPago = 0;

                            // Obtener los valores de los montos e impuestos
                            var total_factura = parseFloat($('#total_factura').val()) || 0;
                            var monto = parseFloat($('#monto_total').val()) || 0;
                            var monto7 = parseFloat($('#monto_7').val()) || 0;
                            var monto10 = parseFloat($('#monto_10').val()) || 0;
                            var monto15 = parseFloat($('#monto_15').val()) || 0;
                            var impuesto7 = parseFloat($('#monto_impuesto_7').val()) || 0;
                            var impuesto10 = parseFloat($('#monto_impuesto_10').val()) || 0;
                            var impuesto15 = parseFloat($('#monto_impuesto_15').val()) || 0;
                            var devolucion = parseFloat($('#devolucion').val()) || 0;

                            // Calcular el total
                            var total=total_factura;
                            if(total_factura==0)
                                total = monto + monto7 + monto10 + monto15 + impuesto7 + impuesto10 + impuesto15 - devolucion;

                            fieldFormaPago.each(function(){
                                montoFormaPago += (parseFloat($(this).val()) || 0);
                            });

                            if( montoFormaPago != total_factura ){
                                $('#texto-notificacion').text('El monto de la factura no corresponde a los montos ingresados en las formas de pago');
                                $('#notificacionModal').modal('show');
                                return;
                            }

                            // Mostrar el mensaje de alerta
                            // Mostrar el total en el modal
                            $('#totalAmount').text('$' + total.toFixed(2));

                            // Abrir el modal
                            $('#confirmModal').modal('show');
                        }
                        function enviarFormulario() {
                            // Aquí puedes realizar cualquier otra validación antes de enviar el formulario
                            $('.forma-pago option').prop('disabled',false);
                            // Envía el formulario
                            document.getElementById('provider').submit();
                        }
                    </script>

                    <script>
                        // JavaScript to show/hide fields based on forma_pago selection
                        /*const formaPagoSelect = document.getElementById('forma_pago');
                        const creditoFields = document.getElementById('creditoFields');
                        const bancoFields = document.getElementById('bancoFields');
                        const cajaFields = document.getElementById('cajaFields');
                        
                        const tarjetaFields = document.getElementById('tarjetaFields');*/
                        const bancoDesc = document.getElementById('bancoDesc');
                        const efectivoDesc= document.getElementById('efectivoDesc');

                        /*formaPagoSelect.addEventListener('change', (event) => {
                            creditoFields.style.display = event.target.value === 'credito' ? 'block' : 'none';
                            bancoFields.style.display = event.target.value === 'banco' ? 'block' : 'none';
                            tarjetaFields.style.display = event.target.value === 'tarjeta_credito' ? 'block' : 'none';
                            cajaFields.style.display = event.target.value === 'caja' ? 'block' : 'none';
                        });*/

                        function onSubmit(token) {
                            if(validateForm()){
                                document.getElementById("provider").submit();
                            }
                        }

                        function validateForm() {

                            // Obtener los valores de los campos del formulario 
                            try {

                                var failForm = false;
                                var fecha_pago = document.getElementById('fecha_pago').value; 
                                var fecha_ingreso = document.getElementById('fecha_ingreso').value; 
                                var responsable_ingreso = document.getElementById('field_responsable_ingreso').value;
                                var chequeador = document.getElementById('field_chequeador').value;   
                                var proveedor = document.getElementById('field_proveedor').value;  
                                var total_factura = document.getElementById('total_factura').value;   

                                if ((total_factura === "" || total_factura === null)) {
                                    document.getElementById('DTotalFactura').style.display = "block";
                                    failForm = true;
                                } else {
                                    document.getElementById('DTotalFactura').style.display = "none";
                                }

                                if ((fecha_ingreso === "" || fecha_ingreso === null)) {
                                    document.getElementById('DFechaIngreso').style.display = "block";
                                    failForm = true;
                                } else {
                                    document.getElementById('DFechaIngreso').style.display = "none";
                                }                                     
                               
                                if ((fecha_pago === "" || fecha_pago === null)) {
                                    document.getElementById('DFechaPago').style.display = "block";
                                    failForm = true;
                                } else {
                                    document.getElementById('DFechaPago').style.display = "none";
                                }

                                if ((responsable_ingreso === "" || responsable_ingreso === null)) {
                                    document.getElementById('DResponsableIngreso').style.display = "block";
                                    failForm = true;
                                } else {
                                    document.getElementById('DResponsableIngreso').style.display = "none";
                                }

                                if ((chequeador === "" || chequeador === null)) {
                                    document.getElementById('DChequeador').style.display = "block";
                                    failForm = true;
                                } else {
                                    document.getElementById('DChequeador').style.display = "none";
                                }

                                /*if ((proveedor === "" || proveedor === null)) {
                                    document.getElementById('DProveedor').style.display = "block";
                                    failForm = true;
                                } else {
                                    document.getElementById('DProveedor').style.display = "none";
                                }*/
                              
                                if (failForm) {
                                    return false; // No se envía el formulario
                                } else {
                                    return true; // Se envía el formulario
                                }

                            } catch (error) {
                                console.error(error);
                                return false;
                            }

                        }

                        $( document ).ready(function() {

                            $(".forma-pago").on("change", function(e) {
     
                                const optionsSelected = $('.forma-pago option:selected');
                                const valueSelectedFormaPago = this.value;
                                const unique_id = $(this).attr('unique-id');

                                $("#forma-pago-" + unique_id).find(".fields").css("display", "none");
                                $('.forma-pago option').prop('disabled',false);

                                optionsSelected.each(function(){
                                    $('.forma-pago option[value="' + $(this).val() + '"]').prop('disabled',true);
                                });

                                switch(valueSelectedFormaPago) {
                                    case 'credito':

                                        $("#forma-pago-" + unique_id).find(".credito-fields").css("display", "block");

                                    break;
                                    case 'banco':

                                        $("#forma-pago-" + unique_id).find(".banco-fields").css("display", "block");

                                    break;
                                    case 'tarjeta_credito':

                                        $("#forma-pago-" + unique_id).find(".tarjeta-fields").css("display", "block");

                                    break;
                                    case 'caja':

                                        $("#forma-pago-" + unique_id).find(".caja-fields").css("display", "block");

                                    break;
                                    default:
                                        // code block
                                }

                            });

                            $(".btn-eliminar-forma-pago").on("click", function() {

                                $("#forma-pago-" + $(this).attr('unique-id')).remove();

                                const optionsSelected = $('.forma-pago option:selected');
                                $('.forma-pago option').prop('disabled',false);
                                
                                optionsSelected.each(function(){
                                    $('.forma-pago option[value="' + $(this).val() + '"]').prop('disabled',true);
                                });

                            });

                            $(".btn-agregar-forma-pago").on("click", function() {

                                const forma_pago = $("#forma-pago-fija").clone(true).appendTo("#container-forma-pago-multiple");
                                const unique_id = Math.floor(Math.random() * 26) + Date.now();

                                forma_pago.find(".btn-eliminar-forma-pago").removeClass("d-none").attr("unique-id",unique_id);
                                forma_pago.attr("id","forma-pago-" + unique_id);
                                forma_pago.addClass("forma-pago-multiple");
                                forma_pago.find(".forma-pago").attr("unique-id", unique_id).val("").change();
                                forma_pago.find(".form-check-input").attr("unique-id", unique_id);
                                forma_pago.find(".form-check-input").prop("checked",false);
                                forma_pago.find(".fields").css("display", "none");
                                forma_pago.find(".desc-fields").css("display", "none");
                                forma_pago.find(".text").val("");
                                forma_pago.find(".number").val(0);
                                forma_pago.find("select option:eq(0)").attr("selected","selected");

                            });

                            $(".form-check-input").on("change", function(e) {

                                const checkboxChecked = $(this).attr('id');
                                const unique_id = $(this).attr('unique-id');
                                const descFields = $(this).attr('desc-fields');

                                $("#forma-pago-" + unique_id).find("." + descFields + "-desc-fields").css("display", "none");

                                if ($(this).is(':checked')) 
                                    $("#forma-pago-" + unique_id).find("." + descFields + "-desc-fields").css("display", "block");

                            });

                        });
                        
                    </script>
                    <hr class="mb-4">                    
                </div>
            </div>
        
    </div>
    </div>
    </br>
    
</div>

    <style>
        .campo input {
            margin-bottom: 10px;
        }
        
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