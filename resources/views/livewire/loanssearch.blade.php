{{-- <input type="hidden" class="form-control" placeholder="Search" wire:model="searchTerm" value="" /> --}}
<div class="table-responsive">
    <table class="table table-bordered">
        <thead id="miTablaPersonalizada">

            <th>Tipo</th>
            <th>Fecha</th>
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
                            <td align="right">
                                <p>@php
                                    echo number_format($data->monto, 2, ',', ' ');
                                @endphp</p>
                            </td>
                            <td>
                                <center>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $data->id }}"> ver
                                        {{-- <img name="" width="25" height="25" src="img/ver.png"> --}}
                                    </button>
                                </center>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
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
