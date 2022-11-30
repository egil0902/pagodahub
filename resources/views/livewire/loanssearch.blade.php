<div class="container">
    <div class="row ">
        <div class="col-md-12 col-12 col-sm-12 col-lg-12">
            <input type="text" class="form-control" placeholder="Search" wire:model="searchTerm" />
        </div>
    </div>
    <div class="row fw-bold">
        <div class="col-md-2 col-2 col-sm-2 col-lg-2 fw-bold">
            Sucursal
        </div>
        <div class="col-md-2 col-2 col-sm-2 col-lg-2 fw-bold">
            Beneficiario
        </div>
        <div class="col-md-2 col-2 col-sm-2 col-lg-2 fw-bold">
            Contacto
        </div>
        <div class="col-md-3 col-3 col-sm-3 col-lg-3 fw-bold">
            Monto
        </div>
        <div class="col-md-2 col-2 col-sm-2 col-lg-2 fw-bold">
            Fecha de Consumo
        </div>
        <div class="col-md-2 col-2 col-sm-2 col-lg-2 fw-bold">
            Validado Por
        </div>
        <div class="col-md-1 col-1 col-sm-1 col-lg-1">
        </div>
    </div>
    @foreach($loans as $data)
    <form name="valepagoda_destroy" id="valepagoda_destroy" method="POST" action="{{ route('valepagoda.destroy') }}">
        @csrf
        <input name="valeid" type="hidden" value="{{ $data->id }}">
        <div class="row">
            <div class="col-2 col-sm-2 col-md-2 col-lg-2">
                {{ $data->AD_Org_ID }}
            </div>
            <div class="col-2 col-sm-2 col-md-2 col-lg-2">
                {{ $data->C_BPartner_ID }}
            </div>
            <div class="col-2 col-sm-2 col-md-2 col-lg-2">
                {{ $data->AD_User_ID }}
            </div>
            <div class="col-md-3 col-3 col-sm-3 col-lg-3">
                {{ $data->LoanAmt }}
            </div>
            <div class="col-md-2 col-2 col-sm-2 col-lg-2">
                {{ date('d-m-Y',strtotime($data->created_at)) }}
            </div>
            <div class="col-md-2 col-2 col-sm-2 col-lg-2">
                {{ $data->CreatedBy }}
            </div>
            <div class="col-md-1 col-1 col-sm-1 col-lg-1 p-1">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">X</button>
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