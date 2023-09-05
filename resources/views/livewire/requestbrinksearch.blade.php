{{-- <div class="row ">
    <div class="col">
        <input type="hidden" class="form-control" placeholder="Search" wire:model="searchTerm" />
    </div>
</div> --}}

<div class="table-responsive">
    <table class="table table-bordered">
        
        <thead id="miTablaPersonalizada">
            
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
            
            <th>Billetes</th>
            <th>Rollos</th>
            <th>Total</th>
            <th>Observaciones</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($brinksend as $data)
                <tr>
                    <td>{{ $data->fecha }}</td>
                    <td>
                        $1:{{ $data->billete_1 }} <br>
                        $5:{{ $data->billete_5 }} <br>
                        $10:{{ $data->billete_10 }} <br>
                        $20:{{ $data->billete_20 }} 
                    </td>
                    <td>
                        $0.01:{{ $data->rollos_01 }} <br>
                        $0.05:{{ $data->rollos_05 }} <br>
                        $0.10:{{ $data->rollos_10 }} <br>
                        $0.25:{{ $data->rollos_25 }} <br>
                        $0.50:{{ $data->rollos_50 }} 
                    </td>
                    <td>${{ $data->total }}   </td>
                    <td>{{ $data->observaciones }}   </td>
                    <td>
                        <center>
                            {{--<form name="brinkSend_destroy" id="brinkSend_destroy" method="POST" action="{{ route('BrinkSend.brinkdestroy') }}">
                                @csrf
                                @method('DELETE')
                                <input class=" form-control" type="hidden" name="id"id="id" value="{{$data->id}}">
                                <button type="submit" class="btn btn-outline-danger w-100" onclick="showConfirmationPopup(event)"  data-borrar="{{$data->id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"></path>
                                    </svg>
                                </button>
                            </form>--}}
                            <form name="brinkSend_edit" id="brinkSend_edit" method="POST" action="{{ route('requestBrink.edit') }}">
                                @csrf
                                @method('GET')
                                <input class=" form-control" type="hidden" name="id"id="id" value="{{$data->id}}">
                                <button type="submit" class="btn btn-outline-primary w-100" onclick="showConfirmationPopup(event)"  data-borrar="{{$data->id}}">
                                    Editar
                                </button>
                            </form>
                            <button class="btn btn-primary" onclick="toggleImage({{ $data->id }})">Mostrar/Ocultar Imagen</button>
                        </center>
                        <script>
                            function showConfirmationPopup(event) {
                                event.preventDefault(); // Evita que el formulario se envíe por defecto
                                console.log("default")
                                // Muestra el popup de confirmación (puedes usar librerías como Bootstrap o implementar tu propio popup)
                                // Aquí hay un ejemplo de cómo mostrar un popup simple utilizando JavaScript nativo:
                                var confirmed = confirm("¿Estás seguro de que deseas Editar el registro?");
                                
                                if (confirmed) {
                                    // Si el usuario confirma, envía el formulario
                                    document.getElementById("brinkSend_edit").submit();
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
                    <td colspan="6">
                        <img src="data:image/jpeg;base64,{{$data->foto}}" alt="Imagen" id="imagen_{{ $data->id }}" style="width:50%; display: none;">
                    </td>
                </tr>
                
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
