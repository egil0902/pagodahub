@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="card w-auto">
            <div class="card-header">
                Compra
            </div>
            <div class="container">
                <div class="card-body">
                    <div class="container">
                        <div class="card-body">
                            <button id="addBtn" class="btn btn-primary">Añadir Producto</button>
                            <br><br>
                            <div id="formContainer">

                                <div class="form-group">
                                    <br>
                                    <hr>
                                    <label for="exampleDataList" class="form-label">Productos</label>
                                    <input class="form-control" list="datalistOptions" id="exampleDataList"
                                        placeholder="Escribe para buscar...">
                                    <datalist id="datalistOptions">
                                        <option value="Manzana">
                                        <option value="Pera">
                                        <option value="Piña">
                                        <option value="Melocotón">
                                    </datalist>
                                    <br>
                                    <label for="formGroupExampleInput" class="form-label">Unidad de Medida</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected></option>
                                        <option value="1">Unidad</option>
                                        <option value="2">Docena</option>
                                    </select>
                                    <br>
                                    <label for="formGroupExampleInput" class="form-label">Cantidad</label>
                                    <input type="number" class="form-control" id="formGroupExampleInput"
                                        placeholder="Example input placeholder">
                                    <hr>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <p id="counter">Productos: <span>1</span></p>
                    </div>

                    <script>
                        const formContainer = document.getElementById("formContainer");
                        const addBtn = document.getElementById("addBtn");
                        const counter = document.getElementById("counter");
                        let count = 1;

                        addBtn.addEventListener("click", function() {
                            count++;
                            const formGroup = formContainer.getElementsByClassName("form-group")[0];
                            const newFormGroup = formGroup.cloneNode(true);
                            newFormGroup.id = "formGroup" + count;
                            formContainer.appendChild(newFormGroup);
                            counter.getElementsByTagName("span")[0].innerHTML = count;
                        });
                    </script>

                </div>
            </div>

            <script>
                const formContainer = document.getElementById("formContainer");
                const addBtn = document.getElementById("addBtn");

                addBtn.addEventListener("click", function() {
                    const formGroup = formContainer.getElementsByClassName("form-group")[0];
                    const newFormGroup = formGroup.cloneNode(true);
                    formContainer.appendChild(newFormGroup);
                });
            </script>
        </div>
        <br>
    </div>
@endsection
