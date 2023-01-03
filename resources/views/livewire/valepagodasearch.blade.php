<div class="row ">
    <div class="col">
        <input type="hidden" class="form-control" placeholder="Search" wire:model="searchTerm" />
    </div>
</div>
<div class="row fw-bold row-cols-6" style="font-size:12px;">
    <div class="col">
        Número de vale
    </div>
    <div class="col">
        Cédula
    </div>
    <div class="col">
        Nombre
    </div>
    <div class="col">
        Fecha de Consumo
    </div>
    <div class="col">
        Validado Por
    </div>
    <div class="col">
        <center>...</center>
    </div>
</div>

@foreach ($vales as $data)
    <form name="valepagoda_destroy" id="valepagoda_destroy" method="POST" action="{{ route('valepagoda.destroy') }}">
        @csrf
        <div class="row row-cols-6" style="font-size:12px;padding-bottom: 10px;">
            <div class="col">
                {{ $data->value }}
            </div>
            <div class="col">
                {{ $data->taxid }}
            </div>
            <div class="col">
                {{ $data->name }}
            </div>
            <div class="col">
                {{ date('d-m-Y', strtotime($data->created_at)) }}
            </div>
            <div class="col">
                {{ $data->CreatedBy }}
            </div>
            <div class="col">
                <center>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                        data-bs-target="#exampleModal{{ $data->id }}"
                        style="
                        padding-right: 5px;
                        padding-top: 0px;
                        padding-left: 5px;
                        padding-bottom: 0px;">x</button>
                </center>
            </div>
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endforeach

<center>
    <div class="row">
        <div class="col">
            {{ $vales->links() }}
        </div>
    </div>
</center>
