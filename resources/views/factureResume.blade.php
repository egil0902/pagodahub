@extends('layouts.app')
@section('title', 'Page Title')


@section('content')
<div class="p-2 centrado" style="width: 80%;">
    <table>
        <thead>
            <tr>
                <th colspan="12">RESUMEN COMPRAS:</th>
            </tr>
        </thead>
        <tr>
            <td colspan="2">FECHA</td>
            <td colspan="2">{{$fecha}}</td>
            <td colspan="1">CANTIDAD DE PRODUCTOS</td>
            <td colspan="1">{{$cantidadProductos}}</td>
            <td colspan="2">PRESUPUESTO</td>
            <td colspan="2">{{$presupuesto}}</td>
        </tr>
    </table>
    <br><br>

    @if(count($facturas)>0)
    <table>
        <thead>
            <tr>
                <th colspan="5">FACTURAS</th>
            </tr>
            <tr style="background-color:#2cbc9c">
                <th># FACTURA</th>
                <th>METODO DE PAGO</th>
                <th>MONTO TOTAL</th>
                <th>ABONO/CANCELADO</th>
                <th>DEUDA</th>
            </tr>
        </thead>
        @foreach ($facturas as $factura)
        <tr>
            <td>{{$factura->id_compra}}</td>
            <td>{{$factura->medio_de_pago?'Contado':'Credito'}}</td>
            <td>{{$factura->total}}</td>
            <td>{{$factura->pagada?$factura->total:$factura->monto_abonado}}</td>
            
            <td>{{$factura->pagada?0:($factura->total-$factura->monto_abonado)}}</td>
        </tr>
        @endforeach
    </table>
    @endif
    <br>
    @if(count($cheques)>0)
    <table>
        <thead>
            <tr>
                <th colspan="4">PAGOS A FACTURAS ANTERIORES</th>
            </tr>
            <tr style="background-color:#2cbc9c">
                <th># FACTURA</th>
                <th>PROCEDENCIA DE LOS RECURSOS</th>
                <th>MONTO</th>
                <th>Fecha de pago</th>
            </tr>
        </thead>
        @foreach ($cheques as $cheque)
        <tr>
            <td>{{$cheque->id_factura}}</td>
            <td>{{($cheque->pago_presupuesto===true)?'Presupuesto':'Otros'}}</td>
            <td>{{$cheque->monto}}</td>
            <td>{{$cheque->fechaExpedicion}}</td>
        </tr>
        @endforeach
    </table>
    @endif
    <br>
    <table>
        <thead>
            <tr>
                <th>RESUMEN OPERACIONES</th>
                <th></th>
            </tr>
        </thead>
        <tr>
            <td>CARTON</td>
            <td>{{$carton}}</td>
        </tr>
        <tr>
            <td>TOTAL EN FACTURA</td>
            <td>{{$tFactura}}</td>
        </tr>
        <tr>
            <td>TOTAL EN FACTURAS EN EFECTIVO</td>
            <td>{{$tEfectivo}}</td>
        </tr>
        <tr>
            <td>TOTAL ABONADO</td>
            <td>{{$abonado}}</td>
        </tr>
        <tr>
            <td>TOTAL FACTURAS CREDITO</td>
            <td>{{$tCredito}}</td>
        </tr>
        <tr>
            <td>TOTAL DE DEUDA FACTURAS A CREDITO</td>
            <td>{{$deuda}}</td>
        </tr>
        <tr>
            <td>PAGO FACTURAS ANTERIORES</td>
            <td>{{$pagosAnteriores}}</td>
        </tr>
        <tr>
            <td>VUELTO CALCULADO</td>
            <td>{{$vuelto}}</td>
        </tr>
        <tr>
            <td>VUELTO ENTREGADO</td>
            <td>{{$vueltoEntregado}}</td>
        </tr>
        <tr>
            <td>DIFERENCIA DE VUELTO</td>
            <td>{{($vuelto>0)?$vueltoEntregado-$vuelto:$vueltoEntregado}}</td>
        </tr>
    </table>
    <form method="POST" action="{{ route('resume-pdf') }}">
        @csrf
        <input type="hidden" name="day" value="{{ $fecha }}">
        <button type="submit" class="btn btn-primary">Imprimir</button>
    </form>

</div>

<style>
    .centrado {
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }

    table {
        font-family: Arial, sans-serif;
        background-color: white;
        text-align: left;
        border-collapse: collapse;
        width: 100%;
    }

    table th,
    table td {
        padding: 8px;
    }

    table thead {
        background-color: #246355;
        border-bottom: 5px solid #0F362D;
        color: white;
    }

    table th {
        max-width: 100px;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    table tr:nth-child(even) {
        background-color: #ddd;
    }

    table tr:hover td {
        background-color: #369681;
        color: white;
    }

    table thead th[colspan="12"],
    table thead th[colspan="5"],
    table thead th[colspan="3"] {
        padding-top: 10px;
        padding-bottom: 10px;
    }

    table thead th[colspan="12"],
    table thead th[colspan="5"],
    table thead th[colspan="3"],
    table td[colspan="2"] {
        text-align: center;
    }

    table td[colspan="2"] {
        font-weight: bold;
    }

    table tr td:first-child {
        font-weight: bold;
    }

    table tr:last-child td {
        font-weight: bold;
    }

    .table-divider {
        width: 15px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    label {
        font-weight: bold;
    }

    input[type="checkbox"],
    input[type="text"] {
        margin-top: 5px;
    }

    button {
        margin-top: 10px;
    }
</style>
@endsection

