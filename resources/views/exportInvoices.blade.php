
    <table>
        
        <thead>
            <tr>
                <th>
                fecha ingreso
                </th>
                <th>
                    Responsable
                </th>  
                <th>
                    Proveedor
                </th>            
                <th>Monto<br> exento</th>
                <th>Monto 7%</th>
                <th>ITBMS 7%</th>
                <th>Monto 10%</th>
                <th>ITBMS 10%</th>
                <th>Monto 15%</th>
                <th>ITBMS 15%</th>
                <th>Total <br>Neto</th>
                <th>Total <br>ITBMS</th>
                <th>Total USD</th>
                <th>fecha de pago
                    
                </th>
                <th>Forma de pago</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brinksend as $data)
                <tr>
                    <td>{{ date('d-m-Y', strtotime($data["fecha_ingreso"])) }}</td>
                    <td>{{ $data["responsable_ingreso"] }}</td>
                    <td>{{ $data["proveedor"] }}</td>
                    <td>{{ number_format($data["monto_total"], 2) }}</td>
                    <td>{{ number_format($data["monto_7"], 2) }}</td>
                    <td>{{ number_format($data["monto_impuesto_7"], 2) }}</td>
                    <td>{{ number_format($data["monto_10"], 2) }}</td>
                    <td>{{ number_format($data["monto_impuesto_10"], 2) }}</td>
                    <td>{{ number_format($data["monto_15"], 2) }}</td>
                    <td>{{ number_format($data["monto_impuesto_15"], 2) }}</td>
                    <td>{{ number_format($data["monto_total"] + $data["monto_7"] + $data["monto_10"] + $data["monto_15"], 2) }}</td>
                    <td>{{ number_format($data["monto_impuesto_7"] + $data["monto_impuesto_10"] + $data["monto_impuesto_15"], 2) }}</td>
                    <td>{{ number_format($data["monto_total"] + $data["monto_7"] + $data["monto_10"] + $data["monto_15"] + $data["monto_impuesto_7"] + $data["monto_impuesto_10"] + $data["monto_impuesto_15"], 2) }}</td>

                    <td>{{ date('d-m-Y', strtotime($data["fecha_pago"])) }}</td>
                    <!--<td>{{ $data["forma_pago"] }}
                        @if($data["forma_pago"]==="tarjeta_credito")
                            <br>
                            {{$data["tarjeta"]}}
                        @endif
                        @if($data["forma_pago"]==="banco efectivo")
                            <br>
                            {{$data["presupuest_banco"]}}
                        @endif
                    </td>-->
                    <td>
                        @foreach (json_decode($data['forma_pago_multiple'], true) as  $forma_pago)
                        <div class="py-2">
                            <p>* {{ $forma_pago['descripcion_forma_pago'] }}</p>
                            @switch($forma_pago['forma_pago'])
                                @case('caja')
                                     <p class="mx-3">Monto: {{ number_format($forma_pago['valor'], 2) }}</p>
                                    @break
                                @case('tarjeta_credito')
                                    <p class="mx-3 my-0">Tarjeta: {{ $forma_pago['tarjeta'] }}</p>
                                    <p class="mx-3 my-0">Monto: {{ number_format($forma_pago['valor'], 2) }}</p>
                                    @break
                                @case('credito')
                                    <p class="mx-3 my-0">Opción: {{ $forma_pago['credito_options'] }}</p>
                                    <p class="mx-3 my-0">Banco: {{ $forma_pago['banco'] }}</p>
                                    <p class="mx-3 my-0">Comprobante: {{ $forma_pago['comprobante'] }}</p>
                                    <p class="mx-3 my-0">Monto: {{ number_format($forma_pago['valor'], 2) }}</p>
                                    @break
                                @case('banco')

                                    @foreach ($forma_pago['banco_options'] as  $banco_option)

                                        @switch($banco_option['option'])

                                            @case('efectivo')
                                                <p class="mx-3 my-0">Efectivo</p>
                                                <p class="mx-3 my-0">Monto: {{ number_format($banco_option['valor'], 2) }}</p>
                                                <br>
                                                @break
                                            @case('loteria')
                                                <p class="mx-3 my-0">Loteria</p>
                                                <p class="mx-3 my-0">Monto: {{ number_format($banco_option['valor'], 2) }}</p>
                                                <br>
                                                @break
                                            @case('cheque')
                                                <p class="mx-3 my-0">Cheque</p>
                                                <p class="mx-3 my-0">Banco: {{ $banco_option['banco'] }}</p>
                                                <p class="mx-3 my-0">Comprobante: {{ $banco_option['comprobante'] }}</p>
                                                <p class="mx-3 my-0">Monto: {{ number_format($banco_option['valor'], 2) }}</p>
                                                <br>
                                                @break

                                        @endswitch

                                    @endforeach

                                    @break
                            @endswitch
                            <br>
                        </div>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>