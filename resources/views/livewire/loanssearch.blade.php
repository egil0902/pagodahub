<div class="container">
    <div class="row ">
        <div class="col-md-12 col-12 col-sm-12 col-lg-12">
            <input type="text" class="form-control" placeholder="Search" wire:model="searchTerm" />
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col border" align="justify">
            Cedula Deudor
        </div>
        <div class="col border" align="justify">
            Fecha del Prestamo
        </div>
        <div class="col border" align="justify">
            Monto pedido
        </div>
        <div class="col border" align="justify">
            Cuota
        </div>
        <div class="col border" align="justify">
            Frecuencia
        </div>
    </div>
    @foreach ($loans as $data)
        <form name="valepagoda_destroy" id="valepagoda_destroy" method="POST"
            action="{{ route('valepagoda.destroy') }}">
            @csrf
            <input name="valeid" type="hidden" value="{{ $data->id }}">
            <div class="row">
                <div class="col border" align="justify">
                    {{ $data->cedula_user }}
                </div>
                <div class="col border" align="justify">
                    {{ $data->fechanuevoprestamo }}
                </div>
                <div class="col border" align="justify">
                    {{ $data->monto }}
                </div>
                <div class="col border" align="justify">
                    {{ $data->cuota }}
                </div>
                <div class="col border" align="justify">
                    {{ $data->frecuencia }}
                </div>
                <br>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    @endforeach
    <div class="row">
        <div class="col-md-12 col-12 col-sm-12 col-lg-12">
            {{ $loans->links() }}
        </div>
    </div>
    <!-- Modal -->

</div>
