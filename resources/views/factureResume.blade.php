@extends('layouts.app')
@section('title', 'Page Title')


@section('content')
<div class="p-2 centrado" style ="width:80%;">
    <table>
        
        <thead>
            <tr>
                <td colspan="12">RESUMEN COMPRAS:</td>
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
    <br>
    <br>
    
    @if(count($facturas)>0)
    <table>
        <thead>
            
            <tr >
                <th>FACTURAS</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr style='background-color:#2cbc9c'>
                <th># FACTURA</th>
                <th>METODO DE PAGO</th>
                <th>MONTO TOTAL</th>
                <th>ABONO/CANCELADO</th>
                <th>DEUDA</th>
            </tr>
        </thead>
            @foreach ($facturas as $factura)
                <tr>
                    <td>{{$factura->id}}</td>
                    <td>{{$factura->medio_de_pago?'Contado':'Credito'}}</td>
                    <td>{{$factura->total}}</td>
                    <td>{{$factura->medio_de_pago?$factura->total:$factura->monto_abonado}}</td>
                    <td>{{$factura->medio_de_pago?0:($factura->total-$factura->monto_abonado)}}</td>
                
                </tr>
            @endforeach
       
    </table>
    @endif
    <BR>
    @if(count($cheques)>0)
    <table>
        <thead>
            <tr >
                <th>PAGOS A FACTURAS ANTERIORES</th>
                <th></th>
                <th></th>
            </tr>
            <tr style='background-color:#2cbc9c'>
                <th># FACTURA</th>
                <th>PROCEDENCIA DE LOS RECURSOS</th>
                <th>MONTO</th>
            </tr>
        </thead>
            @foreach ($cheques as $cheque)
                <tr>
                    <td>{{$cheque->id_factura}}</td>
                    <td>{{($cheque->pago_presupuesto===true)?'Presupuesto':'Otros'}}</td>
                    <td>{{$cheque->monto}}</td>
                
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
            <td>PAGO FACTURAS ANTERIORES</td>
            <td>{{$pagosAnteriores}}</td>
        </tr>
        <tr>
            <td>VUELTO</td>
            <td>{{$vuelto}}</td>
        </tr>
    </table>

        
    </div>
    

    <style>
        .centrado {
        margin-left: auto;
        margin-right: auto;
        text-align: center; /* Opcional: si deseas centrar el texto dentro del div */
    }
        table {
            font-family: arial, sans-serif;
            background-color: white;
            text-align: left;
            border-collapse: collapse;
            width: 100%;
        }
        .table th {
            max-width: 100px; /* Establece el ancho máximo deseado */
            text-overflow: ellipsis; /* Agrega puntos suspensivos (...) si el contenido es demasiado largo */
            white-space: nowrap; /* Evita que el texto se divida en varias líneas */
        }
        th,
        td {
            padding: 1px;

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

        #imagenesPrevias {
            display: center;
            flex-wrap: wrap;
        }

        #imagenesPrevias img {
            max-width: 75%;
            height: auto;
            margin: 5px;
            border: 1px solid;
        }
        .divider {
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
