{{-- <div class="row ">
    <div class="col">
        <input type="hidden" class="form-control" placeholder="Search" wire:model="searchTerm" />
    </div>
</div> --}}

<div class="table-responsive">
    <table class="table table-bordered">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg></span>
            <input type="text" class="form-control" placeholder="#Vale" wire:model="valenum" aria-label="Username"
                aria-describedby="basic-addon1">
        </div>
        <thead id="miTablaPersonalizada">
            <th>Número de vale</th>
            <th>Cédula </th>
            <th>Nombre </th>
            <th>Fecha de Consumo </th>
            <th>Validado Por </th>
            <th>Sucursal </th>
            <th>Eliminar</th>
        </thead>
        <tbody>
            @foreach ($vales as $data)
                <tr>
                    <td>{{ $data->value }}</td>
                    <td>{{ $data->taxid }}</td>
                    <td>{{ $data->name }} </td>
                    <td>{{ date('d-m-Y', strtotime($data->created_at)) }} </td>
                    <td>{{ $data->CreatedBy }} </td>
                    <td>
                        @if ($data->AD_Org_ID == 1000000)
                            Grupo Panama Este, S.A.
                        @endif
                        @if ($data->AD_Org_ID == 1000008)
                            Mañanitas
                        @endif
                        @if ($data->AD_Org_ID == 1000009)
                            La Doña
                        @endif
                    </td>
                    <td>
                        <center>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $data->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z">
                                    </path>
                                </svg>
                            </button>
                        </center>
                        <form name="valepagoda_destroy" id="valepagoda_destroy" method="POST"
                            action="{{ route('valepagoda.destroy') }}">
                            {{ csrf_field() }}
                            <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmacion</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input name="valeidok" type="hidden" value="{{ $data->id }}">
                                            Seguro desea eliminar este registro? {{ $data->value }}
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
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col">
            {{ $vales->links() }}
        </div>
    </div>
</div>
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
