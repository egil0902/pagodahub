{{-- <div class="row ">
    <div class="col">
        <input type="hidden" class="form-control" placeholder="Search" wire:model="searchTerm" />
    </div>
</div> --}}

<div class="table-responsive">
    <table class="table table-bordered">
        
        <thead id="miTablaPersonalizada">
            <th>
                <div class="input-group" style="width:70%">
                    <span class="input-group-text" id="basic-addon3"><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg></span>
                    <input type="text" class="form-control" placeholder="nombre sucursal" wire:model="sucursal"
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
                    <input type="date" class="form-control" placeholder="fecha_dia" wire:model="fecha_dia"
                        aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </th>
            <th>Fecha de <br>
                inicio</th>
            <th>Fecha de <br>
            cierre</th>
            
            <th>Brinks</th>
            <th>sencillo</th>
            <th>Dinero de <br>gerencia</th>            
            <th>Pagos <br> factura</th>
            <th>Inicio de <br>banco</th>
            <th>Total de <br>caja</th>

            <th>Total</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($brinksend as $data)
                <tr>
                    <td>{{ $data->sucursal }}</td>
                    <td>{{ date('d-m-Y', strtotime($data->fecha_dia)) }} </td>
                    <td>{{ $data->fecha_inicio }}</td>
                    <td>{{ $data->fecha_cierre }}</td>
                    <td>
                        {{ $data->brinks }} 
                    </td>
                    <td>
                        {{ $data->sencillo }} 
                    </td>
                    <td>{{ $data->dinero_gerencia }}   </td>
                    <td>{{ $data->facturas }}   </td>
                    <td>{{ $data->banco }}   </td>                    
                    <td>{{ $data->total_caja }}   </td>
                    <td>{{ $data->total }}   </td>

                    <td>
                        <center>
                            @if($data->pdf_data!="")
                                <button class="btn btn-primary" onclick="togglePdf({{ $data->id }})">Mostrar/Ocultar PDF</button> 
                            @endif
                            <button class="btn btn-primary" onclick="toggleImage({{ $data->id }})">Mostrar/Ocultar Imagen</button>
                        </center>
                        <script>
                            function showConfirmationPopup(event) {
                                event.preventDefault(); // Evita que el formulario se envíe por defecto
                                console.log("default")
                                // Muestra el popup de confirmación (puedes usar librerías como Bootstrap o implementar tu propio popup)
                                // Aquí hay un ejemplo de cómo mostrar un popup simple utilizando JavaScript nativo:
                                var confirmed = confirm("¿Estás seguro de que deseas eliminar el registro?");
                                
                                if (confirmed) {
                                    // Si el usuario confirma, envía el formulario
                                    document.getElementById("brinkSend_destroy").submit();
                                }
                            }
                            function toggleImage(id) {
                                var image = document.getElementById("imagen_" + id);
                                if (image.style.display === "none") {
                                    image.style.display = "block"; // Muestra la imagen
                                } else {
                                    image.style.display = "none"; // Oculta la imagen
                                }
                            }
                            function togglePdf(id) {
                                var image = document.getElementById("pdf_" + id);
                                if (image.style.display === "none") {
                                    image.style.display = "block"; // Muestra la pdf
                                } else {
                                    image.style.display = "none"; // Oculta la pdf
                                }
                            }
                        </script>
                    </td>
                </tr>
                <tr>
                    
                    <!-- Imagen que se mostrará/ocultará -->
                    <td colspan="12">
                        {{$data->observaciones}}
                    </td>
                </tr>
                <tr>
                    
                    <!-- Imagen que se mostrará/ocultará -->
                    <td colspan="12">
                        <img src="data:image/jpeg;base64,{{$data->foto}}" alt="Imagen" id="imagen_{{ $data->id }}" style="width:50%; display: none;">
                    </td>
                </tr>
                @if($data->pdf_data!="")
                            
                <tr>
                    
                    <td colspan="12">
                        <!-- Vista para mostrar el PDF -->
                        <embed src="data:application/pdf;base64,{{ $data->pdf_data }}" style="width:50%; display: none;"id="pdf_{{ $data->id }}" height="600" type="application/pdf">

                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
<style>
    #miTablaPersonalizada th {
        width: 100px;
        /* overflow: auto; */
        border: 1px solid;
    }

    table {
        table-layout: fixed;
    }
</style>
