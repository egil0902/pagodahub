<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    /* table {
        font-family: arial, sans-serif;
    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        border-style: dotted;
    }

    th {
        width: 100px;
    } */
    table {
        font-family: arial, sans-serif;
        font-size: 8px;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        padding: 1px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>

<body>
    @if (isset($closecashsumlist))
        @if ($closecashsumlist->{'records-size'} > 0)
            @foreach ($closecashsumlist->records as $data)
                <h2>Cierre de caja</h2>
                <br>
                <label><b>Cantidad de cierres: {{ $data->gh_closecash_id_count }}</b></label><br>
                <label>Inicio caja:<b id="InicioCaja"> {{ $data->BeginningBalance }}
                    </b></label>
                @if (isset($closecashlist))
                    <table>
                        <tr align="left">
                            <th>Caja</th>
                            <th>Cajera</th>
                            <th>Inicio caja</th>
                            <th>Subtotal</th>
                            <th>Monto contado</th>
                            <th>Monto X</th>
                            <th>Diferencia</th>
                        </tr>
                        @if ($closecashlist->{'records-size'} > 0)
                            @foreach ($closecashlist->records as $closecashl)
                                <tr>
                                    <td>{{ $closecashl->ba_name }}</td>
                                    <td>{{ $closecashl->u_name }}</td>
                                    <td align="right">
                                        @php
                                            echo number_format($closecashl->BeginningBalance, 2, ',', ' ');
                                        @endphp
                                    </td>
                                    <td align="right">
                                        @php
                                            echo number_format($closecashl->SubTotal, 2, ',', ' ');
                                        @endphp
                                    </td>
                                    <td align="right">
                                        @php
                                            echo number_format($closecashl->NetTotal, 2, ',', ' ');
                                        @endphp
                                    </td>
                                    <td align="right">
                                        @php
                                            echo number_format($closecashl->XAmt, 2, ',', ' ');
                                        @endphp
                                    </td>
                                    <td align="right">
                                        @php
                                            echo number_format($closecashl->DifferenceAmt, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                @endif
                @if ($list->isNotEmpty())
                    @foreach ($list as $dataday)
                        <div class="col-2 col-sm-2 col-md-2 col-lg-2" name="id">
                            {{--   {{ $dataday->id }} --}}
                        </div>
                    @endforeach
                @endif

                <table>
                    <tr>
                        <td>
                            <h3>Monto sistema</h3>
                            <table>
                                <tr>
                                    <th colspan="2">Efectivo</th>
                                    <th align="right">
                                        @php
                                            echo number_format($data->x_oneamt * 1 + $data->x_fiveamt * 5 + $data->x_tenamt * 10 + $data->x_twentyamt * 20 + $data->x_fiftyamt * 50 + $data->x_hundredamt * 100, 2, ',', ' ');
                                        @endphp
                                    </th>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <table style="width:100%">
                                            <tr>
                                                <td align="left">$1</td>
                                                <td align="center">*</td>
                                                <td align="right">@php
                                                    echo number_format($data->x_oneamt, 2, ',', ' ');
                                                @endphp</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td align="right">
                                        @php
                                            echo number_format($data->x_oneamt * 1, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <table style="width:100%">
                                            <tr>
                                                <td align="left">$5</td>
                                                <td align="center">*</td>
                                                <td align="right">@php
                                                    echo number_format($data->x_fiveamt, 2, ',', ' ');
                                                @endphp</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td align="right">
                                        @php
                                            echo number_format($data->x_fiveamt * 5, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <table style="width:100%">
                                            <tr>
                                                <td align="left">$10</td>
                                                <td align="center">*</td>
                                                <td align="right">@php
                                                    echo number_format($data->x_tenamt, 2, ',', ' ');
                                                @endphp</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td align="right">
                                        @php
                                            echo number_format($data->x_tenamt * 10, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                                <tr>

                                    <td colspan="2">
                                        <table style="width:100%">
                                            <tr>
                                                <td align="left">$20</td>
                                                <td align="center">*</td>
                                                <td align="right">@php
                                                    echo number_format($data->x_twentyamt, 2, ',', ' ');
                                                @endphp</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td align="right">
                                        @php
                                            echo number_format($data->x_twentyamt * 20, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <table style="width:100%">
                                            <tr>
                                                <td align="left">$50</td>
                                                <td align="center">*</td>
                                                <td align="right">@php
                                                    echo number_format($data->x_fiftyamt, 2, ',', ' ');
                                                @endphp</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td align="right">
                                        @php
                                            echo number_format($data->x_fiftyamt * 50, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <table style="width:100%">
                                            <tr>
                                                <td align="left">$100</td>
                                                <td align="center">*</td>
                                                <td align="right">@php
                                                    echo number_format($data->x_hundredamt, 2, ',', ' ');
                                                @endphp</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td align="right">
                                        @php
                                            echo number_format($data->x_hundredamt * 100, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <table>
                                <tr>
                                    <th colspan="2">Otros</th>

                                    <th align="right">
                                        @php
                                            echo number_format($data->yappy + $data->otros + $data->valespagoda + $data->CheckAmt + $data->LotoAmt + $data->CreditAmt + $data->CardAmt + $data->CashAmt + $data->CoinRoll + $data->InvoiceAmt + $data->VoucherAmt + $data->GrantAmt, 2, ',', ' ');
                                        @endphp
                                    </th>
                                </tr>
                                <tr>
                                    <td colspan="2">Yappy</td>

                                    <td align="right">
                                        @php
                                            echo number_format($data->yappy, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Otros</td>

                                    <td align="right">
                                        @php
                                            echo number_format($data->otros, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>

                                    <td align="right">
                                        ---
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Vales pagoda</td>

                                    <td align="right">
                                        @php
                                            echo number_format($data->valespagoda, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Monto cheques</td>

                                    <td align="right">
                                        @php
                                            echo number_format($data->CheckAmt, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Loteria</td>

                                    <td align="right">
                                        @php
                                            echo number_format($data->LotoAmt, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Vale</td>

                                    <td align="right">
                                        @php
                                            echo number_format($data->CreditAmt, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Tarjetas</td>

                                    <td align="right">
                                        @php
                                            echo number_format($data->CardAmt, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>

                                    <td align="right">
                                        ---
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>

                                    <td align="right">
                                        ---
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>

                                    <td align="right">
                                        ---
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>

                                    <td align="right">
                                        ---
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>

                                    <td align="right">
                                        ---
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Sencillo</td>

                                    <td align="right">
                                        @php
                                            echo number_format($data->CashAmt, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Rollos</td>

                                    <td align="right">
                                        @php
                                            echo number_format($data->CoinRoll, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Facturas</td>

                                    <td align="right">
                                        @php
                                            echo number_format($data->InvoiceAmt, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"> </td>

                                    <td align="right">
                                        ---
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Vale digital</td>

                                    <td align="right">
                                        @php
                                            echo number_format($data->VoucherAmt, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Beca digital</td>

                                    <td align="right">
                                        @php
                                            echo number_format($data->GrantAmt, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Subtotal super</td>

                                    <td align="right">
                                        @php
                                            echo number_format($data->SubTotal, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                            </table>

                            <br>
                            <table>
                                <tr>
                                    <th colspan="2"></th>

                                    <th></th>
                                </tr>
                                <tr>
                                    <th colspan="2">-</th>

                                    <th align="right"></th>
                                </tr>
                                <tr>
                                    <th colspan="2">-</th>

                                    <th align="right">
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2">-</th>

                                    <th align="right">
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2">-</th>

                                    <th align="right">
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2">-</th>

                                    <th align="right">
                                    </th>
                                </tr>
                            </table>

                            <br>
                            <table>
                                <tr>
                                    <th colspan="2"></th>

                                    <th></th>
                                </tr>
                                <tr>
                                    <th colspan="2">Monto contado</th>

                                    <th align="right">
                                        @php
                                            echo number_format($data->NetTotal, 2, ',', ' ');
                                        @endphp
                                    </th>
                                </tr>
                                <tr>
                                    <td colspan="2">Monto X</td>

                                    <td align="right">
                                        @php
                                            echo number_format($data->XAmt, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Diferencia</td>

                                    <td align="right">
                                        @php
                                            echo number_format($data->DifferenceAmt, 2, ',', ' ');
                                        @endphp
                                    </td>
                                </tr>
                            </table>
                        </td>

                        <td>
                            <h3>Fiscalizadora</h3>
                            <table>
                                @if ($list->isNotEmpty())
                                    @foreach ($list as $dataday)
                                        <tr>
                                            <th>Efectivo</th>
                                            <th align="right">
                                                @php
                                                    echo number_format($dataday->x_oneamtFiscalizadora * 1 + $dataday->x_fiveamtFiscalizadora * 5 + $dataday->x_tenamtFiscalizadora * 10 + $dataday->x_twentyamtFiscalizadora * 20 + $dataday->x_fiftyamtFiscalizadora * 50 + $dataday->x_hundredamtFiscalizadora * 100, 2, ',', ' ');
                                                @endphp</th>
                                            <th>Diferencia</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table style="width:100%">
                                                    <tr>
                                                        <td align="left">1</td>
                                                        <td align="center">*</td>
                                                        <td align="right">@php
                                                            echo number_format($dataday->x_oneamtFiscalizadora, 2, ',', ' ');
                                                        @endphp</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_oneamtFiscalizadora * 1, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_oneamtFiscalizadora - $data->x_oneamt, 2, ',', ' ');
                                                @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table style="width:100%">
                                                    <tr>
                                                        <td align="left">5</td>
                                                        <td align="center">*</td>
                                                        <td align="right"> @php
                                                            echo number_format($dataday->x_fiveamtFiscalizadora, 2, ',', ' ');
                                                        @endphp</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_fiveamtFiscalizadora * 5, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_fiveamtFiscalizadora - $data->x_fiveamt, 2, ',', ' ');
                                                @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table style="width:100%">
                                                    <tr>
                                                        <td align="left">10</td>
                                                        <td align="center">*</td>
                                                        <td align="right"> @php
                                                            echo number_format($dataday->x_tenamtFiscalizadora, 2, ',', ' ');
                                                        @endphp
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_tenamtFiscalizadora * 10, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_tenamtFiscalizadora - $data->x_tenamt, 2, ',', ' ');
                                                @endphp
                                            </td>

                                        </tr>
                                        <tr>
                                            <td align="right">
                                                <table style="width:100%">
                                                    <tr>
                                                        <td align="left">20</td>
                                                        <td align="center">*</td>
                                                        <td align="right">
                                                            @php
                                                                echo number_format($dataday->x_twentyamtFiscalizadora, 2, ',', ' ');
                                                            @endphp
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_twentyamtFiscalizadora * 20, 2, ',', ' ');
                                                @endphp
                                            </td>

                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_twentyamtFiscalizadora - $data->x_twentyamt, 2, ',', ' ');
                                                @endphp
                                            </td>

                                        </tr>
                                        <tr>
                                            <td align="right">
                                                <table style="width:100%">
                                                    <tr>
                                                        <td align="left">50</td>
                                                        <td align="center">*</td>
                                                        <td align="right">
                                                            @php
                                                                echo number_format($dataday->x_fiftyamtFiscalizadora, 2, ',', ' ');
                                                            @endphp
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_fiftyamtFiscalizadora * 50, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_fiftyamtFiscalizadora - $data->x_fiftyamt, 2, ',', ' ');
                                                @endphp
                                            </td>

                                        </tr>
                                        <tr>
                                            <td align="right">
                                                <table style="width:100%">
                                                    <tr>
                                                        <td align="left">100</td>
                                                        <td align="center">*</td>
                                                        <td align="right">
                                                            @php
                                                                echo number_format($dataday->x_hundredamtFiscalizadora, 2, ',', ' ');
                                                            @endphp
                                                        </td>
                                                    </tr>
                                                </table>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_hundredamtFiscalizadora * 100, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_hundredamtFiscalizadora - $data->x_hundredamt, 2, ',', ' ');
                                                @endphp
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                            <br>

                            <table>
                                @if ($list->isNotEmpty())
                                    @foreach ($list as $dataday)
                                        <tr>
                                            <th>Otros</th>
                                            <th align="right">
                                                @php
                                                    echo number_format($dataday->yappyFiscalizadora + $dataday->otrosFiscalizadora + $dataday->otrosprimeroFiscalizadora + $dataday->valespagodaFiscalizadora + $dataday->CheckAmtFiscalizadora + $dataday->LotoAmtFiscalizadora + $dataday->valeAmtFiscalizadora + $dataday->CardClaveFiscalizadora + $dataday->CardValeFiscalizadora + $dataday->CardVisaFiscalizadora + $dataday->CardMasterFiscalizadora + $dataday->CardAEFiscalizadora + $dataday->CardBACFiscalizadora + $dataday->CashAmtFiscalizadora + $dataday->CoinRollFiscalizadora + $dataday->InvoiceAmtFiscalizadora + $dataday->InvoiceAmtPropiasFiscalizadora + $dataday->VoucherAmtFiscalizadora + $dataday->GrantAmtFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </th>
                                            <th>Diferencia</th>
                                        </tr>
                                        <tr>
                                            <td>Yappy</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->yappyFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->yappyFiscalizadora - $data->yappy, 2, ',', ' ');
                                                @endphp
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Otros</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->otrosFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->otrosFiscalizadora - $data->otros, 2, ',', ' ');
                                                @endphp
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Primera parte </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->otrosprimeroFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">

                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Vales pagoda</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->valespagodaFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->valespagodaFiscalizadora - $data->valespagoda, 2, ',', ' ');
                                                @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Monto cheques</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CheckAmtFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CheckAmtFiscalizadora - $data->CheckAmt, 2, ',', ' ');
                                                @endphp
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Loteria</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->LotoAmtFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->LotoAmtFiscalizadora - $data->LotoAmt, 2, ',', ' ');
                                                @endphp

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Vale</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->valeAmtFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->valeAmtFiscalizadora - $data->CreditAmt, 2, ',', ' ');
                                                @endphp
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Tarjeta clave</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CardClaveFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta vale</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CardValeFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta visa</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CardVisaFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta master</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CardMasterFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta american</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CardAEFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta bac </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CardBACFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td>Sencillo</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CashAmtFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CashAmtFiscalizadora - $data->CashAmt, 2, ',', ' ');
                                                @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Rollos</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CoinRollFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">@php
                                                echo number_format($dataday->CoinRollFiscalizadora - $data->CoinRoll, 2, ',', ' ');
                                            @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Facturas</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->InvoiceAmtFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->InvoiceAmtFiscalizadora - $data->InvoiceAmt, 2, ',', ' ');
                                                @endphp

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Facturas propias</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->InvoiceAmtPropiasFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td>Vale digital</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->VoucherAmtFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">@php
                                                echo number_format($dataday->VoucherAmtFiscalizadora - $data->VoucherAmt, 2, ',', ' ');
                                            @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Beca digital</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->GrantAmtFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->GrantAmtFiscalizadora - $data->GrantAmt, 2, ',', ' ');
                                                @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Subtotal super</th>
                                            <th align="right">
                                                @php
                                                    echo number_format($dataday->x_oneamtFiscalizadora * 1 + $dataday->x_fiveamtFiscalizadora * 5 + $dataday->x_tenamtFiscalizadora * 10 + $dataday->x_twentyamtFiscalizadora * 20 + $dataday->x_fiftyamtFiscalizadora * 50 + $dataday->x_hundredamtFiscalizadora * 100 + $dataday->yappyFiscalizadora + $dataday->otrosFiscalizadora + $dataday->otrosprimeroFiscalizadora + $dataday->valespagodaFiscalizadora + $dataday->CheckAmtFiscalizadora + $dataday->LotoAmtFiscalizadora + $dataday->valeAmtFiscalizadora + $dataday->CardClaveFiscalizadora + $dataday->CardValeFiscalizadora + $dataday->CardVisaFiscalizadora + $dataday->CardMasterFiscalizadora + $dataday->CardAEFiscalizadora + $dataday->CardBACFiscalizadora + $dataday->CashAmtFiscalizadora + $dataday->CoinRollFiscalizadora + $dataday->InvoiceAmtFiscalizadora + $dataday->InvoiceAmtPropiasFiscalizadora + $dataday->VoucherAmtFiscalizadora + $dataday->GrantAmtFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </th>
                                            <th> </th>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                            <br>
                            <table>
                                @if ($list->isNotEmpty())
                                    @foreach ($list as $dataday)
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>Total panaderia</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->totalPanaderiaFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Total pagatodo</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->totalPagatodoFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Total super</td>
                                            <td align="right">@php
                                                echo number_format($dataday->totalsuperFiscalizadora, 2, ',', ' ');
                                            @endphp
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Dinero de taxi</td>
                                            <td align="right">@php
                                                echo number_format($dataday->dineroTaxiFiscalizadora, 2, ',', ' ');
                                            @endphp

                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Vuelto de mercado</td>
                                            <td align="right">@php
                                                echo number_format($dataday->vueltoMercadoFiscalizadora, 2, ',', ' ');
                                            @endphp
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                            <br>
                            <table>
                                @if ($list->isNotEmpty())
                                    @foreach ($list as $dataday)
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>Monto contado</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_oneamtFiscalizadora * 1 + $dataday->x_fiveamtFiscalizadora * 5 + $dataday->x_tenamtFiscalizadora * 10 + $dataday->x_twentyamtFiscalizadora * 20 + $dataday->x_fiftyamtFiscalizadora * 50 + $dataday->x_hundredamtFiscalizadora * 100 + $dataday->yappyFiscalizadora + $dataday->otrosFiscalizadora + $dataday->otrosprimeroFiscalizadora + $dataday->valespagodaFiscalizadora + $dataday->CheckAmtFiscalizadora + $dataday->LotoAmtFiscalizadora + $dataday->valeAmtFiscalizadora + $dataday->CardClaveFiscalizadora + $dataday->CardValeFiscalizadora + $dataday->CardVisaFiscalizadora + $dataday->CardMasterFiscalizadora + $dataday->CardAEFiscalizadora + $dataday->CardBACFiscalizadora + $dataday->CashAmtFiscalizadora + $dataday->CoinRollFiscalizadora + $dataday->InvoiceAmtFiscalizadora + $dataday->InvoiceAmtPropiasFiscalizadora + $dataday->VoucherAmtFiscalizadora + $dataday->GrantAmtFiscalizadora - $data->BeginningBalance, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Monto X</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($data->XAmt, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td></td>

                                        </tr>
                                        <tr>
                                            <td>Diferencia</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_oneamtFiscalizadora * 1 + $dataday->x_fiveamtFiscalizadora * 5 + $dataday->x_tenamtFiscalizadora * 10 + $dataday->x_twentyamtFiscalizadora * 20 + $dataday->x_fiftyamtFiscalizadora * 50 + $dataday->x_hundredamtFiscalizadora * 100 + $dataday->yappyFiscalizadora + $dataday->otrosFiscalizadora + $dataday->otrosprimeroFiscalizadora + $dataday->valespagodaFiscalizadora + $dataday->CheckAmtFiscalizadora + $dataday->LotoAmtFiscalizadora + $dataday->valeAmtFiscalizadora + $dataday->CardClaveFiscalizadora + $dataday->CardValeFiscalizadora + $dataday->CardVisaFiscalizadora + $dataday->CardMasterFiscalizadora + $dataday->CardAEFiscalizadora + $dataday->CardBACFiscalizadora + $dataday->CashAmtFiscalizadora + $dataday->CoinRollFiscalizadora + $dataday->InvoiceAmtFiscalizadora + $dataday->InvoiceAmtPropiasFiscalizadora + $dataday->VoucherAmtFiscalizadora + $dataday->GrantAmtFiscalizadora - $data->BeginningBalance - $data->XAmt, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </td>

                        <td>
                            <h3>Gerente</h3>
                            <table>
                                @if ($list->isNotEmpty())
                                    @foreach ($list as $dataday)
                                        <tr>
                                            <th>Efectivo</th>
                                            <th align="right">
                                                @php
                                                    echo number_format(0, 2, ',', ' ');
                                                @endphp</th>
                                            <th>Diferencia</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table style="width:100%">
                                                    <tr>
                                                        <td align="left">1</td>
                                                        <td align="center">*</td>
                                                        <td align="right">@php
                                                            echo number_format($dataday->x_oneamtGerente, 2, ',', ' ');
                                                        @endphp</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_oneamtGerente * 1, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_oneamtGerente - $dataday->x_oneamtFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table style="width:100%">
                                                    <tr>
                                                        <td align="left">5</td>
                                                        <td align="center">*</td>
                                                        <td align="right"> @php
                                                            echo number_format($dataday->x_fiveamtGerente, 2, ',', ' ');
                                                        @endphp</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_fiveamtGerente * 5, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_fiveamtGerente - $dataday->x_fiveamtFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table style="width:100%">
                                                    <tr>
                                                        <td align="left">10</td>
                                                        <td align="center">*</td>
                                                        <td align="right"> @php
                                                            echo number_format($dataday->x_tenamtGerente, 2, ',', ' ');
                                                        @endphp
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_tenamtGerente * 10, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_tenamtGerente - $dataday->x_tenamtFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>

                                        </tr>
                                        <tr>
                                            <td align="right">
                                                <table style="width:100%">
                                                    <tr>
                                                        <td align="left">20</td>
                                                        <td align="center">*</td>
                                                        <td align="right">
                                                            @php
                                                                echo number_format($dataday->x_twentyamtGerente, 2, ',', ' ');
                                                            @endphp
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_twentyamtGerente * 20, 2, ',', ' ');
                                                @endphp
                                            </td>

                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_twentyamtGerente - $dataday->x_twentyamtFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>

                                        </tr>
                                        <tr>
                                            <td align="right">
                                                <table style="width:100%">
                                                    <tr>
                                                        <td align="left">50</td>
                                                        <td align="center">*</td>
                                                        <td align="right">
                                                            @php
                                                                echo number_format($dataday->x_fiftyamtGerente, 2, ',', ' ');
                                                            @endphp
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_fiftyamtGerente * 50, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_fiftyamtGerente - $dataday->x_fiftyamtFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>

                                        </tr>
                                        <tr>
                                            <td align="right">
                                                <table style="width:100%">
                                                    <tr>
                                                        <td align="left">100</td>
                                                        <td align="center">*</td>
                                                        <td align="right">
                                                            @php
                                                                echo number_format($dataday->x_hundredamtGerente, 2, ',', ' ');
                                                            @endphp
                                                        </td>
                                                    </tr>
                                                </table>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_hundredamtGerente * 100, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_hundredamtGerente - $dataday->x_hundredamtFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                            <br>

                            <table>
                                @if ($list->isNotEmpty())
                                    @foreach ($list as $dataday)
                                        <tr>
                                            <th>Otros</th>
                                            <th align="right">
                                                @php
                                                    echo number_format($dataday->yappyFiscalizadora + $dataday->otrosFiscalizadora + $dataday->otrosprimeroFiscalizadora + $dataday->valespagodaFiscalizadora + $dataday->CheckAmtFiscalizadora + $dataday->LotoAmtFiscalizadora + $dataday->valeAmtFiscalizadora + $dataday->CardClaveFiscalizadora + $dataday->CardValeFiscalizadora + $dataday->CardVisaFiscalizadora + $dataday->CardMasterFiscalizadora + $dataday->CardAEFiscalizadora + $dataday->CardBACFiscalizadora + $dataday->CashAmtFiscalizadora + $dataday->CoinRollFiscalizadora + $dataday->InvoiceAmtFiscalizadora + $dataday->InvoiceAmtPropiasFiscalizadora + $dataday->VoucherAmtFiscalizadora + $dataday->GrantAmtFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </th>
                                            <th>Diferencia</th>
                                        </tr>
                                        <tr>
                                            <td>Yappy</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->yappyGerente, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->yappyGerente - $dataday->yappyFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Otros</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->otrosGerente, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->otrosGerente-$dataday->otrosFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Primera parte </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->otrosprimeroGerente, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">

                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Vales pagoda</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->valespagodaGerente, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->valespagodaGerente-$dataday->valespagodaFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Monto cheques</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CheckAmtGerente , 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CheckAmtGerente - $dataday->CheckAmtFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Loteria</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->LotoAmtGerente, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->LotoAmtGerente-$dataday->LotoAmtFiscalizadora, 2, ',', ' ');
                                                @endphp

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Vale</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->valeAmtGerente, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->valeAmtGerente- $dataday->valeAmtFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Tarjeta clave</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CardClaveGerente, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta vale</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CardValeGerente, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta visa</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CardVisaGerente, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta master</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CardMasterGerente , 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta american</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CardAEGerente, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td>Tarjeta bac </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CardBACGerente, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td>Sencillo</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CashAmtGerente, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CashAmtGerente- $dataday->CashAmtFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Rollos</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->CoinRollGerente, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">@php
                                                echo number_format($dataday->CoinRollGerente-$dataday->CoinRollFiscalizadora, 2, ',', ' ');
                                            @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Facturas</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->InvoiceAmtGerente, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->InvoiceAmtGerente-$dataday->InvoiceAmtFiscalizadora, 2, ',', ' ');
                                                @endphp

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Facturas propias</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->InvoiceAmtPropiasGerente, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td>Vale digital</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->VoucherAmtGerente, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">@php
                                                echo number_format($dataday->VoucherAmtGerente-$dataday->VoucherAmtFiscalizadora, 2, ',', ' ');
                                            @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Beca digital</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->GrantAmtGerente , 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->GrantAmtGerente -$dataday->GrantAmtFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Subtotal super</th>
                                            <th align="right">
                                                @php
                                                    echo number_format(0, 2, ',', ' ');
                                                @endphp
                                            </th>
                                            <th> </th>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                            <br>
                            <table>
                                @if ($list->isNotEmpty())
                                    @foreach ($list as $dataday)
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>Total panaderia</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->totalPanaderiaFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Total pagatodo</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->totalPagatodoFiscalizadora, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Total super</td>
                                            <td align="right">@php
                                                echo number_format($dataday->totalsuperFiscalizadora, 2, ',', ' ');
                                            @endphp
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Dinero de taxi</td>
                                            <td align="right">@php
                                                echo number_format($dataday->dineroTaxiFiscalizadora, 2, ',', ' ');
                                            @endphp

                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Vuelto de mercado</td>
                                            <td align="right">@php
                                                echo number_format($dataday->vueltoMercadoFiscalizadora, 2, ',', ' ');
                                            @endphp
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                            <br>
                            <table>
                                @if ($list->isNotEmpty())
                                    @foreach ($list as $dataday)
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>Monto contado</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_oneamtFiscalizadora * 1 + $dataday->x_fiveamtFiscalizadora * 5 + $dataday->x_tenamtFiscalizadora * 10 + $dataday->x_twentyamtFiscalizadora * 20 + $dataday->x_fiftyamtFiscalizadora * 50 + $dataday->x_hundredamtFiscalizadora * 100 + $dataday->yappyFiscalizadora + $dataday->otrosFiscalizadora + $dataday->otrosprimeroFiscalizadora + $dataday->valespagodaFiscalizadora + $dataday->CheckAmtFiscalizadora + $dataday->LotoAmtFiscalizadora + $dataday->valeAmtFiscalizadora + $dataday->CardClaveFiscalizadora + $dataday->CardValeFiscalizadora + $dataday->CardVisaFiscalizadora + $dataday->CardMasterFiscalizadora + $dataday->CardAEFiscalizadora + $dataday->CardBACFiscalizadora + $dataday->CashAmtFiscalizadora + $dataday->CoinRollFiscalizadora + $dataday->InvoiceAmtFiscalizadora + $dataday->InvoiceAmtPropiasFiscalizadora + $dataday->VoucherAmtFiscalizadora + $dataday->GrantAmtFiscalizadora - $data->BeginningBalance, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Monto X</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($data->XAmt, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td></td>

                                        </tr>
                                        <tr>
                                            <td>Diferencia</td>
                                            <td align="right">
                                                @php
                                                    echo number_format($dataday->x_oneamtFiscalizadora * 1 + $dataday->x_fiveamtFiscalizadora * 5 + $dataday->x_tenamtFiscalizadora * 10 + $dataday->x_twentyamtFiscalizadora * 20 + $dataday->x_fiftyamtFiscalizadora * 50 + $dataday->x_hundredamtFiscalizadora * 100 + $dataday->yappyFiscalizadora + $dataday->otrosFiscalizadora + $dataday->otrosprimeroFiscalizadora + $dataday->valespagodaFiscalizadora + $dataday->CheckAmtFiscalizadora + $dataday->LotoAmtFiscalizadora + $dataday->valeAmtFiscalizadora + $dataday->CardClaveFiscalizadora + $dataday->CardValeFiscalizadora + $dataday->CardVisaFiscalizadora + $dataday->CardMasterFiscalizadora + $dataday->CardAEFiscalizadora + $dataday->CardBACFiscalizadora + $dataday->CashAmtFiscalizadora + $dataday->CoinRollFiscalizadora + $dataday->InvoiceAmtFiscalizadora + $dataday->InvoiceAmtPropiasFiscalizadora + $dataday->VoucherAmtFiscalizadora + $dataday->GrantAmtFiscalizadora - $data->BeginningBalance - $data->XAmt, 2, ',', ' ');
                                                @endphp
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </td>

                    </tr>
                </table>
            @endforeach
        @endif
    @endif
</body>

</html>
