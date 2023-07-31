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
    /* table {
        font-family: arial, sans-serif;
        font-size: 8px;
        width: 100%;
    }

    td,
    th {
        border: 0px solid #dddddd;
        padding: 1px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    } */

    table {
        font-family: arial, sans-serif;
        font-size: 12px;
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

   /*  #tabla1 tr {
        border: 1px solid #000;
    }

    #tabla1 td {
        border: 1px solid #000;
    }
    #tabla2 tr:nth-child(even) {
        border:1px solid #ddd;
        background-color: #ddd;
    }

    #tabla2 td {
        border: 1px solid #ddd;
    } */



    tr:nth-child(even) {
        background-color: #ddd;
    }

    tr:hover td {
        background-color: #369681;
        color: white;
    }
</style>

<body>
    @php
    $totalAPagar = 0;
    @endphp

    @foreach($resultados as $data)
        <!-- Encabezado -->
        <h1>Factura número: {{ $data->id_compra }}</h1>
        <p>Fecha: {{ $data->fecha }}</p>
        <p>Proveedor: {{ $data->proveedor }}</p>
        <p>Forma de pago: {{ ($metodoPago==="Dia anterior")?"Presupuesto dia anterior": $metodoPago}}</p>
        

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

        <!-- Total a pagar -->
        <p>Total factura a pagar: {{ $data->Total_compra - $data->monto_abonado }}</p>

        @php
        $totalAPagar += ($data->Total_compra - $data->monto_abonado);
        @endphp
    @endforeach

    <hr>
    <h2>Total a pagar: {{ $totalAPagar }}</h2>

</body>

</html>
