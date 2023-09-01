{{-- <div class="row ">
    <div class="col">
        <input type="hidden" class="form-control" placeholder="Search" wire:model="searchTerm" />
    </div>
</div> --}}

<div class="table-responsive">
    <table class="table table-bordered">
        
        <thead id="miTablaPersonalizada">
            
            <th>
                <div class="input-group" style="width:75%">
                    <span class="input-group-text" id="basic-addon2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-calendar3" viewBox="0 0 16 16">
                            <path
                                d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                            <path
                                d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        </svg>
                    </span>
                    <input type="date" class="form-control" placeholder="fecha_dia" wire:model="fecha_dia"
                        aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </th>
            
            <th>Billetes</th>
            <th>Rollos</th>
            <th>Total</th>
        </thead>
        <tbody>
            @foreach ($brinksend as $data)
                <tr>
                    <td>{{ $data->fecha }}</td>
                    <td>
                        $1:{{ $data->billete_1 }} <br>
                        $5:{{ $data->billete_5 }} <br>
                        $10:{{ $data->billete_10 }} <br>
                        $20:{{ $data->billete_20 }} 
                    </td>
                    <td>
                        $0.01:{{ $data->rollos_01 }} <br>
                        $0.05:{{ $data->rollos_05 }} <br>
                        $0.10:{{ $data->rollos_10 }} <br>
                        $0.25:{{ $data->rollos_25 }} <br>
                        $0.50:{{ $data->rollos_50 }} 
                    </td>
                    <td>${{ $data->total }}   </td>
                    
                </tr>
                
            @endforeach
        </tbody>
    </table>
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
