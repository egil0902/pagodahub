{{-- <div class="row ">
    <div class="col">
        <input type="hidden" class="form-control" placeholder="Search" wire:model="searchTerm" />
    </div>
</div> --}}

<div class="table-responsive">
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="recibe">Fecha Inicio</label>
            <input type="date" class="form-control" wire:model="fecha_inicio" date-format="mm/dd/yyyy">
        </div>
        <div class="col-md-4 mb-3">
            <label for="recibe">Fecha Fin</label>
            <input type="date" class="form-control" wire:model="fecha_fin" date-format="mm/dd/yyyy">
        </div>
    </div>
    <table class="table table-bordered">
        <thead id="miTablaPersonalizada">
            <th>Fecha</th>
            <th>Presupuesto Banco</th>
            <th>Presupuesto Loteria</th>
            <th>Presupuesto Cheque</th>
            <th>Sucursal</th>
            <th style="width:10% !important;">Acciones</th>
        </thead>
        <tbody>
            @foreach ($brinksend as $data)
                <tr>
                    <td>{{ date('d-m-Y', strtotime($data->fecha)) }} </td>
                    
                    <td>{{ $data->monto }}   </td>
                    <td>{{ $data->monto_l }}   </td>
                    <td>{{ $data->monto_c }}   </td>
                    <td>{{ $data->sucursal }}   </td>
                    <td style="width:10% !important;">
                        <a href="{{ route('pbank.edit', $data->id) }}" class="btn btn-warning btn-block my-1" style="width: 100% !important;">Editar</a>
                        <form action="{{ route('pbank.delete', $data->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-block my-1" style="width: 100% !important;" onclick="return confirm('¿Estás seguro de que deseas eliminar este presupuesto?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4 float-end">
        {{ $brinksend->links('pagination::bootstrap-4') }}
    </div>
</div>
<style>
    #miTablaPersonalizada th {
        width: 100px;
        /* overflow: auto; */
        border: 1px solid;
    }

    table {
        table-layout: fixed;
    }
</style>
