<div class="container">
    <div class="row ">
        <div class="col-md-12 col-12 col-sm-12 col-lg-12">
            <input type="text" class="form-control" placeholder="Search" wire:model="searchTerm" />
        </div>
    </div>
    <div class="row">
       <div class="col">
            Nombre
        </div>
        <div class="col">
            Cedula
        </div>
        {{--  <div class="col">
            Contacto
        </div>
        <div class="col">
            Monto
        </div>
        <div class="col">
            Fecha de Consumo
        </div>
        <div class="col">
            Validado Por
        </div> --}}
        <div class="col">
            Fecha Nuevo Prestamo
        </div>
        <div class="col">
            Monto
        </div>
        <div class="col">
            Cuota
        </div>
        <div class="col">
            Frecuencia
        </div>
        <div class="col">
            File cedula
        </div>
        <div class="col">
            Firma Nuevo Prestamo
        </div>
        <div class="col">
            X
        </div>
    </div>
    @foreach ($loans as $data)
        <form name="valepagoda_destroy" id="valepagoda_destroy" method="POST"
            action="{{ route('valepagoda.destroy') }}">
            @csrf
            <input name="valeid" type="hidden" value="{{ $data->id }}">
            <div class="row">
                 {{-- <div class="col">
                    {{ $data->Nombre }}
                </div>
                <div class="col">
                    {{ $data->Cedula}} --}}
                </div>
                {{--<div class="col">
                    {{ $data->AD_User_ID }}
                </div>
                <div class="col">
                    {{ $data->LoanAmt }}
                </div>
                <div class="col">
                    {{ date('d-m-Y', strtotime($data->created_at)) }}
                </div>
                <div class="col">
                    {{ $data->CreatedBy }}
                </div> --}}
                {{-- <div class="col">
                    {{ $data->FechaNuevoPrestamo }}
                </div>
                <div class="col">
                    {{ $data->Monto }}
                </div>
                <div class="col">
                    {{ $data->Cuota }}
                </div>
                <div class="col">
                    {{ $data->Frecuencia }}
                </div>
                <div class="col">
                    <img width="100" height="50" src="data:image/png;base64,{{ $data->Filecedula }}" border="1"> 
                </div>
                <div class="col">
                    <img width="100" height="50" src="{{ $data->FirmaNuevoPrestamo }}" border="1">   
                </div>
                <div class="col">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">X</button>
                </div> --}}
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
