{{-- <div class="row ">
    <div class="col">
        <input type="hidden" class="form-control" placeholder="Search" wire:model="searchTerm" />
    </div>
</div> --}}

<div class="table-responsive">
    <table class="table table-bordered">
        
        <thead id="miTablaPersonalizada">
            <th>
            fecha ingreso
                <div class="input-group" style="width:100%">
                
                    <span class="input-group-text" id="basic-addon2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-calendar3" viewBox="0 0 16 16">
                            <path
                                d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                            <path
                                d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        </svg>
                    </span>
                    <input type="date" class="form-control" placeholder="fecha ingreso" wire:model="fecha_ingreso"
                        aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </th>
            <th>
                <div class="input-group" style="width:100%">
                    <span class="input-group-text" id="basic-addon3"><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg></span>
                    <input type="text" class="form-control" placeholder="responsable" wire:model="responsable_ingreso"
                        aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </th>            
            <th>Monto<br> exento</th>
            <th>Monto 7%</th>
            <th>ITMS 7%</th>
            <th>Monto 10%</th>
            <th>ITMS 10%</th>
            <th>Monto 15%</th>
            <th>ITMS 15%</th>
            
            <th>Total <br>impuestos</th>
            <th>Total</th>
            <th>fecha pago
                <div class="input-group" style="width:100%">
                
                    <span class="input-group-text" id="basic-addon2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-calendar3" viewBox="0 0 16 16">
                            <path
                                d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                            <path
                                d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        </svg>
                    </span>
                    <input type="date" class="form-control" placeholder="fecha pago" wire:model="fecha_pago"
                        aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </th>
            <th>Forma <br>de pago</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($brinksend as $data)
                <tr>                    
                    <td>{{ date('d-m-Y', strtotime($data->fecha_ingreso)) }}</td>
                    <td>{{ $data->responsable_ingreso }}</td>
                    <td>
                        {{ $data->monto_total}} 
                    </td>
                    <td>
                        {{ $data->monto_7}} 
                    </td>
                    <td>
                        {{ $data->monto_impuesto_7}} 
                    </td>
                    <td>
                        {{ $data->monto_10}} 
                    </td>
                    <td>
                        {{ $data->monto_impuesto_10}} 
                    </td>
                    <td>
                        {{ $data->monto_15}} 
                    </td>
                    <td>
                        {{ $data->monto_impuesto_15}} 
                    </td>
                    <td>
                        {{ $data->monto_impuesto }} 
                    </td>
                    <td>
                        {{ $data->monto_total+$data->monto_7+$data->monto_10+$data->monto_15+$data->monto_impuesto}}
                    </td>
                    <td>{{ date('d-m-Y', strtotime($data->fecha_pago)) }}</td>
                    <td>{{ $data->forma_pago }}
                        @if($data->forma_pago==="tarjeta_credito")
                            <br>
                            {{$data->tarjeta}}
                        @endif
                        @if($data->forma_pago==="banco efectivo")
                            <br>
                            {{$data->presupuest_banco}}
                        @endif
                           </td>
                    <td>
                        <center>                            
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
                        </script>
                    </td>
                </tr>
                <tr>
                    
                    <!-- Imagen que se mostrará/ocultará -->
                    <td colspan="14">
                        <img src="data:image/jpeg;base64,{{$data->foto}}" alt="Imagen" id="imagen_{{ $data->id }}" style="width:50%; display: none;">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <form name="provider" id="provider" method="post" action="{{route( 'invoice.getExcel' )}}">
        <div class="form-group w-auto">
            <input type="hidden" name="lista" value="{{ json_encode($brinksend) }}">
            @csrf
            <button class="w-100 btn btn-outline-secondary m-0" type="submit" id="button-addon2">Importar</button>
        </div>
    </form>
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
