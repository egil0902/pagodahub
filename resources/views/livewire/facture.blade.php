<table>
    <thead>
        <tr>
            <th># Factura</th>
            <th>Fecha</th>
            <th>Proveedor</th>
            <th>Medio de pago</th>
            <th>Valor abonado</th>
            <th>Total</th>
            <th>Valor Deuda</th>
            <th>Pagada?</th>
            <th>Fecha cancelacion</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($facturas as $factura)
        <tr>
            <td>{{$factura->id_compra}}</td>
            <td>{{$factura->fecha}}</td>
            <td>{{$factura->proveedor}}</td>
            <td>{{$factura->medio_de_pago?"Contado":"Crédito"}}</td>
            <td>{{$factura->monto_abonado}}</td>
            <td>{{$factura->total}}</td>
            <td>{{$factura->medio_de_pago?0:($factura->Total_compra-$factura->monto_abonado)}}</td>
            <td>{{$factura->pagada?"Si":"No"}}</td>
            <td>{{$factura->fecha_pago}}</td>
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