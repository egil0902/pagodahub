@extends('layouts.app')
@section('title', 'Page Title')

@if (session('mensaje'))
    <div class="alert alert-success">{{ session('mensaje') }}</div>
@endif

@section('content')
<div class="justify-content-center d-none container-loader" style="align-content: center; min-height: 100vh;">
    <div class="d-flex justify-content-center">
        <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status">
        </div>
    </div>
    <strong class="d-flex justify-content-center mt-3" style="font-size: 1.5rem;">Procesando la información, por favor espere...</strong>
</div>
<div class="p-2 m-0 border-0 bd-example container-form">
    <div class="d-flex">
        <!-- Formulario de búsqueda por proveedor -->
        <div class="container">
            <div class="card">

                 
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h4>Presupuesto banco</h4>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('pbank') }}" class="btn btn-primary font-weight-bold">Volver</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Formulario para envio-->
                    <form name="provider" id="provider" method="post" action="{{route( 'pbank.update' )}}">
                        <input type="hidden" name="id" value="{{$brink->id}}">
                        <div class=" col-md-6 mb-3">
                            <label for="date">Fecha</label>
                            <input type="date" class="form-control" date-format="mm/dd/yyyy"
                                id="date" name="date" placeholder="" value="{{$brink->fecha}}">                                
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="presupuesto">Presupuesto Efectivo</label>
                            <input type="number" class="form-control" id="presupuesto" name="presupuesto"  step="0.01" value="{{$brink->monto}}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="presupuesto_l">Presupuesto loteria</label>
                            <input type="number" class="form-control" id="presupuesto_l" name="presupuesto_l"  step="0.01" value="{{$brink->monto_l}}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="presupuesto_c">Presupuesto Cheques</label>
                            <input type="number" class="form-control" id="presupuesto_c" name="presupuesto_c"  step="0.01" value="{{$brink->monto_c}}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p for="cars" class="card-text">Sucursal</p>
                            <select class="form-control" name="AD_Org_ID" id="AD_Org_ID">
                                @if (isset($orgs))
                                    @if ($orgs)
                                        @foreach ($orgs as $org)
                                            @if($org->id!=0)
                                                <option value="{{ $org->Name }}" {{ $org->Name == $brink->sucursal ? 'selected' : '' }}>{{ $org->Name }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                            </select>
                        </div> 
                        <div class="form-group w-auto">
                            @csrf
                            <button class=" w-100 btn btn-outline-secondary m-0" type="button" id="button-addon2" onclick="enviarFormulario()">Actualizar</button>
                        </div>
                    </form>
                    <hr class="mb-4">                    
                </div>
            </div>
    </div>
    </div>
    </br>
    
</div>

<script>
    
    function enviarFormulario() {
        // Aquí puedes realizar cualquier otra validación antes de enviar el formulario

        /*$('#confirmModal').modal('hide');
        $('.container-form').addClass('d-none');
        $('.container-loader').removeClass('d-none');*/

        // Envía el formulario
        document.getElementById('provider').submit();
    }

</script>

    <style>
        .campo input {
            margin-bottom: 10px;
        }
        
        table {
            font-family: arial, sans-serif;
            background-color: white;
            text-align: left;
            border-collapse: collapse;
            width: 100%;
        }
        .table th {
            max-width: 100px; /* Establece el ancho máximo deseado */
            text-overflow: ellipsis; /* Agrega puntos suspensivos (...) si el contenido es demasiado largo */
            white-space: nowrap; /* Evita que el texto se divida en varias líneas */
        }
        th,
        td {
            padding: 1px;

        }
        

        thead {
            background-color: #246355;
            border-bottom: solid 5px #0F362D;
            color: white;
        }

        #theadtotal {
            background-color: #1b6453;
            border-bottom: solid 2.5px #268c74;
            border-top: solid 2.5px #268c74;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #ddd;
        }

        tr:hover td {
            background-color: #369681;
            color: white;
        }

        #imagenesPrevias {
            display: center;
            flex-wrap: wrap;
        }

        #imagenesPrevias img {
            max-width: 75%;
            height: auto;
            margin: 5px;
            border: 1px solid;
        }
        .divider {
        width: 15px;
        }
    </style>
@endsection