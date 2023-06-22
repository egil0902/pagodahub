{{-- <input type="hidden" class="form-control" placeholder="Search" wire:model="searchTerm" value="" /> --}}
<div class="table-responsive">
    <table class="table table-bordered">
        <thead id="miTablaPersonalizada">

            <th>
                <select {{-- wire:model="tipo" --}} class="form-select" aria-label="Tipo" disabled>
                    <option selected value="Tipo">Tipo</option>
                    <option value="Prestamo">Prestamo</option>
                    <option value="Pago">Pago</option>
                </select>
            </th>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Adjuntos</th>
            <th>Eliminar</th>

        </thead>
        <tbody>
            @if (isset($loans))
                @if ($loans->isNotEmpty())
                    @foreach ($loans as $data)
                        @if($data->loan_type==='Pago')   
                            {{-- <form name="valepagoda_destroy" id="valepagoda_destroy" method="POST"
                                action="{{ route('valepagoda.destroy') }}">
                                @csrf --}}
                            <tr>
                                <input name="valeid" type="hidden" value="{{ $data->id }}">
                                <td> {{ $data->loan_type }}</td>
                                <td>{{ date('d-m-Y', strtotime($data->datetrx)) }}</td>
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
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#example2Modal{{ $data->loan_type }}{{ $data->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z">
                                                </path>
                                            </svg>
                                        </button>
                                    </center>
                                    <!-- Modal -->
                                    <div class="modal fade" id="example2Modal{{ $data->loan_type }}{{ $data->id }}"
                                        tabindex="-1" aria-labelledby="example2ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Abjuntos</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Seguro desea eliminar este {{ $data->loan_type }}?
                                                    <br>
                                                    Fecha: {{ date('d-m-Y', strtotime($data->datetrx)) }}
                                                    <br>
                                                    Valor:
                                                    @php
                                                        echo number_format($data->monto, 2, ',', ' ');
                                                    @endphp
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary" disabled>Confirmar</button>
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
                        @endif
                    @endforeach
                @else
                    @csrf
                @endif
            @endif
        </tbody>
    </table>
    {{-- <div class="row">
        <div class="col">
            {{ $loans->links() }}
        </div>
    </div> --}}
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
