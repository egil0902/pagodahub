<input type="hidden" class="form-control" placeholder="Search" wire:model="searchTerm" value=""/>
<div class="row row-cols-5 row-cols-sm-5 row-cols-md-5">
    <div class="col-md border" align="justify">
        Tipo
    </div>
    <div class="col-md border" align="justify">
        Fecha
    </div>
    <div class="col-md border" align="justify">
        Cedula
    </div>
    <div class="col-md border" align="justify">
        Nombre
    </div>
    <div class="col-md border" align="justify">
        Monto
    </div>
</div>
@foreach ($loans as $data)
    <form name="valepagoda_destroy" id="valepagoda_destroy" method="POST" action="{{ route('valepagoda.destroy') }}">
        @csrf
        <input name="valeid" type="hidden" value="{{ $data->id }}">
        <div class="row row-cols-5 row-cols-sm-5 row-cols-md-5">
            <div class="col-md border" align="justify">
                {{ $data->loan_type }}
            </div>
            <div class="col-md border" align="justify">
                {{ $data->datetrx }}
            </div>
            <div class="col-md border" align="justify">
                {{ $data->cedula }}
            </div>
            <div class="col-md border" align="justify">
                {{ $data->nombre }}
            </div>
            <div class="col-md border" align="justify">
                {{ $data->monto }}
            </div>
            <br>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmacion</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
