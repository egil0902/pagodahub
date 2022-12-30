<div class="container">
    <div class="row ">
        <div class="col-md-12 col-12 col-sm-12 col-lg-12">
            <input type="text" class="form-control" placeholder="Search" wire:model="searchTerm" disabled/>
        </div>
    </div>
    <div class="row fw-bold">
        <div class="col-md-2 col-2 col-sm-2 col-lg-2 fw-bold">
            Fecha
        </div>
        <div class="col-md-2 col-2 col-sm-2 col-lg-2 fw-bold">
            Sucursal
        </div>
        <div class="col-md-1 col-1 col-sm-1 col-lg-1">
        </div>
    </div>
    @foreach($closecash as $data)
    <form name="closecash_destroy" id="closecash_destroy" method="POST" action="{{ route('closecash.destroy') }}">
        @csrf
        <input name="valeid" type="hidden" value="{{ $data->id }}">
        <div class="row">

            <div class="col-2 col-sm-2 col-md-2 col-lg-2">

                {{ $data->DateTrx }}
            </div>
            <div class="col-2 col-sm-2 col-md-2 col-lg-2">

                {{ $data->AD_Org_ID }}
            </div>

            <div class="col-md-1 col-1 col-sm-1 col-lg-1 p-1">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#closecashModal">X</button>

            </div>
            <div class="modal fade" id="closecashModal" tabindex="-1" aria-labelledby="closecashModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="closecashModalLabel">Confirmacion</h1>
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
        </div>
    </form>

    @endforeach
    <div class="row">
        <div class="col-md-12 col-12 col-sm-12 col-lg-12">
            {{ $closecash->links() }}
        </div>
    </div>
    <!-- Modal -->

</div>