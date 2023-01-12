{{-- <div class="row ">
    <div class="col">
        <input type="hidden" class="form-control" placeholder="Search" wire:model="searchTerm" disabled />
    </div>
</div> --}}
{{-- <div class="row">
                <div class="col">
                    <select class="form-select" aria-label="Sucursal">
                        <option selected>Dia</option>
                        <option value="1">Mañanitas</option>
                        <option value="2">La Doña</option>
                    </select>
                </div>
                <div class="col">
                    <select class="form-select" aria-label="Sucursal">
                        <option selected>Mes</option>
                        <option value="1">Mañanitas</option>
                        <option value="2">La Doña</option>
                    </select>
                </div>
                <div class="col">
                    <select class="form-select" aria-label="Sucursal">
                        <option selected>Año</option>
                        <option value="1">Mañanitas</option>
                        <option value="2">La Doña</option>
                    </select>
                </div>
                <br>
            </div>
            <br> --}}

<div class="table-responsive">
    <table class="table table-bordered">
        <thead id="miTablaPersonalizada">
            <th>
                Fecha <input type="date" class="form-control" placeholder="#Vale" wire:model="date"  data-date-format="DD MMMM YYYY" aria-label="Username"
                aria-describedby="basic-addon1">
            </th>
            <th>
                <select wire:model="tipo" class="form-select" aria-label="Default select example">
                    <option selected value="Sucursal">Sucursal</option>
                    <option value="1000008">Mañanitas</option>
                    <option value="1000009">La Doña</option>
                </select>
            </th>
            <th>Subtotal super</th>
            <th>Monto contado</th>
            <th>Monto X</th>
            <th>Diferencia</th>
            <th>
                <center>Editar/Eliminar</center>
            </th>
        </thead>
        <tbody>
            @foreach ($closecash as $data)
                <tr>

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
                            <div class="btn-group">
                                <form name="closecash_import" id="closecash_import" method="post"
                                    action="{{ route('closecash.import') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input name="DateTrx" type="hidden" value=" {{ $data->DateTrx }}">
                                    <input name="AD_Org_ID" type="hidden" value="{{ $data->AD_Org_ID }}">
                                    <button type="submit" class="btn btn-outline-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z">
                                            </path>
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                                <div>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#closecashModal{{ $data->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>



                            <form name="closecash_destroy" id="closecash_destroy" method="POST"
                                action="{{ route('closecash.destroy') }}">
                                {{ csrf_field() }}
                                <input name="valeid" type="hidden" value="{{ $data->id }}">
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

                        </center>
                    </td>





                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col">
            {{ $closecash->links() }}
        </div>
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
