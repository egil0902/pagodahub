{{-- <input type="hidden" class="form-control" placeholder="Search" wire:model="searchTerm" value="" /> --}}
<div class="table-responsive">
    <table class="table table-bordered">
        <thead id="miTablaPersonalizada">

            <th>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-list-ul" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        </svg>
                    </span>
                    <select wire:model="tipo" class="form-select" aria-label="Tipo">
                        <option selected value="">Tipo</option>
                        <option value="Prestamo">Prestamo</option>
                        <option value="Pago">Pago</option>
                    </select>
                </div>
            </th>
            <th>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-calendar3" viewBox="0 0 16 16">
                            <path
                                d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                            <path
                                d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        </svg>
                    </span>
                    <input type="date" class="form-control" placeholder="fecha" wire:model="fecha"
                        aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </th>
            <th>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon3"><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg></span>
                    <input type="text" class="form-control" placeholder="nombre" wire:model="nombre"
                        aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </th>
            <th>Monto</th>
            <th>Adjuntos</th>

        </thead>
        <tbody>
            @if (isset($loans))
                @if ($loans->isNotEmpty())
                    @foreach ($loans as $data)
                        {{-- <form name="valepagoda_destroy" id="valepagoda_destroy" method="POST"
                            action="{{ route('valepagoda.destroy') }}">
                            @csrf --}}
                        <tr>
                            <input name="valeid" type="hidden" value="{{ $data->id }}">
                            <td> {{ $data->loan_type }}</td>
                            <td>{{ date('d-m-Y', strtotime($data->datetrx)) }}</td>
                            <td> {{ $data->nombre }}</td>
                            <td align="right">
                                <p>@php
                                    echo number_format($data->monto, 2, ',', ' ');
                                @endphp</p>
                            </td>
                            <td>
                                <center>
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $data->loan_type }}{{ $data->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                                            <path
                                                d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z">
                                            </path>
                                        </svg>
                                        ver
                                    </button>


                                </center>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $data->loan_type }}{{ $data->id }}"
                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Abjuntos</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card h-100 w-100">
                                                    <div class="card card-body">
                                                        <img name="" src=" {{ $data->signatures }}"
                                                            border="1">
                                                    </div>
                                                </div>
                                                <div class="card h-100 w-100">
                                                    <div class="card card-body">
                                                        <img name=""
                                                            src="data:image/png;base64,{{ $data->files }}"
                                                            border="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <center>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmacion</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Seguro desea eliminar este registro?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Confirmar</button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        {{--  </form> --}}
                    @endforeach
                @else
                    @csrf
                @endif
            @endif
        </tbody>
    </table>
    <div class="row">
        <div class="col">
            {{ $loans->links() }}
        </div>
    </div>
</div>
<style>
    #miTablaPersonalizada th {
        width: 100px;
        overflow: auto;
        border: 1px solid;
    }

    table {
        table-layout: fixed;
    }
</style>

<!-- Modal -->
