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
            <th>Valor abonado</th>
            <th>Total</th>
            <th>Valor Deuda</th>
            <th>
                <select class="form-select" wire:model="pagada">
                    <option value="">Pagada</option>
                    <option value="true">Sí</option>
                    <option value="false">No</option>
                </select>
            </th>
            <th>Fecha cancelacion</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($facturas as $factura)
        <tr>
            <td style="color: {{$factura->medio_de_pago == 1 ? 'green' : ($factura->medio_de_pago == 0 && $factura->pagada ? 'green' : ($factura->pagada == false && $factura->monto_abonado > 0 ? 'blue' : 'red'))}}">{{$factura->id_compra}}</td>
            <td style="color: {{$factura->medio_de_pago == 1 ? 'green' : ($factura->medio_de_pago == 0 && $factura->pagada ? 'green' : ($factura->pagada == false && $factura->monto_abonado > 0 ? 'blue' : 'red'))}}">{{$factura->fecha}}</td>
            <td style="color: {{$factura->medio_de_pago == 1 ? 'green' : ($factura->medio_de_pago == 0 && $factura->pagada ? 'green' : ($factura->pagada == false && $factura->monto_abonado > 0 ? 'blue' : 'red'))}}">{{$factura->proveedor}}</td>
            <td style="color: {{$factura->medio_de_pago == 1 ? 'green' : ($factura->medio_de_pago == 0 && $factura->pagada ? 'green' : ($factura->pagada == false && $factura->monto_abonado > 0 ? 'blue' : 'red'))}}">{{$factura->medio_de_pago?"Contado":"Crédito"}}</td>
            <td style="color: {{$factura->medio_de_pago == 1 ? 'green' : ($factura->medio_de_pago == 0 && $factura->pagada ? 'green' : ($factura->pagada == false && $factura->monto_abonado > 0 ? 'blue' : 'red'))}}">{{$factura->pagada?$factura->Total_compra:$factura->monto_abonado}}</td>
            <td style="color: {{$factura->medio_de_pago == 1 ? 'green' : ($factura->medio_de_pago == 0 && $factura->pagada ? 'green' : ($factura->pagada == false && $factura->monto_abonado > 0 ? 'blue' : 'red'))}}">{{$factura->total}}</td>
            <td style="color: {{$factura->medio_de_pago == 1 ? 'green' : ($factura->medio_de_pago == 0 && $factura->pagada ? 'green' : ($factura->pagada == false && $factura->monto_abonado > 0 ? 'blue' : 'red'))}}">{{($factura->medio_de_pago&&$factura->pagada)?0:($factura->Total_compra-$factura->monto_abonado)}}</td>
            <td style="color: {{$factura->medio_de_pago == 1 ? 'green' : ($factura->medio_de_pago == 0 && $factura->pagada ? 'green' : ($factura->pagada == false && $factura->monto_abonado > 0 ? 'blue' : 'red'))}}">{{$factura->pagada?"Si":"No"}}</td>
            <td style="color: {{$factura->medio_de_pago == 1 ? 'green' : ($factura->medio_de_pago == 0 && $factura->pagada ? 'green' : ($factura->pagada == false && $factura->monto_abonado > 0 ? 'blue' : 'red'))}}">{{$factura->fecha_pago}}</td>
            <!--<td>
                <form action="{{ route('factures.borrar', $factura->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"></path>
                        </svg>
                    </button>
                </form>
            </td>
            -->
            <td>
                <form action="{{route('factures.show', $factura->id) }}" method="post">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-outline-primary" data-bs-toggle="modal">
                        Ver
                    </button>
                </form>
                
            </td>

        </tr>
        @endforeach
    </tbody>
</table>