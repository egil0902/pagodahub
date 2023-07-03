@extends('layouts.app')

@section('content')
    <?php
    if (isset($error)) {
        echo "<h1 class='text-danger'>" . $error . '</h1>';
    }
    ?>


    <div class="card">
        <div class="card-header">Ingrese un rango para generar</div>
        <div class="card-body">
            <div class="form-group">
                <form name="valespagodarange_store" id="valespagodarange_store" method="post"
                    action="{{ route('valespagodarange.store') }}">
                    @csrf
                    <center>
                        <h5 class="fw-bold">Ingrese el rango de números a generar para los vales</h5>
                    </center>

                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                        <div class="col">
                            <div>Desde</div>
                            <input name="valueFrom" value="{{ isset($request) ? $request->valueFrom : '' }}" type="text"
                                class="form-control text-left w-100" placeholder="">
                        </div>
                        <div class="col">
                            <div>Hasta</div>
                            <input name="valueTo" value="{{ isset($request) ? $request->valueTo : '' }}" type="text"
                                class="form-control text-left w-100" placeholder="">
                        </div>
                        <div class="col">
                            <div>Monto</div>
                            <input name="amount" value="{{ isset($request) ? $request->amount : '' }}" type="text"
                                class="form-control text-left w-100" placeholder="">
                            <input name="CreatedBy" value="{{ auth()->user()->name }}" type="hidden"
                                class=" form-control text-left  w-100 ">
                        </div>
                        <div class="col">

                            <center>
                                <div>...</div>
                            </center>
                            <button type="submit" class="btn btn-primary w-100">Guardar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">Listado de Rangos generados</div>
        <div class="card-body">
        <form name="valespagodarange_list" id="valespagodarange_list" method="post" action="{{ route('valespagodarange.list') }}">
    <button type="submit" class="btn btn-primary w-100">Mostrar</button>
    @csrf
</form>

@if (isset($list))
    <div class="row fw-bold row-cols-6" style="font-size:12px;">
        <div class="col">
            Desde
        </div>
        <div class="col">
            Hasta
        </div>
        <div class="col">
            Monto
        </div>
        <div class="col">
            Fecha de creacion
        </div>
        <div class="col">
            Creado por
        </div>
        <div class="col">
            Borrar
        </div>
    </div>
    @foreach ($list as $data)
        <div class="row row-cols-6" style="font-size:12px;">
            <div class="col">
                {{ $data->valueFrom }}
            </div>
            <div class="col">
                {{ $data->valueTo }}
            </div>
            <div class="col">
                {{ $data->amount }}
            </div>
            <div class="col">
                {{ date('d-m-Y', strtotime($data->created_at)) }}
            </div>
            <div class="col">
                {{ $data->CreatedBy }}
            </div>
            <div class="col">
                <form id="delete-form" action="{{ route('valespagodarange.delete') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <button class="btn btn-outline-danger" data-bs-toggle="modal" onclick="showConfirmationPopup(event)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"></path>
                        </svg>
                    </button>
                </form>
                <script>
                    function showConfirmationPopup(event) {
                        event.preventDefault(); // Evita que el formulario se envíe por defecto

                        // Muestra el popup de confirmación (puedes usar librerías como Bootstrap o implementar tu propio popup)
                        // Aquí hay un ejemplo de cómo mostrar un popup simple utilizando JavaScript nativo:
                        var confirmed = confirm("¿Estás seguro de que deseas eliminar el vale de rango {{$data->valueFrom}} - {{ $data->valueTo }}?");
                        
                        if (confirmed) {
                            // Si el usuario confirma, envía el formulario
                            document.getElementById("delete-form").submit();
                        }
                    }
                </script>
            </div>

        </div>
    @endforeach
@endif

        </div>
    </div>

@endsection
