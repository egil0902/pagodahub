<div class="row ">
    <div class="col">
        <input type="hidden" class="form-control" placeholder="Search" wire:model="searchTerm" disabled />
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead id="miTablaPersonalizada">
            <th>Fecha </th>
            <th>Sucursal </th>
            <th>Subtotal super</th>
            <th>Monto contado</th>
            <th>Monto X</th>
            <th>Diferencia</th>
            <th>
                <center>Eliminar</center>
            </th>
        </thead>
        <tbody>
            @foreach ($closecash as $data)
                <tr>
                    <form name="closecash_destroy" id="closecash_destroy" method="POST"
                        action="{{ route('closecash.destroy') }}">
                        {{ csrf_field() }}
                        <input name="valeid" type="hidden" value="{{ $data->id }}">
                        <td> {{ $data->DateTrx }} </td>
                        <td>
                            @if ($data->AD_Org_ID == 1000008)
                                Mañanitas
                            @endif
                            @if ($data->AD_Org_ID == 1000009)
                                La Doña
                            @endif
                        </td>
                        <td class="text-end">
                            @php
                                echo number_format($data->sub_total_super_sistema, 2, ',', ' ');
                            @endphp
                        </td>
                        <td class="text-end">
                            @php
                                echo number_format($data->monto_contado_sistema, 2, ',', ' ');
                            @endphp
                        </td>
                        <td class="text-end">
                            @php
                                echo number_format($data->monto_x_sistema, 2, ',', ' ');
                            @endphp</td>
                        <td class="text-end">
                            @php
                                echo number_format($data->monto_contado_sistema - $data->monto_x_sistema, 2, ',', ' ');
                            @endphp </td>
                        <td>
                            <center>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#closecashModal{{ $data->id }}"style="
                        padding-right: 5px;
                        padding-top: 0px;
                        padding-left: 5px;
                        padding-bottom: 0px;">x</button>
                            </center>
                        </td>


                        <div class="modal fade" id="closecashModal{{ $data->id }}" tabindex="-1"
                            aria-labelledby="closecashModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="closecashModalLabel">Confirmacion</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Seguro desea eliminar este registro? {{ $data->DateTrx }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Confirmar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col">
        {{ $closecash->links() }}
    </div>
</div>
<!-- Modal -->


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
