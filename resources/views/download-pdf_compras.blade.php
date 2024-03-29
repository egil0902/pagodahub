<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        
    </title>
</head>
<style>
    table {
        font-family: arial, sans-serif;
        font-size: 10px;
        background-color: white;
        text-align: left;
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 1px;
        text-align: center;
        /* border: 1px solid #0F362D; */
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
    h2, p {
        margin: 0.8rem 0;
    }
</style>

<body>
    @php
    $totalAPagar = 0;
    @endphp
    <h2>Comprobante de pago</h2>
    @foreach($resultados as $data)
        <!-- Encabezado -->
        <h3>Factura número: {{ $data->id_compra }}</h3>
        <p>Fecha: {{ $data->fecha }} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            Forma de pago: {{ ($metodoPago==="Dia anterior")?"Presupuesto dia anterior ": $metodoPago}}{{$fecha_expedicion}}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            {{$banco!=""?"Banco:$banco":""}}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            {{$codigo!="000000"?"Código:$codigo":""}}</p>
        <p>Proveedor: {{ $data->proveedor }}</p>
        <!-- Listado de productos -->
        <table>
            <thead>
                <tr>
                    <th>Medio de pago</th>
                    <th>Abono anterior</th>
                    <th>Valor factura</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$data->medio_de_pago?"Contado":"Crédito"}}</td>
                    <td>{{$data->monto_abonado}}</td>
                    <td>{{$data->Total_compra}}</td>
                </tr>
            </tbody>
        </table>

        <!-- Total pagado -->
        <p>Total factura pagado: {{$montoParcial!=0? $montoParcial:($data->Total_compra - $data->monto_abonado) }}</p>
        <hr>
        @php
        $totalAPagar += ($data->Total_compra - $data->monto_abonado);
        @endphp
    @endforeach
    <br/>
    <h2>Total pagado: {{ $montoParcial!=0? $montoParcial:$totalAPagar }}</h2>

</body>

</html>
