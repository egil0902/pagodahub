
    <table>
        
        <thead>
            <tr>
                <th>
                fecha ingreso
                </th>
                <th>
                    Responsable
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
                    <td>{{ $data["forma_pago"] }}
                        @if($data["forma_pago"]==="tarjeta_credito")
                            <br>
                            {{$data["tarjeta"]}}
                        @endif
                        @if($data["forma_pago"]==="banco efectivo")
                            <br>
                            {{$data["presupuest_banco"]}}
                        @endif
                           </td>
                </tr>
            @endforeach
        </tbody>
    </table>