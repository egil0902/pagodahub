<div class="container">
    <div class="row ">
        <div class="col">
            <input type="hidden" class="form-control" placeholder="Search" wire:model="searchTerm" disabled />
        </div>
    </div>
    <div class="row fw-bold row-cols-3">
        <div class="col">
            Fecha
        </div>
        <div class="col">
            Sucursal
        </div>
        <div class="col">
            <center>...</center>
        </div>
    </div>
    @foreach ($closecash as $data)
        <form name="closecash_destroy" id="closecash_destroy" method="POST" action="{{ route('closecash.destroy') }}">
            @csrf
            <input name="valeid" type="hidden" value="{{ $data->id }}">
            <div class="row row-cols-3" style="margin-bottom: 2px;">
                <div class="col">
                    {{ $data->DateTrx }}
                </div>
                <div class="col">

                    {{ $data->AD_Org_ID }}
                </div>

                <div class="col">
                    <center>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#closecashModal{{ $data->id }}"style="
                            padding-right: 5px;
                            padding-top: 0px;
                            padding-left: 5px;
                            padding-bottom: 0px;">x</button>
                    </center>
                </div>

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
        <div class="col">
            {{ $closecash->links() }}
        </div>
    </div>
    <!-- Modal -->
</div>
